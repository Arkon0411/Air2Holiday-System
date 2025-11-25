<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Airline;
use Illuminate\Support\Facades\Hash;

class AirlineUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if an airline user already exists
        $existingAirlineUser = User::where('usertype', 'airline')->first();
        
        if (!$existingAirlineUser) {
            // Create a sample airline user
            $airlineUser = User::create([
                'name' => 'Sample Airline Manager',
                'email' => 'airline@air2holiday.com',
                'password' => Hash::make('password123'),
                'usertype' => 'airline',
                'email_verified_at' => now(),
            ]);

            // Create a sample airline linked to this user
            Airline::create([
                'name' => 'Sample Airlines',
                'code' => 'SA',
                'user_id' => $airlineUser->id,
            ]);

            $this->command->info('Sample airline user and airline created successfully!');
            $this->command->info('Email: airline@air2holiday.com');
            $this->command->info('Password: password123');
        } else {
            $this->command->info('Airline user already exists. Skipping seeder.');
        }
    }
}
