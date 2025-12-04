<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update all flights before December 4 to 'landed' status
        DB::table('flights')
            ->where('scheduled_departure', '<', '2025-12-04 00:00:00')
            ->update(['status' => 'landed']);

        // Insert new flights for December 5-7, 2025
        // These flights include routes to/from: Beijing, Bohol, Cagayan, Capiz, Hong Kong, Zamboanga, Pampanga, Palawan, Negros Occidental, Leyte

        $flights = [
            // PHILIPPINE AIRLINES (PR) - Domestic flights to secondary/tertiary airports
            // PR flights from MNL to Bohol (TAG - id 12)
            ['flight_number' => 'PR2401', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-05 14:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 12, 'base_price' => 2500.00, 'business_price' => 3750.00],
            ['flight_number' => 'PR2402', 'scheduled_departure' => '2025-12-06 13:30:00', 'scheduled_arrival' => '2025-12-06 15:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 12, 'base_price' => 2500.00, 'business_price' => 3750.00],
            ['flight_number' => 'PR2403', 'scheduled_departure' => '2025-12-07 14:00:00', 'scheduled_arrival' => '2025-12-07 15:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 12, 'base_price' => 2500.00, 'business_price' => 3750.00],

            // PR flights from Bohol (TAG) to MNL
            ['flight_number' => 'PR2404', 'scheduled_departure' => '2025-12-05 15:30:00', 'scheduled_arrival' => '2025-12-05 17:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 12, 'arrival_airport_id' => 1, 'base_price' => 2500.00, 'business_price' => 3750.00],
            ['flight_number' => 'PR2405', 'scheduled_departure' => '2025-12-06 15:45:00', 'scheduled_arrival' => '2025-12-06 17:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 12, 'arrival_airport_id' => 1, 'base_price' => 2500.00, 'business_price' => 3750.00],
            ['flight_number' => 'PR2406', 'scheduled_departure' => '2025-12-07 16:00:00', 'scheduled_arrival' => '2025-12-07 17:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 12, 'arrival_airport_id' => 1, 'base_price' => 2500.00, 'business_price' => 3750.00],

            // PR flights from MNL to Cagayan (TUG - id 15)
            ['flight_number' => 'PR2407', 'scheduled_departure' => '2025-12-05 13:15:00', 'scheduled_arrival' => '2025-12-05 14:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 15, 'base_price' => 2200.00, 'business_price' => 3300.00],
            ['flight_number' => 'PR2408', 'scheduled_departure' => '2025-12-06 13:45:00', 'scheduled_arrival' => '2025-12-06 15:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 15, 'base_price' => 2200.00, 'business_price' => 3300.00],
            ['flight_number' => 'PR2409', 'scheduled_departure' => '2025-12-07 14:15:00', 'scheduled_arrival' => '2025-12-07 15:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 15, 'base_price' => 2200.00, 'business_price' => 3300.00],

            // PR flights from Cagayan (TUG) to MNL
            ['flight_number' => 'PR2410', 'scheduled_departure' => '2025-12-05 15:00:00', 'scheduled_arrival' => '2025-12-05 16:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 15, 'arrival_airport_id' => 1, 'base_price' => 2200.00, 'business_price' => 3300.00],
            ['flight_number' => 'PR2411', 'scheduled_departure' => '2025-12-06 15:30:00', 'scheduled_arrival' => '2025-12-06 16:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 15, 'arrival_airport_id' => 1, 'base_price' => 2200.00, 'business_price' => 3300.00],
            ['flight_number' => 'PR2412', 'scheduled_departure' => '2025-12-07 16:00:00', 'scheduled_arrival' => '2025-12-07 17:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 15, 'arrival_airport_id' => 1, 'base_price' => 2200.00, 'business_price' => 3300.00],

            // PR flights from MNL to Capiz (RXS - id 14)
            ['flight_number' => 'PR2413', 'scheduled_departure' => '2025-12-05 13:30:00', 'scheduled_arrival' => '2025-12-05 15:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 14, 'base_price' => 2400.00, 'business_price' => 3600.00],
            ['flight_number' => 'PR2414', 'scheduled_departure' => '2025-12-06 14:00:00', 'scheduled_arrival' => '2025-12-06 15:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 14, 'base_price' => 2400.00, 'business_price' => 3600.00],
            ['flight_number' => 'PR2415', 'scheduled_departure' => '2025-12-07 14:30:00', 'scheduled_arrival' => '2025-12-07 16:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 14, 'base_price' => 2400.00, 'business_price' => 3600.00],

            // PR flights from Capiz (RXS) to MNL
            ['flight_number' => 'PR2416', 'scheduled_departure' => '2025-12-05 15:15:00', 'scheduled_arrival' => '2025-12-05 16:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 14, 'arrival_airport_id' => 1, 'base_price' => 2400.00, 'business_price' => 3600.00],
            ['flight_number' => 'PR2417', 'scheduled_departure' => '2025-12-06 15:45:00', 'scheduled_arrival' => '2025-12-06 17:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 14, 'arrival_airport_id' => 1, 'base_price' => 2400.00, 'business_price' => 3600.00],
            ['flight_number' => 'PR2418', 'scheduled_departure' => '2025-12-07 16:15:00', 'scheduled_arrival' => '2025-12-07 17:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 14, 'arrival_airport_id' => 1, 'base_price' => 2400.00, 'business_price' => 3600.00],

            // PR flights from MNL to Zamboanga (ZAM - id 9)
            ['flight_number' => 'PR2419', 'scheduled_departure' => '2025-12-05 13:45:00', 'scheduled_arrival' => '2025-12-05 15:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 9, 'base_price' => 3100.00, 'business_price' => 4650.00],
            ['flight_number' => 'PR2420', 'scheduled_departure' => '2025-12-06 14:15:00', 'scheduled_arrival' => '2025-12-06 16:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 9, 'base_price' => 3100.00, 'business_price' => 4650.00],
            ['flight_number' => 'PR2421', 'scheduled_departure' => '2025-12-07 14:45:00', 'scheduled_arrival' => '2025-12-07 16:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 9, 'base_price' => 3100.00, 'business_price' => 4650.00],

            // PR flights from Zamboanga (ZAM) to MNL
            ['flight_number' => 'PR2422', 'scheduled_departure' => '2025-12-05 16:00:00', 'scheduled_arrival' => '2025-12-05 17:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 9, 'arrival_airport_id' => 1, 'base_price' => 3100.00, 'business_price' => 4650.00],
            ['flight_number' => 'PR2423', 'scheduled_departure' => '2025-12-06 16:30:00', 'scheduled_arrival' => '2025-12-06 18:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 9, 'arrival_airport_id' => 1, 'base_price' => 3100.00, 'business_price' => 4650.00],
            ['flight_number' => 'PR2424', 'scheduled_departure' => '2025-12-07 17:00:00', 'scheduled_arrival' => '2025-12-07 18:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 9, 'arrival_airport_id' => 1, 'base_price' => 3100.00, 'business_price' => 4650.00],

            // PR flights from MNL to Pampanga (CRK - id 11)
            ['flight_number' => 'PR2425', 'scheduled_departure' => '2025-12-05 14:00:00', 'scheduled_arrival' => '2025-12-05 14:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 11, 'base_price' => 1800.00, 'business_price' => 2700.00],
            ['flight_number' => 'PR2426', 'scheduled_departure' => '2025-12-06 14:30:00', 'scheduled_arrival' => '2025-12-06 15:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 11, 'base_price' => 1800.00, 'business_price' => 2700.00],
            ['flight_number' => 'PR2427', 'scheduled_departure' => '2025-12-07 15:00:00', 'scheduled_arrival' => '2025-12-07 15:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 11, 'base_price' => 1800.00, 'business_price' => 2700.00],

            // PR flights from Pampanga (CRK) to MNL
            ['flight_number' => 'PR2428', 'scheduled_departure' => '2025-12-05 15:15:00', 'scheduled_arrival' => '2025-12-05 16:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 11, 'arrival_airport_id' => 1, 'base_price' => 1800.00, 'business_price' => 2700.00],
            ['flight_number' => 'PR2429', 'scheduled_departure' => '2025-12-06 15:45:00', 'scheduled_arrival' => '2025-12-06 16:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 11, 'arrival_airport_id' => 1, 'base_price' => 1800.00, 'business_price' => 2700.00],
            ['flight_number' => 'PR2430', 'scheduled_departure' => '2025-12-07 16:15:00', 'scheduled_arrival' => '2025-12-07 17:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 11, 'arrival_airport_id' => 1, 'base_price' => 1800.00, 'business_price' => 2700.00],

            // PR flights from MNL to Palawan (PPS - id 10)
            ['flight_number' => 'PR2431', 'scheduled_departure' => '2025-12-05 14:15:00', 'scheduled_arrival' => '2025-12-05 16:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 10, 'base_price' => 2900.00, 'business_price' => 4350.00],
            ['flight_number' => 'PR2432', 'scheduled_departure' => '2025-12-06 14:45:00', 'scheduled_arrival' => '2025-12-06 16:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 10, 'base_price' => 2900.00, 'business_price' => 4350.00],
            ['flight_number' => 'PR2433', 'scheduled_departure' => '2025-12-07 15:15:00', 'scheduled_arrival' => '2025-12-07 17:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 10, 'base_price' => 2900.00, 'business_price' => 4350.00],

            // PR flights from Palawan (PPS) to MNL
            ['flight_number' => 'PR2434', 'scheduled_departure' => '2025-12-05 16:30:00', 'scheduled_arrival' => '2025-12-05 18:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 10, 'arrival_airport_id' => 1, 'base_price' => 2900.00, 'business_price' => 4350.00],
            ['flight_number' => 'PR2435', 'scheduled_departure' => '2025-12-06 17:00:00', 'scheduled_arrival' => '2025-12-06 18:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 10, 'arrival_airport_id' => 1, 'base_price' => 2900.00, 'business_price' => 4350.00],
            ['flight_number' => 'PR2436', 'scheduled_departure' => '2025-12-07 17:30:00', 'scheduled_arrival' => '2025-12-07 19:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 10, 'arrival_airport_id' => 1, 'base_price' => 2900.00, 'business_price' => 4350.00],

            // PR flights from MNL to Negros Occidental (BCD - id 7)
            ['flight_number' => 'PR2437', 'scheduled_departure' => '2025-12-05 14:30:00', 'scheduled_arrival' => '2025-12-05 16:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 7, 'base_price' => 2700.00, 'business_price' => 4050.00],
            ['flight_number' => 'PR2438', 'scheduled_departure' => '2025-12-06 15:00:00', 'scheduled_arrival' => '2025-12-06 16:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 7, 'base_price' => 2700.00, 'business_price' => 4050.00],
            ['flight_number' => 'PR2439', 'scheduled_departure' => '2025-12-07 15:30:00', 'scheduled_arrival' => '2025-12-07 17:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 7, 'base_price' => 2700.00, 'business_price' => 4050.00],

            // PR flights from Negros Occidental (BCD) to MNL
            ['flight_number' => 'PR2440', 'scheduled_departure' => '2025-12-05 16:15:00', 'scheduled_arrival' => '2025-12-05 17:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 7, 'arrival_airport_id' => 1, 'base_price' => 2700.00, 'business_price' => 4050.00],
            ['flight_number' => 'PR2441', 'scheduled_departure' => '2025-12-06 16:45:00', 'scheduled_arrival' => '2025-12-06 18:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 7, 'arrival_airport_id' => 1, 'base_price' => 2700.00, 'business_price' => 4050.00],
            ['flight_number' => 'PR2442', 'scheduled_departure' => '2025-12-07 17:15:00', 'scheduled_arrival' => '2025-12-07 18:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 7, 'arrival_airport_id' => 1, 'base_price' => 2700.00, 'business_price' => 4050.00],

            // PR flights from MNL to Leyte (TAC - id 8)
            ['flight_number' => 'PR2443', 'scheduled_departure' => '2025-12-05 14:45:00', 'scheduled_arrival' => '2025-12-05 16:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 8, 'base_price' => 2600.00, 'business_price' => 3900.00],
            ['flight_number' => 'PR2444', 'scheduled_departure' => '2025-12-06 15:15:00', 'scheduled_arrival' => '2025-12-06 16:45:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 8, 'base_price' => 2600.00, 'business_price' => 3900.00],
            ['flight_number' => 'PR2445', 'scheduled_departure' => '2025-12-07 15:45:00', 'scheduled_arrival' => '2025-12-07 17:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 1, 'arrival_airport_id' => 8, 'base_price' => 2600.00, 'business_price' => 3900.00],

            // PR flights from Leyte (TAC) to MNL
            ['flight_number' => 'PR2446', 'scheduled_departure' => '2025-12-05 16:45:00', 'scheduled_arrival' => '2025-12-05 18:15:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 8, 'arrival_airport_id' => 1, 'base_price' => 2600.00, 'business_price' => 3900.00],
            ['flight_number' => 'PR2447', 'scheduled_departure' => '2025-12-06 17:00:00', 'scheduled_arrival' => '2025-12-06 18:30:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 8, 'arrival_airport_id' => 1, 'base_price' => 2600.00, 'business_price' => 3900.00],
            ['flight_number' => 'PR2448', 'scheduled_departure' => '2025-12-07 17:30:00', 'scheduled_arrival' => '2025-12-07 19:00:00', 'status' => 'scheduled', 'airline_id' => 1, 'departure_airport_id' => 8, 'arrival_airport_id' => 1, 'base_price' => 2600.00, 'business_price' => 3900.00],

            // INTERNATIONAL FLIGHTS TO HONG KONG & BEIJING
            // American Airlines to Hong Kong (HKG - id 17)
            ['flight_number' => 'AA2511', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-06 09:00:00', 'status' => 'scheduled', 'airline_id' => 2, 'departure_airport_id' => 20, 'arrival_airport_id' => 17, 'base_price' => 35000.00, 'business_price' => 52500.00],
            ['flight_number' => 'AA2512', 'scheduled_departure' => '2025-12-07 14:00:00', 'scheduled_arrival' => '2025-12-08 10:00:00', 'status' => 'scheduled', 'airline_id' => 2, 'departure_airport_id' => 20, 'arrival_airport_id' => 17, 'base_price' => 36000.00, 'business_price' => 54000.00],

            // American Airlines to Beijing (PEK - id 21)
            ['flight_number' => 'AA2513', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-06 11:00:00', 'status' => 'scheduled', 'airline_id' => 2, 'departure_airport_id' => 20, 'arrival_airport_id' => 21, 'base_price' => 38000.00, 'business_price' => 57000.00],
            ['flight_number' => 'AA2514', 'scheduled_departure' => '2025-12-06 15:00:00', 'scheduled_arrival' => '2025-12-07 13:00:00', 'status' => 'scheduled', 'airline_id' => 2, 'departure_airport_id' => 20, 'arrival_airport_id' => 21, 'base_price' => 38500.00, 'business_price' => 57750.00],

            // Japanese Airlines to Hong Kong (HKG)
            ['flight_number' => 'JL2513', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-05 15:00:00', 'status' => 'scheduled', 'airline_id' => 3, 'departure_airport_id' => 18, 'arrival_airport_id' => 17, 'base_price' => 12500.00, 'business_price' => 18750.00],
            ['flight_number' => 'JL2514', 'scheduled_departure' => '2025-12-06 14:30:00', 'scheduled_arrival' => '2025-12-06 16:30:00', 'status' => 'scheduled', 'airline_id' => 3, 'departure_airport_id' => 18, 'arrival_airport_id' => 17, 'base_price' => 12800.00, 'business_price' => 19200.00],
            ['flight_number' => 'JL2515', 'scheduled_departure' => '2025-12-07 13:15:00', 'scheduled_arrival' => '2025-12-07 15:15:00', 'status' => 'scheduled', 'airline_id' => 3, 'departure_airport_id' => 18, 'arrival_airport_id' => 17, 'base_price' => 12700.00, 'business_price' => 19050.00],

            // Japanese Airlines to Beijing (PEK)
            ['flight_number' => 'JL2516', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-05 14:30:00', 'status' => 'scheduled', 'airline_id' => 3, 'departure_airport_id' => 18, 'arrival_airport_id' => 21, 'base_price' => 9500.00, 'business_price' => 14250.00],
            ['flight_number' => 'JL2517', 'scheduled_departure' => '2025-12-06 14:00:00', 'scheduled_arrival' => '2025-12-06 15:30:00', 'status' => 'scheduled', 'airline_id' => 3, 'departure_airport_id' => 18, 'arrival_airport_id' => 21, 'base_price' => 9800.00, 'business_price' => 14700.00],
            ['flight_number' => 'JL2518', 'scheduled_departure' => '2025-12-07 13:30:00', 'scheduled_arrival' => '2025-12-07 15:00:00', 'status' => 'scheduled', 'airline_id' => 3, 'departure_airport_id' => 18, 'arrival_airport_id' => 21, 'base_price' => 9700.00, 'business_price' => 14550.00],

            // Singapore Airlines to Hong Kong (HKG)
            ['flight_number' => 'SQ2513', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-05 14:30:00', 'status' => 'scheduled', 'airline_id' => 4, 'departure_airport_id' => 16, 'arrival_airport_id' => 17, 'base_price' => 8500.00, 'business_price' => 12750.00],
            ['flight_number' => 'SQ2514', 'scheduled_departure' => '2025-12-06 14:30:00', 'scheduled_arrival' => '2025-12-06 16:00:00', 'status' => 'scheduled', 'airline_id' => 4, 'departure_airport_id' => 16, 'arrival_airport_id' => 17, 'base_price' => 8800.00, 'business_price' => 13200.00],
            ['flight_number' => 'SQ2515', 'scheduled_departure' => '2025-12-07 13:15:00', 'scheduled_arrival' => '2025-12-07 14:45:00', 'status' => 'scheduled', 'airline_id' => 4, 'departure_airport_id' => 16, 'arrival_airport_id' => 17, 'base_price' => 8700.00, 'business_price' => 13050.00],

            // Singapore Airlines to Beijing (PEK)
            ['flight_number' => 'SQ2516', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-05 15:30:00', 'status' => 'scheduled', 'airline_id' => 4, 'departure_airport_id' => 16, 'arrival_airport_id' => 21, 'base_price' => 6500.00, 'business_price' => 9750.00],
            ['flight_number' => 'SQ2517', 'scheduled_departure' => '2025-12-06 14:00:00', 'scheduled_arrival' => '2025-12-06 16:30:00', 'status' => 'scheduled', 'airline_id' => 4, 'departure_airport_id' => 16, 'arrival_airport_id' => 21, 'base_price' => 6800.00, 'business_price' => 10200.00],
            ['flight_number' => 'SQ2518', 'scheduled_departure' => '2025-12-07 13:30:00', 'scheduled_arrival' => '2025-12-07 16:00:00', 'status' => 'scheduled', 'airline_id' => 4, 'departure_airport_id' => 16, 'arrival_airport_id' => 21, 'base_price' => 6700.00, 'business_price' => 10050.00],

            // Korean Air to Hong Kong (HKG)
            ['flight_number' => 'KE2513', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-05 14:30:00', 'status' => 'scheduled', 'airline_id' => 5, 'departure_airport_id' => 19, 'arrival_airport_id' => 17, 'base_price' => 8200.00, 'business_price' => 12300.00],
            ['flight_number' => 'KE2514', 'scheduled_departure' => '2025-12-06 14:30:00', 'scheduled_arrival' => '2025-12-06 16:00:00', 'status' => 'scheduled', 'airline_id' => 5, 'departure_airport_id' => 19, 'arrival_airport_id' => 17, 'base_price' => 8500.00, 'business_price' => 12750.00],
            ['flight_number' => 'KE2515', 'scheduled_departure' => '2025-12-07 13:15:00', 'scheduled_arrival' => '2025-12-07 14:45:00', 'status' => 'scheduled', 'airline_id' => 5, 'departure_airport_id' => 19, 'arrival_airport_id' => 17, 'base_price' => 8400.00, 'business_price' => 12600.00],

            // Korean Air to Beijing (PEK)
            ['flight_number' => 'KE2516', 'scheduled_departure' => '2025-12-05 13:00:00', 'scheduled_arrival' => '2025-12-05 14:30:00', 'status' => 'scheduled', 'airline_id' => 5, 'departure_airport_id' => 19, 'arrival_airport_id' => 21, 'base_price' => 5500.00, 'business_price' => 8250.00],
            ['flight_number' => 'KE2517', 'scheduled_departure' => '2025-12-06 14:30:00', 'scheduled_arrival' => '2025-12-06 16:00:00', 'status' => 'scheduled', 'airline_id' => 5, 'departure_airport_id' => 19, 'arrival_airport_id' => 21, 'base_price' => 5800.00, 'business_price' => 8700.00],
            ['flight_number' => 'KE2518', 'scheduled_departure' => '2025-12-07 13:15:00', 'scheduled_arrival' => '2025-12-07 14:45:00', 'status' => 'scheduled', 'airline_id' => 5, 'departure_airport_id' => 19, 'arrival_airport_id' => 21, 'base_price' => 5700.00, 'business_price' => 8550.00],
        ];

        foreach ($flights as $flight) {
            DB::table('flights')->insert([
                'flight_number' => $flight['flight_number'],
                'scheduled_departure' => $flight['scheduled_departure'],
                'scheduled_arrival' => $flight['scheduled_arrival'],
                'status' => $flight['status'],
                'airline_id' => $flight['airline_id'],
                'departure_airport_id' => $flight['departure_airport_id'],
                'arrival_airport_id' => $flight['arrival_airport_id'],
                'base_price' => $flight['base_price'],
                'business_price' => $flight['business_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert booking records with payments (using auto-increment, not explicit IDs)
        $payments = [
            ['amount' => 2500.00, 'method' => 'Credit Card', 'status' => 'Paid'],
            ['amount' => 3100.00, 'method' => 'GCash', 'status' => 'Paid'],
            ['amount' => 2900.00, 'method' => 'Debit Card', 'status' => 'Paid'],
            ['amount' => 2400.00, 'method' => 'PayMaya', 'status' => 'Paid'],
            ['amount' => 2200.00, 'method' => 'Credit Card', 'status' => 'Paid'],
            ['amount' => 1800.00, 'method' => 'GCash', 'status' => 'Paid'],
            ['amount' => 2600.00, 'method' => 'Debit Card', 'status' => 'Paid'],
            ['amount' => 2700.00, 'method' => 'Credit Card', 'status' => 'Paid'],
            ['amount' => 35000.00, 'method' => 'PayMaya', 'status' => 'Paid'],
            ['amount' => 12500.00, 'method' => 'GCash', 'status' => 'Paid'],
            ['amount' => 8500.00, 'method' => 'Debit Card', 'status' => 'Paid'],
            ['amount' => 5500.00, 'method' => 'Credit Card', 'status' => 'Paid'],
        ];

        $paymentIds = [];
        foreach ($payments as $payment) {
            $id = DB::table('payments')->insertGetId([
                'amount' => $payment['amount'],
                'method' => $payment['method'],
                'payment_date' => now(),
                'status' => $payment['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $paymentIds[] = $id;
        }

        // Insert bookings for users
        $bookings = [
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 1, 'payment_index' => 0, 'flight_id' => 115, 'seat_number' => '2A', 'class' => 'economy'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 4, 'payment_index' => 1, 'flight_id' => 125, 'seat_number' => '2B', 'class' => 'economy'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 5, 'payment_index' => 2, 'flight_id' => 135, 'seat_number' => '2C', 'class' => 'economy'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 6, 'payment_index' => 3, 'flight_id' => 145, 'seat_number' => '2D', 'class' => 'business'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 7, 'payment_index' => 4, 'flight_id' => 155, 'seat_number' => '2E', 'class' => 'economy'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 8, 'payment_index' => 5, 'flight_id' => 165, 'seat_number' => '2F', 'class' => 'business'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 9, 'payment_index' => 6, 'flight_id' => 175, 'seat_number' => '3C', 'class' => 'economy'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 13, 'payment_index' => 7, 'flight_id' => 185, 'seat_number' => '3D', 'class' => 'economy'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 14, 'payment_index' => 8, 'flight_id' => 195, 'seat_number' => '3E', 'class' => 'business'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 15, 'payment_index' => 9, 'flight_id' => 205, 'seat_number' => '3F', 'class' => 'economy'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 17, 'payment_index' => 10, 'flight_id' => 215, 'seat_number' => '4A', 'class' => 'economy'],
            ['booking_date' => now(), 'status' => 'confirmed', 'user_id' => 18, 'payment_index' => 11, 'flight_id' => 225, 'seat_number' => '4B', 'class' => 'business'],
        ];

        foreach ($bookings as $booking) {
            DB::table('bookings')->insert([
                'booking_date' => $booking['booking_date'],
                'status' => $booking['status'],
                'user_id' => $booking['user_id'],
                'payment_id' => $paymentIds[$booking['payment_index']],
                'flight_id' => $booking['flight_id'],
                'seat_number' => $booking['seat_number'],
                'class' => $booking['class'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete inserted flights (starting from ID after existing ones)
        DB::table('flights')->where('flight_number', 'like', 'PR24%')
            ->orWhere('flight_number', 'like', 'AA25%')
            ->orWhere('flight_number', 'like', 'JL25%')
            ->orWhere('flight_number', 'like', 'SQ25%')
            ->orWhere('flight_number', 'like', 'KE25%')
            ->delete();

        // Delete inserted payments
        DB::table('payments')->whereBetween('id', [94, 105])->delete();
    }
};
