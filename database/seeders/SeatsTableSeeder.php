<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $flights = DB::table('flights')->get();
        foreach ($flights as $flight) {
            // simple 3 rows x 6 seats = 18 seats
            $rows = ['1','2','3','4','5','6'];
            $cols = ['A','B','C','D','E','F'];
            $toInsert = [];
            foreach ($rows as $r) {
                foreach ($cols as $c) {
                    $toInsert[] = [
                        'flight_id' => $flight->id,
                        'seat_number' => $r . $c,
                        'seat_class' => ($r <= 2) ? 'business' : 'economy',
                        'price_modifier' => ($r <= 2) ? 100 : 0,
                        'is_active' => 1,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
            DB::table('seats')->insertOrIgnore($toInsert);
        }
    }
}
