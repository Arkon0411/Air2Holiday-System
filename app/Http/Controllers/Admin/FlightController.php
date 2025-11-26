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
            // Get airline associated with this user
            $airline = $user->airline;
            if ($airline) {
                $flights = Flight::where('airline_id', $airline->id)->with(['airline', 'departureAirport', 'arrivalAirport'])->get();
            } else {
                $flights = collect();
            }
        } else {
            $flights = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])->get();
        }

        return view('adminpanel.flights.index', compact('flights'));
    }

    public function create()
    {
        $user = Auth::user();
        $airlines = [];
        $airports = \App\Models\Airport::all();

        if (! ($user && ($user->usertype ?? null) === 'airline')) {
            $airlines = \App\Models\Airline::with('user')->get();
        }

        return view('adminpanel.flights.create', compact('airlines', 'airports'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'flight_number' => 'required|string',
            'scheduled_departure' => 'nullable|string',
            'scheduled_arrival' => 'nullable|string',
            'status' => 'nullable|string',
            'airline_id' => 'nullable|integer',
            'departure_airport_id' => 'required|integer',
            'arrival_airport_id' => 'required|integer',
            'base_price' => 'required|numeric',
            'business_price' => 'nullable|numeric',
        ]);

        // Convert datetime strings to proper format
        if (!empty($data['scheduled_departure'])) {
            $data['scheduled_departure'] = \Carbon\Carbon::parse($data['scheduled_departure'])->format('Y-m-d H:i:s');
        }
        if (!empty($data['scheduled_arrival'])) {
            $data['scheduled_arrival'] = \Carbon\Carbon::parse($data['scheduled_arrival'])->format('Y-m-d H:i:s');
        }

        if ($user && ($user->usertype ?? null) === 'airline') {
            $airline = $user->airline;
            if ($airline) {
                $data['airline_id'] = $airline->id;
            }
        }

        Flight::create($data);

        return redirect()->route('adminpanel.flights.index');
    }

    public function edit(Flight $flight)
    {
        $user = Auth::user();

        if ($user && ($user->usertype ?? null) === 'airline') {
            $airline = $user->airline;
            if (!$airline || $flight->airline_id !== $airline->id) {
                abort(403);
            }
        }

        $airlines = \App\Models\Airline::with('user')->get();
        $airports = \App\Models\Airport::all();
        
        return response()->json([
            'id' => $flight->id,
            'flight_number' => $flight->flight_number,
            'scheduled_departure' => $flight->scheduled_departure,
            'scheduled_arrival' => $flight->scheduled_arrival,
            'status' => $flight->status,
            'airline_id' => $flight->airline_id,
            'departure_airport_id' => $flight->departure_airport_id,
            'arrival_airport_id' => $flight->arrival_airport_id,
            'base_price' => $flight->base_price,
            'business_price' => $flight->business_price,
        ]);
    }

    public function update(Request $request, Flight $flight)
    {
        $user = Auth::user();

        if ($user && ($user->usertype ?? null) === 'airline') {
            $airline = $user->airline;
            if (!$airline || $flight->airline_id !== $airline->id) {
                abort(403);
            }
        }

        $data = $request->validate([
            'flight_number' => 'required|string',
            'scheduled_departure' => 'nullable|string',
            'scheduled_arrival' => 'nullable|string',
            'status' => 'nullable|string',
            'airline_id' => 'nullable|integer',
            'departure_airport_id' => 'required|integer',
            'arrival_airport_id' => 'required|integer',
            'base_price' => 'required|numeric',
            'business_price' => 'nullable|numeric',
        ]);

        // Convert datetime strings to proper format
        if (!empty($data['scheduled_departure'])) {
            $data['scheduled_departure'] = \Carbon\Carbon::parse($data['scheduled_departure'])->format('Y-m-d H:i:s');
        }
        if (!empty($data['scheduled_arrival'])) {
            $data['scheduled_arrival'] = \Carbon\Carbon::parse($data['scheduled_arrival'])->format('Y-m-d H:i:s');
        }

        if ($user && ($user->usertype ?? null) === 'airline') {
            $airline = $user->airline;
            if ($airline) {
                $data['airline_id'] = $airline->id;
            }
        }

        $flight->update($data);

        // Redirect back to dashboard if requested
        if ($request->input('redirect_to') === 'dashboard') {
            return redirect()->route('adminpanel.index')->with('success', 'Flight status updated successfully.');
        }

        return redirect()->route('adminpanel.flights.index');
    }

    public function destroy(Flight $flight)
    {
        $user = Auth::user();

        if ($user && ($user->usertype ?? null) === 'airline') {
            $airline = $user->airline;
            if (!$airline || $flight->airline_id !== $airline->id) {
                abort(403);
            }
        }

        $flight->delete();
        return redirect()->route('adminpanel.flights.index');
    }
}
