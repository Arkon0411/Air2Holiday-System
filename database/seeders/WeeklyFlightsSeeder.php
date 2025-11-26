<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Airport;

class WeeklyFlightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 flights scheduled for this week to next week
        for ($i = 0; $i < 20; $i++) {
            $airline = Airline::inRandomOrder()->first();
            $departureAirport = Airport::inRandomOrder()->first();
            $arrivalAirport = Airport::where('id', '!=', $departureAirport->id)->inRandomOrder()->first();
            
            // Random departure time between now and 7 days from now
            $scheduledDeparture = now()->addDays(rand(0, 7))->addHours(rand(0, 23))->addMinutes(rand(0, 59));
            
            // Flight duration between 1-12 hours
            $flightHours = rand(1, 12);
            $scheduledArrival = (clone $scheduledDeparture)->addHours($flightHours);
            
            // Generate flight number
            $flightNumber = strtoupper(substr($airline->name, 0, 2)) . rand(100, 9999);
            
            Flight::create([
                'flight_number' => $flightNumber,
                'airline_id' => $airline->id,
                'departure_airport_id' => $departureAirport->id,
                'arrival_airport_id' => $arrivalAirport->id,
                'scheduled_departure' => $scheduledDeparture,
                'scheduled_arrival' => $scheduledArrival,
                'actual_departure' => null,
                'actual_arrival' => null,
                'status' => 'scheduled',
                'base_price' => rand(5000, 50000),
                'business_price' => rand(25000, 150000),
            ]);
        }
        
        $this->command->info('Successfully created 20 flights for this week to next week');
    }
}
