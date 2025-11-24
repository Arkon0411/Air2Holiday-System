<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;

class FlightAdminController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();
        $flights = Flight::with('departureAirport','arrivalAirport')->orderBy('scheduled_departure')->get();
        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        $airports = \App\Models\Airport::orderBy('name')->get();
        return view('admin.flights.create', compact('airports'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $data = $request->validate([
            'flight_number' => 'required|string',
            'departure_airport_id' => 'required|integer',
            'arrival_airport_id' => 'required|integer|different:departure_airport_id',
            'scheduled_departure' => 'required|date',
            'scheduled_arrival' => 'required|date',
            'base_price' => 'required|numeric'
        ]);

        Flight::create($data + ['status' => 'scheduled']);
        return redirect()->route('admin.flights.index')->with('success','Flight created');
    }

    protected function authorizeAdmin()
    {
        $user = auth()->user();
        if (! $user || ($user->role ?? 'customer') !== 'admin') {
            abort(403);
        }
    }
}
