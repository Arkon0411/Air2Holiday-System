<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Update seat for a booking.
     */
    public function seat(Request $request, Booking $booking)
    {
        $user = $request->user();

        // Ensure the logged-in user owns the booking (or is admin)
        if ($booking->user_id !== $user->id && ($user->role ?? 'customer') !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'seat_number' => 'nullable|string|max:10'
        ]);

        $newSeat = $data['seat_number'] ?? null;
        // normalize incoming seat value
        $newSeat = is_string($newSeat) ? strtoupper(trim($newSeat)) : $newSeat;

        // validate seat exists if a value was provided
        if ($newSeat) {
            $seatExists = \Illuminate\Support\Facades\DB::table('seats')
                ->where('flight_id', $booking->flight_id)
                ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$newSeat])
                ->exists();

            if (! $seatExists) {
                return back()->withErrors(['seat_number' => 'Selected seat is not valid for this flight.']);
            }

            // ensure no other booking holds this seat
            $conflict = Booking::where('flight_id', $booking->flight_id)
                ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$newSeat])
                ->where('id', '!=', $booking->id)
                ->exists();

            if ($conflict) {
                return back()->withErrors(['seat_number' => 'Seat already taken by another booking.']);
            }
        }

        // Atomic update: free old seat, set new seat booked, update booking
        \Illuminate\Support\Facades\DB::transaction(function() use ($booking, $newSeat) {
            $old = $booking->seat_number;
            if ($old && $old !== $newSeat) {
                $oldNorm = is_string($old) ? strtoupper(trim($old)) : $old;
                \Illuminate\Support\Facades\DB::table('seats')
                    ->where('flight_id', $booking->flight_id)
                    ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$oldNorm])
                    ->update(['is_booked' => 0, 'updated_at' => now()]);
            }

            if ($newSeat && $old !== $newSeat) {
                \Illuminate\Support\Facades\DB::table('seats')
                    ->where('flight_id', $booking->flight_id)
                    ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$newSeat])
                    ->update(['is_booked' => 1, 'updated_at' => now()]);
            }

            $booking->seat_number = $newSeat;
            $booking->save();
        });

        return redirect()->route('bookings')->with('success', 'Seat updated to ' . ($booking->seat_number ?? '—'));
    }
}
