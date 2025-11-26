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
        if (!$flight || $flight->status !== 'Scheduled' || Carbon::parse($flight->scheduled_departure)->lte(Carbon::now())) {
            return response()->json(['success' => false, 'message' => 'Selected flight is not available for booking.'], 400);
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

        return response()->json(['success' => true, 'message' => 'Refund requested successfully. Your booking is now pending approval.']);
    }
}
