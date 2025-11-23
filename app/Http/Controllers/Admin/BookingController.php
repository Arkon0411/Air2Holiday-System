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

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('adminpanel.bookings.index');
    }
}
