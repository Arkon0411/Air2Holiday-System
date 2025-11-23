<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->name('dashboard');

Route::view('bookings', 'bookings')
    ->middleware(['auth', 'verified'])
    ->name('bookings');

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

// Admin panel routes (admins and airlines)
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

Route::middleware(['auth', \App\Http\Middleware\AdminPanelAccess::class])->prefix('adminpanel')->group(function () {
    Route::get('/', [AdminPanelController::class, 'index'])->name('adminpanel.index');

    // Airports CRUD
    Route::get('airports', [AirportController::class, 'index'])->name('adminpanel.airports.index');
    Route::get('airports/create', [AirportController::class, 'create'])->name('adminpanel.airports.create');
    Route::post('airports', [AirportController::class, 'store'])->name('adminpanel.airports.store');
    Route::get('airports/{airport}/edit', [AirportController::class, 'edit'])->name('adminpanel.airports.edit');
    Route::put('airports/{airport}', [AirportController::class, 'update'])->name('adminpanel.airports.update');
    Route::delete('airports/{airport}', [AirportController::class, 'destroy'])->name('adminpanel.airports.destroy');

    // Users / Airlines CRUD
    Route::resource('users', AdminUserController::class, ['as' => 'adminpanel']);

    // Bookings
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('adminpanel.bookings.index');
    Route::get('bookings/{booking}', [AdminBookingController::class, 'show'])->name('adminpanel.bookings.show');
    Route::delete('bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('adminpanel.bookings.destroy');
    
    // Flights
    Route::get('flights', [\App\Http\Controllers\Admin\FlightController::class, 'index'])->name('adminpanel.flights.index');
    Route::get('flights/create', [\App\Http\Controllers\Admin\FlightController::class, 'create'])->name('adminpanel.flights.create');
    Route::post('flights', [\App\Http\Controllers\Admin\FlightController::class, 'store'])->name('adminpanel.flights.store');
    Route::get('flights/{flight}/edit', [\App\Http\Controllers\Admin\FlightController::class, 'edit'])->name('adminpanel.flights.edit');
    Route::put('flights/{flight}', [\App\Http\Controllers\Admin\FlightController::class, 'update'])->name('adminpanel.flights.update');
    Route::delete('flights/{flight}', [\App\Http\Controllers\Admin\FlightController::class, 'destroy'])->name('adminpanel.flights.destroy');
});
