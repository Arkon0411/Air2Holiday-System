<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Store a new booking for the authenticated user.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_id' => ['required', 'integer', 'exists:flights,id'],
            'seat_number' => ['nullable', 'string', 'max:10'],
            'class' => ['nullable', 'string', 'in:economy,business'],
        ]);

        $flight = Flight::find($data['flight_id']);

        // Basic availability check: only allow booking for scheduled future flights
        if (!$flight) {
            return response()->json(['success' => false, 'message' => 'Flight not found.'], 404);
        }

        if (strtolower($flight->status) !== 'scheduled') {
            return response()->json(['success' => false, 'message' => 'Flight status is ' . $flight->status . ', only Scheduled flights can be booked.'], 400);
        }

        // Check if flight is in the future (allow booking up to departure time)
        if ($flight->scheduled_departure && $flight->scheduled_departure->isPast()) {
            return response()->json(['success' => false, 'message' => 'Flight has already departed.'], 400);
        }

        // Check if seat is already taken
        if (!empty($data['seat_number'])) {
            $seatTaken = Booking::where('flight_id', $flight->id)
                ->where('seat_number', $data['seat_number'])
                ->exists();
            
            if ($seatTaken) {
                return response()->json(['success' => false, 'message' => 'Seat already taken. Please select another seat.'], 400);
            }
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight->id,
            'status' => 'confirmed',
            'booking_date' => Carbon::now(),
            'seat_number' => $data['seat_number'] ?? null,
            'class' => $data['class'] ?? 'economy',
        ]); 

        return response()->json(['success' => true, 'booking_id' => $booking->id, 'message' => 'Booking created successfully.']);
    }

    /**
     * Update seat for a booking.
     */
    public function updateSeat(Request $request, \App\Models\Booking $booking)
    {
        $this->authorize = null; // keep phpstan quiet in basic controllers

        // Only allow owner to update their booking
        if ($booking->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'You are not authorized to update this booking.'], 403);
        }

        $data = $request->validate([
            'seat_number' => ['required', 'string', 'max:10'],
        ]);

        // Check if seat is already taken by another booking
        $seatTaken = Booking::where('flight_id', $booking->flight_id)
            ->where('seat_number', $data['seat_number'])
            ->where('id', '!=', $booking->id)
            ->exists();
        
        if ($seatTaken) {
            return response()->json(['success' => false, 'message' => 'Seat already taken. Please select another seat.'], 400);
        }

        $booking->seat_number = $data['seat_number'];
        $booking->status = 'confirmed';
        $booking->save();

        return response()->json(['success' => true, 'message' => 'Seat saved successfully.']);
    }

    /**
     * Request a refund for a booking.
     */
    public function requestRefund(Request $request, \App\Models\Booking $booking)
    {
        // Only allow owner to request refund for their booking
        if ($booking->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'You are not authorized to request a refund for this booking.'], 403);
        }

        // Only confirmed bookings can request refunds
        if ($booking->status !== 'confirmed') {
            return response()->json(['success' => false, 'message' => 'Only confirmed bookings can request refunds.'], 400);
        }

        // Update booking status to pending (awaiting refund approval)
        $booking->status = 'pending';
        $booking->save();

        return response()->json(['success' => true, 'message' => 'Refund requested successfully.']);
    }

    /**
     * Get booked seats for a specific flight.
     */
    public function getBookedSeats(\App\Models\Flight $flight)
    {
        $bookedSeats = Booking::where('flight_id', $flight->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->whereNotNull('seat_number')
            ->where('seat_number', '!=', '')
            ->pluck('seat_number')
            ->toArray();

        return response()->json(['booked_seats' => $bookedSeats]);
    }

    /**
     * Search for flights based on criteria.
     */
    public function searchFlights(Request $request)
    {
        $query = Flight::with(['departureAirport', 'arrivalAirport', 'airline'])
            ->where('status', 'scheduled')
            ->where('scheduled_departure', '>', now());

        if ($request->has('departure') && $request->departure) {
            $query->where('departure_airport_id', $request->departure);
        }

        if ($request->has('arrival') && $request->arrival) {
            $query->where('arrival_airport_id', $request->arrival);
        }

        if ($request->has('date') && $request->date) {
            $query->whereDate('scheduled_departure', $request->date);
        }

        $flights = $query->orderBy('scheduled_departure')->get();

        $flightsData = $flights->map(function ($flight) {
            return [
                'id' => $flight->id,
                'flight_number' => $flight->flight_number,
                'departure' => optional($flight->departureAirport)->location ?? 'Unknown',
                'departure_code' => optional($flight->departureAirport)->iata_code ?? 'N/A',
                'arrival' => optional($flight->arrivalAirport)->location ?? 'Unknown',
                'arrival_code' => optional($flight->arrivalAirport)->iata_code ?? 'N/A',
                'departure_time' => $flight->scheduled_departure ? $flight->scheduled_departure->format('M d, Y H:i') : 'TBA',
                'arrival_time' => $flight->scheduled_arrival ? $flight->scheduled_arrival->format('M d, Y H:i') : 'TBA',
                'airline' => optional($flight->airline)->name ?? 'Unknown',
                'base_price' => number_format($flight->base_price, 2),
                'business_price' => number_format($flight->business_price ?? $flight->base_price * 1.5, 2),
                'image' => optional($flight->arrivalAirport)->image ?? 'img/loginsplash.jpeg'
            ];
        });

        return response()->json(['flights' => $flightsData]);
    }
}
