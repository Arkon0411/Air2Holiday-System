<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Flight;
use App\Models\Booking;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\User;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('update:flights-dec4', function () {
    $this->info('Updating flights and bookings...');

    // 1. Update flights before Dec 4 to landed
    $cutoffDate = Carbon::parse('2025-12-04 23:59:59');
    
    $flightsToUpdate = Flight::where('scheduled_departure', '<=', $cutoffDate)
        ->where('status', '!=', 'landed')
        ->get();

    $count = 0;
    foreach ($flightsToUpdate as $flight) {
        $flight->status = 'landed';
        // Set actual times if missing
        if (!$flight->actual_departure) {
            $flight->actual_departure = $flight->scheduled_departure;
        }
        if (!$flight->actual_arrival) {
            $flight->actual_arrival = $flight->scheduled_arrival ?? Carbon::parse($flight->scheduled_departure)->addHours(2);
        }
        $flight->save();
        $count++;
    }
    $this->info("Updated $count flights to 'landed'.");

    // 2. Update bookings correspondingly
    // Assuming pending bookings for these flights should be confirmed
    $updatedBookings = Booking::whereIn('flight_id', $flightsToUpdate->pluck('id'))
        ->where('status', 'pending')
        ->update(['status' => 'confirmed']);
    
    $this->info("Updated $updatedBookings bookings to 'confirmed'.");

    // 3. Create new bookings and flights for Dec 5 to 7
    $dates = ['2025-12-05', '2025-12-06', '2025-12-07'];
    $airlines = Airline::all();
    $airports = Airport::all();
    $users = User::limit(50)->pluck('id'); // Get some user IDs

    if ($airlines->isEmpty() || $airports->isEmpty()) {
        $this->error('No airlines or airports found.');
        return;
    }

    foreach ($dates as $date) {
        $this->info("Creating flights for $date...");
        // Create 5 flights per day
        for ($i = 0; $i < 5; $i++) {
            $airline = $airlines->random();
            $departure = $airports->random();
            $arrival = $airports->where('id', '!=', $departure->id)->random();
            
            $scheduledDeparture = Carbon::parse($date)->addHours(rand(6, 20))->addMinutes(rand(0, 59));
            $scheduledArrival = (clone $scheduledDeparture)->addHours(rand(1, 12));

            $flight = Flight::create([
                'flight_number' => ($airline->code ?? 'FL') . rand(1000, 9999),
                'scheduled_departure' => $scheduledDeparture,
                'scheduled_arrival' => $scheduledArrival,
                'status' => 'scheduled',
                'airline_id' => $airline->id,
                'departure_airport_id' => $departure->id,
                'arrival_airport_id' => $arrival->id,
                'base_price' => rand(3000, 15000),
                'business_price' => rand(15000, 50000),
            ]);

            // Create bookings for this flight
            $numBookings = rand(2, 5);
            for ($j = 0; $j < $numBookings; $j++) {
                if ($users->isNotEmpty()) {
                    Booking::create([
                        'booking_date' => Carbon::now(),
                        'status' => 'confirmed',
                        'user_id' => $users->random(),
                        'flight_id' => $flight->id,
                        'seat_number' => rand(1, 30) . ['A','B','C','D','E','F'][rand(0,5)],
                        'class' => rand(0, 1) ? 'economy' : 'business',
                    ]);
                }
            }
        }
    }
    $this->info('Done.');
});
