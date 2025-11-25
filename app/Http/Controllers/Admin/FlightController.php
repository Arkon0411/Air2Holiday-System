<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->isAirline()) {
            $flights = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])
                ->whereHas('airline', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
        } else {
            $flights = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])->get();
        }

        $flights = $flights->map(function ($flight) {
            return [
                'id' => $flight->id,
                'flight_number' => $flight->flight_number,
                'scheduled_departure' => $flight->scheduled_departure,
                'scheduled_arrival' => $flight->scheduled_arrival,
                'actual_departure' => $flight->actual_departure,
                'actual_arrival' => $flight->actual_arrival,
                'status' => $flight->status,
                'airline_id' => $flight->airline_id,
                'airline_name' => $flight->airline->name ?? 'N/A',
                'departure_airport_id' => $flight->departure_airport_id,
                'departure_airport_name' => $flight->departureAirport->name ?? 'N/A',
                'arrival_airport_id' => $flight->arrival_airport_id,
                'arrival_airport_name' => $flight->arrivalAirport->name ?? 'N/A',
                'base_price' => $flight->base_price,
                'business_class_price' => $flight->business_class_price,
            ];
        });

        $airlines = Airline::all();
        $airports = Airport::all();

        return view('adminpanel.flights.index', compact('flights', 'airlines', 'airports'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_number' => 'required|string|max:10|unique:flights,flight_number',
            'scheduled_departure' => 'required|date',
            'scheduled_arrival' => 'required|date|after:scheduled_departure',
            'actual_departure' => 'nullable|date',
            'actual_arrival' => 'nullable|date',
            'status' => 'required|string|in:Scheduled,Delayed,Cancelled,Completed',
            'airline_id' => 'required|exists:airlines,id',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'base_price' => 'required|numeric|min:0',
            'business_class_price' => 'nullable|numeric|min:0',
        ]);

        try {
            $user = Auth::user();

            // If airline user, verify they own this airline
            if ($user->isAirline()) {
                $airline = Airline::find($validated['airline_id']);
                if (!$airline || $airline->user_id !== $user->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized airline access'
                    ], 403);
                }
            }

            $flight = Flight::create($validated);
            $flight->load(['airline', 'departureAirport', 'arrivalAirport']);

            return response()->json([
                'success' => true,
                'message' => 'Flight created successfully!',
                'flight' => [
                    'id' => $flight->id,
                    'flight_number' => $flight->flight_number,
                    'scheduled_departure' => $flight->scheduled_departure,
                    'scheduled_arrival' => $flight->scheduled_arrival,
                    'actual_departure' => $flight->actual_departure,
                    'actual_arrival' => $flight->actual_arrival,
                    'status' => $flight->status,
                    'airline_id' => $flight->airline_id,
                    'airline_name' => $flight->airline->name,
                    'departure_airport_id' => $flight->departure_airport_id,
                    'departure_airport_name' => $flight->departureAirport->name,
                    'arrival_airport_id' => $flight->arrival_airport_id,
                    'arrival_airport_name' => $flight->arrivalAirport->name,
                    'base_price' => $flight->base_price,
                    'business_class_price' => $flight->business_class_price,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating flight: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Flight $flight)
    {
        $user = Auth::user();

        // Check authorization for airline users
        if ($user->isAirline()) {
            $airline = $flight->airline;
            if (!$airline || $airline->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }
        }

        return response()->json([
            'id' => $flight->id,
            'flight_number' => $flight->flight_number,
            'scheduled_departure' => $flight->scheduled_departure,
            'scheduled_arrival' => $flight->scheduled_arrival,
            'actual_departure' => $flight->actual_departure,
            'actual_arrival' => $flight->actual_arrival,
            'status' => $flight->status,
            'airline_id' => $flight->airline_id,
            'departure_airport_id' => $flight->departure_airport_id,
            'arrival_airport_id' => $flight->arrival_airport_id,
            'base_price' => $flight->base_price,
            'business_class_price' => $flight->business_class_price,
        ]);
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'flight_number' => 'required|string|max:10|unique:flights,flight_number,' . $flight->id,
            'scheduled_departure' => 'required|date',
            'scheduled_arrival' => 'required|date|after:scheduled_departure',
            'actual_departure' => 'nullable|date',
            'actual_arrival' => 'nullable|date',
            'status' => 'required|string|in:Scheduled,Delayed,Cancelled,Completed',
            'airline_id' => 'required|exists:airlines,id',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'base_price' => 'required|numeric|min:0',
            'business_class_price' => 'nullable|numeric|min:0',
        ]);

        try {
            $user = Auth::user();

            // If airline user, verify they own this airline
            if ($user->isAirline()) {
                $airline = Airline::find($validated['airline_id']);
                if (!$airline || $airline->user_id !== $user->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized airline access'
                    ], 403);
                }
            }

            $flight->update($validated);
            $flight->load(['airline', 'departureAirport', 'arrivalAirport']);

            return response()->json([
                'success' => true,
                'message' => 'Flight updated successfully!',
                'flight' => [
                    'id' => $flight->id,
                    'flight_number' => $flight->flight_number,
                    'scheduled_departure' => $flight->scheduled_departure,
                    'scheduled_arrival' => $flight->scheduled_arrival,
                    'actual_departure' => $flight->actual_departure,
                    'actual_arrival' => $flight->actual_arrival,
                    'status' => $flight->status,
                    'airline_id' => $flight->airline_id,
                    'airline_name' => $flight->airline->name,
                    'departure_airport_id' => $flight->departure_airport_id,
                    'departure_airport_name' => $flight->departureAirport->name,
                    'arrival_airport_id' => $flight->arrival_airport_id,
                    'arrival_airport_name' => $flight->arrivalAirport->name,
                    'base_price' => $flight->base_price,
                    'business_class_price' => $flight->business_class_price,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating flight: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Flight $flight)
    {
        try {
            $user = Auth::user();

            // Check authorization for airline users
            if ($user->isAirline()) {
                $airline = $flight->airline;
                if (!$airline || $airline->user_id !== $user->id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized'
                    ], 403);
                }
            }

            $flight->delete();

            return response()->json([
                'success' => true,
                'message' => 'Flight deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting flight: ' . $e->getMessage()
            ], 500);
        }
    }
}
