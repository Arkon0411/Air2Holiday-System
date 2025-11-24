<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        DB::table('airports')->insertOrIgnore([
            ['name' => 'Heathrow', 'iata_code' => 'LHR', 'location' => 'London, UK', 'created_at'=>$now,'updated_at'=>$now],
            ['name' => 'John F. Kennedy International', 'iata_code' => 'JFK', 'location' => 'New York, USA', 'created_at'=>$now,'updated_at'=>$now],
            ['name' => 'Los Angeles International', 'iata_code' => 'LAX', 'location' => 'Los Angeles, USA','created_at'=>$now,'updated_at'=>$now],
        ]);
    }
}
