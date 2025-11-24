<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Flight;

class SeatAdminController extends Controller
{
    public function index()
    {
        $seats = Seat::latest('id')->paginate(20);
        return view('admin.seats.index', compact('seats'));
    }

    public function create()
    {
        $flights = Flight::orderBy('flight_number')->get();
        return view('admin.seats.create', compact('flights'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'flight_id' => 'required|integer',
            'seat_number' => 'required|string|max:10',
            'class' => 'nullable|string|max:50',
            'is_available' => 'nullable|boolean',
        ]);

        // Ensure boolean default
        $data['is_available'] = $request->has('is_available') ? (bool) $request->is_available : true;

        Seat::create($data);

        return redirect()->route('admin.seats.index')->with('success', 'Seat created');
    }

    public function show(Seat $seat)
    {
        return view('admin.seats.show', compact('seat'));
    }

    public function edit(Seat $seat)
    {
        $flights = Flight::orderBy('flight_number')->get();
        return view('admin.seats.edit', compact('seat', 'flights'));
    }

    public function update(Request $request, Seat $seat)
    {
        $data = $request->validate([
            'flight_id' => 'required|integer',
            'seat_number' => 'required|string|max:10',
            'class' => 'nullable|string|max:50',
            'is_available' => 'nullable|boolean',
        ]);

        $data['is_available'] = $request->has('is_available') ? (bool) $request->is_available : $seat->is_available;

        $seat->update($data);

        return redirect()->route('admin.seats.index')->with('success', 'Seat updated');
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->route('admin.seats.index')->with('success', 'Seat deleted');
    }
}
