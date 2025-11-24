<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Flight;
use Carbon\Carbon;

class SeatMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Default layout: rows 1-20, columns A-F. Edit $rows/$cols if you want a different layout.
     */
    public function run()
    {
        $rows = range(1, 20);
        $cols = ['A','B','C','D','E','F'];

        $created = 0;

        $flights = Flight::all();
        foreach ($flights as $flight) {
            foreach ($rows as $r) {
                foreach ($cols as $c) {
                    $seatNumber = strtoupper(trim($r . $c));

                    $exists = DB::table('seats')
                        ->where('flight_id', $flight->id)
                        ->whereRaw('UPPER(TRIM(seat_number)) = ?', [$seatNumber])
                        ->exists();

                    if (! $exists) {
                        DB::table('seats')->insert([
                            'flight_id' => $flight->id,
                            'seat_number' => $seatNumber,
                            'seat_class' => 'economy',
                            'price_modifier' => 0,
                            'is_active' => 1,
                            'is_booked' => 0,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $created++;
                    }
                }
            }
        }

        $this->command->info("SeatMapSeeder: created {$created} seats for {$flights->count()} flights.");
    }
}
