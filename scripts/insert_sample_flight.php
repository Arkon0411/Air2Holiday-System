<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$flightNumber = 'PR9001';
$exists = DB::table('flights')->where('flight_number', $flightNumber)->first();
if ($exists) {
    echo "Sample flight already exists.\n";
    exit;
}

$scheduledDeparture = date('Y-m-d H:i:s', strtotime('+3 days 09:00'));
$scheduledArrival = date('Y-m-d H:i:s', strtotime('+3 days 11:30'));

DB::table('flights')->insert([
    'flight_number' => $flightNumber,
    'scheduled_departure' => $scheduledDeparture,
    'scheduled_arrival' => $scheduledArrival,
    'status' => 'Scheduled',
    'airline_id' => 1,
    'departure_airport_id' => 1,
    'arrival_airport_id' => 2,
    'base_price' => 2500.00,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
]);

echo "Inserted sample flight: $flightNumber (depart: $scheduledDeparture)\n";
