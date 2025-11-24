<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightSeatController;
use App\Http\Controllers\BookingFlowController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Booking flow: search & results
Route::get('flights/search', [BookingFlowController::class, 'search'])->name('bookings.search');
Route::get('flights/results', [BookingFlowController::class, 'results'])->name('bookings.results');

// Seat map and booking creation
Route::get('flights/{flight}/seat-map', [BookingFlowController::class, 'seatMap'])->name('bookings.seatmap');
// Flux/Livewire seatmap page
Route::get('flights/{flight}/seatmap-flux', function (App\Models\Flight $flight) {
    return view('seatmap.flux', compact('flight'));
})->name('bookings.seatmap.flux');
Route::post('flights/{flight}/book', [BookingFlowController::class, 'createBooking'])->name('bookings.create');
Route::get('bookings/{booking}/confirm', [BookingFlowController::class, 'confirm'])->name('bookings.confirm');

// Payment stub
Route::post('payments/{payment}/pay', [PaymentController::class, 'pay'])->name('payments.pay');
Route::get('payments/{payment}/stripe-success', [PaymentController::class, 'stripeSuccess'])->name('payments.stripe_success');
Route::post('payments/webhook', [PaymentController::class, 'webhook'])->name('payments.webhook');

// Admin area (basic)
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\EnsureAdmin::class])->group(function(){
    Route::get('flights', [\App\Http\Controllers\Admin\FlightAdminController::class, 'index'])->name('admin.flights.index');
    Route::get('flights/create', [\App\Http\Controllers\Admin\FlightAdminController::class, 'create'])->name('admin.flights.create');
    Route::post('flights', [\App\Http\Controllers\Admin\FlightAdminController::class, 'store'])->name('admin.flights.store');
    // Admin CRUD for core models
    Route::resource('passengers', \App\Http\Controllers\Admin\PassengerAdminController::class, ['as' => 'admin']);
    Route::resource('payments', \App\Http\Controllers\Admin\PaymentAdminController::class, ['as' => 'admin']);
    Route::resource('seats', \App\Http\Controllers\Admin\SeatAdminController::class, ['as' => 'admin']);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('bookings', 'bookings')
    ->middleware(['auth', 'verified'])
    ->name('bookings');

// Seat update route (booking seat confirmation)
Route::post('bookings/{booking}/seat', [BookingController::class, 'seat'])
    ->middleware(['auth','verified'])
    ->name('booking.seat');

// Ajax endpoint to fetch seat map HTML for a flight (on-demand)
Route::get('flights/{flight}/seats', [FlightSeatController::class, 'seats'])
    ->middleware(['auth','verified'])
    ->name('flights.seats');

// Ajax endpoint to reserve a seat immediately (POST)
Route::post('flights/{flight}/reserve', [FlightSeatController::class, 'reserve'])
    ->middleware(['auth','verified'])
    ->name('flights.reserve');
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
