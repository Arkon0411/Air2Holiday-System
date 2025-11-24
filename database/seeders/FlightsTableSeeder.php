<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlightsTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $date = Carbon::now()->addDays(2)->startOfDay();

        // Find airport ids
        $lhr = DB::table('airports')->where('iata_code','LHR')->value('id');
        $jfk = DB::table('airports')->where('iata_code','JFK')->value('id');
        $lax = DB::table('airports')->where('iata_code','LAX')->value('id');

        DB::table('flights')->insertOrIgnore([
            ['flight_number'=>'AA100','departure_airport_id'=>$lhr,'arrival_airport_id'=>$jfk,'scheduled_departure'=>$date->copy()->addHours(8),'scheduled_arrival'=>$date->copy()->addHours(16),'base_price'=>450,'status'=>'scheduled','created_at'=>$now,'updated_at'=>$now],
            ['flight_number'=>'AA200','departure_airport_id'=>$jfk,'arrival_airport_id'=>$lax,'scheduled_departure'=>$date->copy()->addDays(1)->addHours(9),'scheduled_arrival'=>$date->copy()->addDays(1)->addHours(13),'base_price'=>300,'status'=>'scheduled','created_at'=>$now,'updated_at'=>$now],
        ]);
    }
}
