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
        ]);

        $flight = Flight::find($data['flight_id']);

        // Basic availability check: only allow booking for scheduled future flights
        if (!$flight || $flight->status !== 'Scheduled' || Carbon::parse($flight->scheduled_departure)->lte(Carbon::now())) {
            return redirect()->back()->with('error', 'Selected flight is not available for booking.');
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight->id,
            'status' => 'Pending',
            'booking_date' => Carbon::now(),
        ]);

        return redirect()->route('bookings')->with('success', 'Booking created. Proceed to seat selection.')->with('booking_id', $booking->id);
    }

    /**
     * Update seat for a booking.
     */
    public function updateSeat(Request $request, \App\Models\Booking $booking)
    {
        $this->authorize = null; // keep phpstan quiet in basic controllers

        // Only allow owner to update their booking
        if ($booking->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this booking.');
        }

        $data = $request->validate([
            'seat_number' => ['required', 'string', 'max:10'],
        ]);

        $booking->seat_number = $data['seat_number'];
        $booking->status = 'Confirmed';
        $booking->save();

        // After saving seat, show My Reservations tab
        $bookingsUrl = route('bookings') . '?tab=reservations';
        return redirect()->to($bookingsUrl)->with('success', 'Seat saved.');
    }
}
