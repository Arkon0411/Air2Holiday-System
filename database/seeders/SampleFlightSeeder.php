<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use Carbon\Carbon;

class SampleFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample flight if it doesn't already exist
        Flight::firstOrCreate(
            ['flight_number' => 'PR9001'],
            [
                'scheduled_departure' => Carbon::now()->addDays(3)->setHour(9)->setMinute(0)->setSecond(0),
                'scheduled_arrival' => Carbon::now()->addDays(3)->setHour(11)->setMinute(30)->setSecond(0),
                'status' => 'Scheduled',
                'airline_id' => 1, // Philippine Airlines seeded in SQL
                'departure_airport_id' => 1, // MNL
                'arrival_airport_id' => 2, // CEB
                'base_price' => 2500.00,
                'flight_number' => 'PR9001',
            ]
        );
    }
}
