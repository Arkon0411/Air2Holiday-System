<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['flight.airline', 'flight.departureAirport', 'flight.arrivalAirport', 'user'])
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'booking_date' => $booking->booking_date,
                    'status' => $booking->status,
                    'seat_number' => $booking->seat_number,
                    'class' => $booking->class,
                    'user_id' => $booking->user_id,
                    'user_name' => $booking->user->name ?? 'N/A',
                    'user_email' => $booking->user->email ?? 'N/A',
                    'flight_id' => $booking->flight_id,
                    'flight_number' => $booking->flight->flight_number ?? 'N/A',
                    'departure_airport' => $booking->flight->departureAirport->name ?? 'N/A',
                    'arrival_airport' => $booking->flight->arrivalAirport->name ?? 'N/A',
                ];
            });
        
        return view('adminpanel.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['flight.airline', 'flight.departureAirport', 'flight.arrivalAirport', 'user']);
        
        return view('adminpanel.bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        try {
            $booking->delete();

            return response()->json([
                'success' => true,
                'message' => 'Booking deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting booking: ' . $e->getMessage()
            ], 500);
        }
    }
}
