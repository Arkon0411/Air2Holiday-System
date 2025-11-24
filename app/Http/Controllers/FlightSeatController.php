<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class FlightSeatController extends Controller
{
    public function seats(\Illuminate\Http\Request $request, Flight $flight)
    {
        $user = auth()->user();
        // load seat rows and taken seats
        $seatRows = DB::table('seats')->where('flight_id', $flight->id)->orderBy('seat_number')->get();

        // seats marked booked either by bookings table or explicit seat flag
        $bookedFromBookings = DB::table('bookings')->where('flight_id', $flight->id)->whereNotNull('seat_number')->pluck('seat_number')->all();

        // Only query `seats.is_booked` if the column exists to avoid SQL errors when migrations
        // haven't been executed yet (graceful fallback).
        $bookedFromSeats = [];
        try {
            if (Schema::hasColumn('seats', 'is_booked')) {
                $bookedFromSeats = DB::table('seats')->where('flight_id', $flight->id)->where('is_booked', 1)->pluck('seat_number')->all();
            }
        } catch (\Throwable $e) {
            // log and continue with bookings-derived data only
            Log::warning('Could not read seats.is_booked column: ' . $e->getMessage());
            $bookedFromSeats = [];
        }

        // Normalize seat strings (trim + uppercase) so UI and DB comparisons match
        $normalize = fn($s) => is_string($s) ? strtoupper(trim($s)) : $s;

        $seatRows = $seatRows->map(function ($r) use ($normalize) {
            $r->seat_number = $normalize($r->seat_number);
            return $r;
        });

        $bookedFromBookings = array_map($normalize, $bookedFromBookings);
        $bookedFromSeats = array_map($normalize, $bookedFromSeats);

        $takenSeats = array_values(array_unique(array_merge($bookedFromBookings, $bookedFromSeats)));

        $seats_total = DB::table('seats')->where('flight_id', $flight->id)->count();
        $seats_taken = count($takenSeats);
        $seats_available = max(0, $seats_total - $seats_taken);

        // find current user's booking for this flight (if any)
        $booking = null;
        if ($user) {
            $booking = Booking::where('user_id', $user->id)->where('flight_id', $flight->id)->first();
        }

        // if JSON requested, return structured seat data for front-end
        if ($request->wantsJson() || $request->query('format') === 'json') {
            return response()->json([
                'flight_id' => $flight->id,
                'flight_number' => $flight->flight_number,
                'seats_total' => $seats_total,
                'seats_taken' => $seats_taken,
                'seats_available' => $seats_available,
                'seat_rows' => $seatRows,
                'taken_seats' => $takenSeats,
                'booking_id' => $booking ? $booking->id : null,
            ]);
        }

        return view('partials.seat-map', compact('flight','seatRows','takenSeats','seats_total','seats_taken','seats_available','booking'));
    }

    public function reserve(Request $request, Flight $flight): JsonResponse
    {
        $user = Auth::user();
        $data = $request->validate([
            'seat' => ['required','string'],
            'booking_id' => ['nullable','integer']
        ]);

        $seat = $data['seat'];
        // normalize incoming seat identifier
        $seat = is_string($seat) ? strtoupper(trim($seat)) : $seat;
        $bookingId = $data['booking_id'] ?? null;

        // ensure seat exists for this flight (compare normalized values)
        $seatExists = DB::table('seats')
            ->where('flight_id', $flight->id)
            ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$seat])
            ->exists();
        if (! $seatExists) {
            return response()->json(['success' => false, 'message' => 'Invalid seat for this flight.'], 422);
        }

        // check if seat already taken
        $taken = DB::table('bookings')->where('flight_id', $flight->id)->where('seat_number', $seat)->exists();
        if ($taken) {
            return response()->json(['success' => false, 'message' => 'Seat already taken.'], 409);
        }

        // attach seat to a booking (provided or user's booking or create)
        try {
            DB::beginTransaction();

            if ($bookingId) {
                $booking = Booking::find($bookingId);
                if (! $booking) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => 'Booking not found.'], 404);
                }
                // ownership check or admin
                if ($booking->user_id !== ($user->id ?? null) && (($user->role ?? 'customer') !== 'admin')) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => 'Not authorized to modify this booking.'], 403);
                }
            } else {
                // find or create booking for the user and flight
                if (! $user) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
                }
                $booking = Booking::where('user_id', $user->id)->where('flight_id', $flight->id)->first();
                if (! $booking) {
                    $booking = Booking::create([
                        'user_id' => $user->id,
                        'flight_id' => $flight->id,
                        'status' => 'pending',
                        'booking_date' => Carbon::now(),
                    ]);
                }
            }

            // final check before assigning
            $already = Booking::where('flight_id', $flight->id)
                ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$seat])
                ->first();
            if ($already) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Seat was taken while reserving.'], 409);
            }

            $booking->seat_number = $seat;
            // free previous seat if different
            $previous = $booking->getOriginal('seat_number');
            $previous = is_string($previous) ? strtoupper(trim($previous)) : $previous;
            if ($previous && $previous !== $seat) {
                DB::table('seats')
                    ->where('flight_id', $flight->id)
                    ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$previous])
                    ->update(['is_booked' => 0, 'updated_at' => now()]);
            }

            $booking->seat_number = $seat;
            $booking->save();

            // mark seat as booked in seats table
            DB::table('seats')
                ->where('flight_id', $flight->id)
                ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$seat])
                ->update(['is_booked' => 1, 'updated_at' => now()]);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Seat reserved.', 'booking_id' => $booking->id, 'seat' => $seat]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Seat reserve error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Could not reserve seat.'], 500);
        }
    }
}
