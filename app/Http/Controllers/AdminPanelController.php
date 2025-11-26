<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAirline()) {
            return $this->airlineDashboard();
        }

        return $this->adminDashboard();
    }

    private function adminDashboard()
    {
        // Get today's date
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Database statistics
        $stats = [
            'total_flights' => Flight::count(),
            'total_bookings' => Booking::count(),
            'total_users' => User::where('usertype', 'user')->count(),
            'total_airlines' => Airline::count(),
            'total_airports' => Airport::count(),
            'active_flights_today' => Flight::whereDate('scheduled_departure', $today)
                ->whereIn('status', ['scheduled', 'boarding', 'departed'])
                ->count(),
            'total_revenue' => Booking::where('bookings.status', 'confirmed')
                ->join('flights', 'bookings.flight_id', '=', 'flights.id')
                ->selectRaw('SUM(CASE WHEN bookings.class = "business" THEN flights.business_price ELSE flights.base_price END) as total')
                ->value('total') ?? 0,
            'bookings_this_month' => Booking::whereBetween('bookings.booking_date', [$startOfMonth, $endOfMonth])
                ->count(),
        ];

        // Booking trends (last 7 days)
        $bookingTrends = Booking::selectRaw('DATE(bookings.booking_date) as date, COUNT(*) as count')
            ->where('bookings.booking_date', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Revenue by airline
        $revenueByAirline = Booking::where('bookings.status', 'confirmed')
            ->join('flights', 'bookings.flight_id', '=', 'flights.id')
            ->join('airlines', 'flights.airline_id', '=', 'airlines.id')
            ->selectRaw('airlines.name, SUM(CASE WHEN bookings.class = "business" THEN flights.business_price ELSE flights.base_price END) as revenue')
            ->groupBy('airlines.id', 'airlines.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        // Booking status distribution
        $bookingStatusDistribution = Booking::selectRaw('bookings.status, COUNT(*) as count')
            ->groupBy('bookings.status')
            ->get();

        // Popular routes (top 5)
        $popularRoutes = Flight::select(
                'departure_airport.name as departure',
                'arrival_airport.name as arrival',
                DB::raw('COUNT(bookings.id) as booking_count')
            )
            ->join('airports as departure_airport', 'flights.departure_airport_id', '=', 'departure_airport.id')
            ->join('airports as arrival_airport', 'flights.arrival_airport_id', '=', 'arrival_airport.id')
            ->leftJoin('bookings', 'flights.id', '=', 'bookings.flight_id')
            ->groupBy('flights.departure_airport_id', 'flights.arrival_airport_id', 'departure_airport.name', 'arrival_airport.name')
            ->orderByDesc('booking_count')
            ->limit(5)
            ->get();

        // Today's flights with management panel
        $todaysFlights = Flight::with(['airline', 'departureAirport', 'arrivalAirport', 'bookings'])
            ->whereDate('scheduled_departure', $today)
            ->orderBy('scheduled_departure')
            ->get();

        return view('adminpanel.index', compact(
            'stats',
            'bookingTrends',
            'revenueByAirline',
            'bookingStatusDistribution',
            'popularRoutes',
            'todaysFlights'
        ));
    }

    private function airlineDashboard()
    {
        $user = auth()->user();
        $airline = $user->airline;

        if (!$airline) {
            abort(403, 'No airline associated with this account');
        }

        // Get today's date
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Airline-specific statistics
        $stats = [
            'total_flights' => Flight::where('airline_id', $airline->id)->count(),
            'total_bookings' => Booking::whereHas('flight', function ($query) use ($airline) {
                $query->where('airline_id', $airline->id);
            })->count(),
            'active_flights_today' => Flight::where('airline_id', $airline->id)
                ->whereDate('scheduled_departure', $today)
                ->whereIn('status', ['scheduled', 'boarding', 'departed'])
                ->count(),
            'total_revenue' => Booking::where('bookings.status', 'confirmed')
                ->join('flights', 'bookings.flight_id', '=', 'flights.id')
                ->where('flights.airline_id', $airline->id)
                ->selectRaw('SUM(CASE WHEN bookings.class = "business" THEN flights.business_price ELSE flights.base_price END) as total')
                ->value('total') ?? 0,
            'revenue_this_month' => Booking::where('bookings.status', 'confirmed')
                ->whereBetween('bookings.booking_date', [$startOfMonth, $endOfMonth])
                ->join('flights', 'bookings.flight_id', '=', 'flights.id')
                ->where('flights.airline_id', $airline->id)
                ->selectRaw('SUM(CASE WHEN bookings.class = "business" THEN flights.business_price ELSE flights.base_price END) as total')
                ->value('total') ?? 0,
            'bookings_this_month' => Booking::whereBetween('bookings.booking_date', [$startOfMonth, $endOfMonth])
                ->whereHas('flight', function ($query) use ($airline) {
                    $query->where('airline_id', $airline->id);
                })
                ->count(),
        ];

        // Revenue trends (last 7 days)
        $revenueTrends = Booking::selectRaw('DATE(bookings.booking_date) as date, SUM(CASE WHEN bookings.class = "business" THEN flights.business_price ELSE flights.base_price END) as revenue')
            ->join('flights', 'bookings.flight_id', '=', 'flights.id')
            ->where('flights.airline_id', $airline->id)
            ->where('bookings.status', 'confirmed')
            ->where('bookings.booking_date', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Booking trends (last 7 days)
        $bookingTrends = Booking::selectRaw('DATE(bookings.booking_date) as date, COUNT(*) as count')
            ->join('flights', 'bookings.flight_id', '=', 'flights.id')
            ->where('flights.airline_id', $airline->id)
            ->where('bookings.booking_date', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Class distribution (economy vs business)
        $classDistribution = Booking::selectRaw('bookings.class, COUNT(*) as count')
            ->join('flights', 'bookings.flight_id', '=', 'flights.id')
            ->where('flights.airline_id', $airline->id)
            ->groupBy('bookings.class')
            ->get();

        // Popular routes for this airline
        $popularRoutes = Flight::select(
                'departure_airport.name as departure',
                'arrival_airport.name as arrival',
                DB::raw('COUNT(bookings.id) as booking_count'),
                DB::raw('SUM(CASE WHEN bookings.class = "business" THEN flights.business_price ELSE flights.base_price END) as revenue')
            )
            ->join('airports as departure_airport', 'flights.departure_airport_id', '=', 'departure_airport.id')
            ->join('airports as arrival_airport', 'flights.arrival_airport_id', '=', 'arrival_airport.id')
            ->leftJoin('bookings', function ($join) {
                $join->on('flights.id', '=', 'bookings.flight_id')
                    ->where('bookings.status', '=', 'confirmed');
            })
            ->where('flights.airline_id', $airline->id)
            ->groupBy('flights.departure_airport_id', 'flights.arrival_airport_id', 'departure_airport.name', 'arrival_airport.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        // Today's flights for this airline
        $todaysFlights = Flight::with(['departureAirport', 'arrivalAirport', 'bookings'])
            ->where('airline_id', $airline->id)
            ->whereDate('scheduled_departure', $today)
            ->orderBy('scheduled_departure')
            ->get();

        return view('adminpanel.index', compact(
            'stats',
            'revenueTrends',
            'bookingTrends',
            'classDistribution',
            'popularRoutes',
            'todaysFlights',
            'airline'
        ));
    }
}
