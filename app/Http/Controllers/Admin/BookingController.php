<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['flight','user'])->get();
        return view('adminpanel.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('adminpanel.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $booking->load(['flight.airline', 'user']);
        
        return response()->json([
            'id' => $booking->id,
            'booking_date' => $booking->booking_date,
            'status' => $booking->status,
            'user_id' => $booking->user_id,
            'user_name' => optional($booking->user)->name ?? 'N/A',
            'flight_id' => $booking->flight_id,
            'flight_number' => optional($booking->flight)->flight_number ?? 'N/A',
            'airline_name' => optional($booking->flight->airline)->name ?? 'N/A',
            'seat_number' => $booking->seat_number ?? 'N/A',
            'class' => $booking->class ?? 'N/A',
            'scheduled_departure' => optional($booking->flight)->scheduled_departure 
                ? \Carbon\Carbon::parse($booking->flight->scheduled_departure)->format('M d, Y H:i') 
                : 'N/A'
        ]);
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()->route('adminpanel.bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('adminpanel.bookings.index');
    }
}
