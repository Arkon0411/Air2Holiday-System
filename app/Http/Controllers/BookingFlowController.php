<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingFlowController extends Controller
{
    public function search(Request $request)
    {
        $airports = \App\Models\Airport::orderBy('name')->get();
        return view('bookings.search', compact('airports'));
    }

    public function results(Request $request)
    {
        $data = $request->validate([
            'from' => 'required|integer',
            'to' => 'required|integer|different:from',
            'date' => 'required|date'
        ]);

        $date = Carbon::parse($data['date'])->toDateString();

        $flights = Flight::where('departure_airport_id', $data['from'])
            ->where('arrival_airport_id', $data['to'])
            ->whereDate('scheduled_departure', $date)
            ->withCount(['bookings as seats_taken' => function($q){ $q->whereNotNull('seat_number'); }])
            ->get();

        return view('bookings.results', compact('flights'));
    }

    public function seatMap(Flight $flight)
    {
        $seats = Seat::where('flight_id', $flight->id)->orderBy('seat_number')->get();
        $taken = Booking::where('flight_id', $flight->id)->whereNotNull('seat_number')->pluck('seat_number')->all();
        return view('bookings.seat-map', compact('flight','seats','taken'));
    }

    public function createBooking(Request $request, Flight $flight)
    {
        $data = $request->validate([
            'seat' => 'required|string',
            'passengers' => 'required|array|min:1',
            'passengers.*.first_name' => 'required|string',
            'passengers.*.last_name' => 'required|string',
        ]);

        // Harden booking with DB locks to avoid race conditions
        try {
            $booking = DB::transaction(function () use ($data, $flight, $request) {
                // Lock the seat row for this flight
                $seatRow = DB::table('seats')
                    ->where('flight_id', $flight->id)
                    ->where('seat_number', $data['seat'])
                    ->lockForUpdate()
                    ->first();

                if (! $seatRow) {
                    throw new \RuntimeException('Selected seat not valid.');
                }

                // Also lock any existing bookings for this seat to prevent double-book
                $existing = DB::table('bookings')
                    ->where('flight_id', $flight->id)
                    ->where('seat_number', $data['seat'])
                    ->lockForUpdate()
                    ->first();

                if ($existing) {
                    throw new \RuntimeException('Seat already taken.');
                }

                $user = $request->user();

                // create booking
                $booking = Booking::create([
                    'user_id' => $user->id ?? null,
                    'flight_id' => $flight->id,
                    'status' => 'pending',
                    'booking_date' => Carbon::now(),
                    'seat_number' => $data['seat'],
                ]);

                foreach ($data['passengers'] as $p) {
                    Passenger::create([
                        'booking_id' => $booking->id,
                        'first_name' => $p['first_name'],
                        'last_name' => $p['last_name'],
                        'dob' => $p['dob'] ?? null,
                        'passport_no' => $p['passport_no'] ?? null,
                        'seat_number' => $data['seat']
                    ]);
                }

                // calculate amount: base_price + seat modifier
                $base = $flight->base_price ?? 0;
                $modifier = floatval($seatRow->price_modifier ?? 0);
                $amount = $base + $modifier;

                $payment = Payment::create([
                    'booking_id' => $booking->id,
                    'provider' => 'stripe',
                    'amount' => $amount,
                    'status' => 'pending'
                ]);

                $booking->payment_id = $payment->id;
                $booking->save();

                // mark the seat as booked in seats table
                DB::table('seats')
                    ->where('flight_id', $flight->id)
                    ->where('seat_number', $data['seat'])
                    ->update(['is_booked' => 1, 'updated_at' => now()]);

                return $booking;
            }, 5); // retry up to 5 times if deadlock

            return redirect()->route('bookings.confirm', ['booking' => $booking->id]);
        } catch (\Throwable $e) {
            return back()->withErrors(['error' => 'Could not create booking: ' . $e->getMessage()])->withInput();
        }
    }

    public function confirm(Booking $booking)
    {
        return view('bookings.confirm', compact('booking'));
    }
}
