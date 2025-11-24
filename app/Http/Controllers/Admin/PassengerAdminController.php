<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Passenger;
use App\Models\Booking;

class PassengerAdminController extends Controller
{
    public function index()
    {
        $passengers = Passenger::latest('id')->paginate(20);
        return view('admin.passengers.index', compact('passengers'));
    }

    public function create()
    {
        $bookings = Booking::with('user')->orderBy('id', 'desc')->get();
        return view('admin.passengers.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'passport' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
        ]);

        Passenger::create($data);

        return redirect()->route('admin.passengers.index')->with('success', 'Passenger created');
    }

    public function show(Passenger $passenger)
    {
        return view('admin.passengers.show', compact('passenger'));
    }

    public function edit(Passenger $passenger)
    {
        $bookings = Booking::with('user')->orderBy('id', 'desc')->get();
        return view('admin.passengers.edit', compact('passenger', 'bookings'));
    }

    public function update(Request $request, Passenger $passenger)
    {
        $data = $request->validate([
            'booking_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'passport' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
        ]);

        $passenger->update($data);

        return redirect()->route('admin.passengers.index')->with('success', 'Passenger updated');
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->delete();
        return redirect()->route('admin.passengers.index')->with('success', 'Passenger deleted');
    }
}
