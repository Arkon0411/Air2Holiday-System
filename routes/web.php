<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('bookings', 'bookings')
    ->middleware(['auth', 'verified'])
    ->name('bookings');

// Booking endpoint: create a booking for an authenticated user
use App\Http\Controllers\BookingController;

Route::post('book-flight', [BookingController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('book.flight');

// Save selected seat for an existing booking
Route::post('bookings/{booking}/seat', [BookingController::class, 'updateSeat'])
    ->middleware(['auth', 'verified'])
    ->name('booking.seat');

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
