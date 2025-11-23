<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user && ($user->usertype ?? null) === 'airline') {
            $flights = Flight::where('airline_id', $user->id)->get();
        } else {
            $flights = Flight::all();
        }

        return view('adminpanel.flights.index', compact('flights'));
    }

    public function create()
    {
        $user = Auth::user();
        $airlines = [];

        if (! ($user && ($user->usertype ?? null) === 'airline')) {
            $airlines = User::where('usertype', 'airline')->get();
        }

        return view('adminpanel.flights.create', compact('airlines'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'flight_number' => 'required|string',
            'scheduled_departure' => 'nullable|date',
            'scheduled_arrival' => 'nullable|date',
            'status' => 'nullable|string',
            'airline_id' => 'nullable|integer',
            'departure_airport_id' => 'nullable|integer',
            'arrival_airport_id' => 'nullable|integer',
            'base_price' => 'nullable|numeric',
        ]);

        if ($user && ($user->usertype ?? null) === 'airline') {
            $data['airline_id'] = $user->id;
        }

        Flight::create($data);

        return redirect()->route('adminpanel.flights.index');
    }

    public function edit(Flight $flight)
    {
        $user = Auth::user();

        if ($user && ($user->usertype ?? null) === 'airline' && $flight->airline_id !== $user->id) {
            abort(403);
        }

        $airlines = User::where('usertype', 'airline')->get();
        return view('adminpanel.flights.edit', compact('flight', 'airlines'));
    }

    public function update(Request $request, Flight $flight)
    {
        $user = Auth::user();

        if ($user && ($user->usertype ?? null) === 'airline' && $flight->airline_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'flight_number' => 'required|string',
            'scheduled_departure' => 'nullable|date',
            'scheduled_arrival' => 'nullable|date',
            'status' => 'nullable|string',
            'airline_id' => 'nullable|integer',
            'departure_airport_id' => 'nullable|integer',
            'arrival_airport_id' => 'nullable|integer',
            'base_price' => 'nullable|numeric',
        ]);

        if ($user && ($user->usertype ?? null) === 'airline') {
            $data['airline_id'] = $user->id;
        }

        $flight->update($data);

        return redirect()->route('adminpanel.flights.index');
    }

    public function destroy(Flight $flight)
    {
        $user = Auth::user();

        if ($user && ($user->usertype ?? null) === 'airline' && $flight->airline_id !== $user->id) {
            abort(403);
        }

        $flight->delete();
        return redirect()->route('adminpanel.flights.index');
    }
}
