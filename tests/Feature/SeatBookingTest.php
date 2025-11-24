<?php

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

beforeEach(function () {
    // ensure fresh DB state per test (RefreshDatabase handles migrations)
});

test('reserve endpoint returns 409 when seat already taken', function () {
    $user = User::factory()->create();

    // create a flight
    $flight = Flight::create([
        'flight_number' => 'TEST100',
        'scheduled_departure' => Carbon::now(),
        'airline_id' => 1,
        'departure_airport_id' => 1,
        'arrival_airport_id' => 2,
        'base_price' => 100.00,
    ]);

    // create seat
    Seat::create([
        'flight_id' => $flight->id,
        'seat_number' => '1A',
        'seat_class' => 'economy',
        'price_modifier' => 0,
        'is_active' => 1,
        'is_booked' => 0,
    ]);

    // create an existing booking that claims seat 1A
    $existing = Booking::create([
        'booking_date' => Carbon::now(),
        'status' => 'confirmed',
        'user_id' => $user->id,
        'flight_id' => $flight->id,
        'seat_number' => '1A'
    ]);

    // mark seat as booked as the app would
    DB::table('seats')->where('flight_id', $flight->id)->where('seat_number', '1A')->update(['is_booked' => 1]);

    $this->actingAs($user)
        ->postJson(route('flights.reserve', ['flight' => $flight->id]), ['seat' => '1A'])
        ->assertStatus(409)
        ->assertJson(['success' => false]);
});

test('creating a booking marks seat as booked and subsequent booking fails', function () {
    $user = User::factory()->create();

    $flight = Flight::create([
        'flight_number' => 'TEST200',
        'scheduled_departure' => Carbon::now(),
        'airline_id' => 1,
        'departure_airport_id' => 1,
        'arrival_airport_id' => 2,
        'base_price' => 150.00,
    ]);

    Seat::create([
        'flight_id' => $flight->id,
        'seat_number' => '2B',
        'seat_class' => 'economy',
        'price_modifier' => 0,
        'is_active' => 1,
        'is_booked' => 0,
    ]);

    $this->actingAs($user)
        ->post(route('bookings.create', ['flight' => $flight->id]), [
            'seat' => '2B',
            'passengers' => [
                ['first_name' => 'Alice', 'last_name' => 'Test']
            ]
        ])
        ->assertRedirect();

    // seat should be marked booked
    $this->assertDatabaseHas('seats', ['flight_id' => $flight->id, 'seat_number' => '2B', 'is_booked' => 1]);

    // second attempt should not create another booking for same seat
    $this->actingAs($user)
        ->post(route('bookings.create', ['flight' => $flight->id]), [
            'seat' => '2B',
            'passengers' => [
                ['first_name' => 'Bob', 'last_name' => 'Test']
            ]
        ])
        ->assertSessionHasErrors();
});

test('changing a booking seat prevents conflicts and updates seat flags', function () {
    $user = User::factory()->create();

    $flight = Flight::create([
        'flight_number' => 'TEST300',
        'scheduled_departure' => Carbon::now(),
        'airline_id' => 1,
        'departure_airport_id' => 1,
        'arrival_airport_id' => 2,
        'base_price' => 200.00,
    ]);

    Seat::create(['flight_id' => $flight->id, 'seat_number' => '3A', 'seat_class' => 'economy', 'price_modifier' => 0, 'is_active' => 1, 'is_booked' => 0]);
    Seat::create(['flight_id' => $flight->id, 'seat_number' => '3B', 'seat_class' => 'economy', 'price_modifier' => 0, 'is_active' => 1, 'is_booked' => 0]);

    // create booking with seat 3A
    $booking = Booking::create([
        'booking_date' => Carbon::now(),
        'status' => 'pending',
        'user_id' => $user->id,
        'flight_id' => $flight->id,
        'seat_number' => '3A'
    ]);
    DB::table('seats')->where('flight_id', $flight->id)->where('seat_number', '3A')->update(['is_booked' => 1]);

    // create another booking that holds 3B
    $other = User::factory()->create();
    $book2 = Booking::create(['booking_date' => Carbon::now(), 'status' => 'confirmed', 'user_id' => $other->id, 'flight_id' => $flight->id, 'seat_number' => '3B']);
    DB::table('seats')->where('flight_id', $flight->id)->where('seat_number', '3B')->update(['is_booked' => 1]);

    // try to change $booking to seat 3B via controller route
    $this->actingAs($user)
        ->post(route('booking.seat', ['booking' => $booking->id]), ['seat_number' => '3B'])
        ->assertSessionHasErrors();

    // change to an available seat 3C (create it)
    Seat::create(['flight_id' => $flight->id, 'seat_number' => '3C', 'seat_class' => 'economy', 'price_modifier' => 0, 'is_active' => 1, 'is_booked' => 0]);

    $this->actingAs($user)
        ->post(route('booking.seat', ['booking' => $booking->id]), ['seat_number' => '3C'])
        ->assertRedirect();

    $this->assertDatabaseHas('seats', ['flight_id' => $flight->id, 'seat_number' => '3C', 'is_booked' => 1]);
    $this->assertDatabaseHas('seats', ['flight_id' => $flight->id, 'seat_number' => '3A', 'is_booked' => 0]);
});
