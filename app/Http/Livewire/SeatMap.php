<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Flight;

class SeatMap extends Component
{
    public Flight $flight;
    public $seatRows = [];
    public $takenSeats = [];
    public $seats_total = 0;
    public $seats_taken = 0;
    public $seats_available = 0;

    public function mount(Flight $flight)
    {
        $this->flight = $flight;
        $this->loadSeats();
    }

    public function loadSeats()
    {
        $this->seatRows = DB::table('seats')->where('flight_id', $this->flight->id)->orderBy('seat_number')->get();

        $bookedFromBookings = DB::table('bookings')->where('flight_id', $this->flight->id)->whereNotNull('seat_number')->pluck('seat_number')->all();

        $bookedFromSeats = [];
        try {
            if (Schema::hasColumn('seats', 'is_booked')) {
                $bookedFromSeats = DB::table('seats')->where('flight_id', $this->flight->id)->where('is_booked', 1)->pluck('seat_number')->all();
            }
        } catch (\Throwable $e) {
            $bookedFromSeats = [];
        }

        $this->takenSeats = array_values(array_unique(array_merge($bookedFromBookings, $bookedFromSeats)));
        $this->seats_total = DB::table('seats')->where('flight_id', $this->flight->id)->count();
        $this->seats_taken = count($this->takenSeats);
        $this->seats_available = max(0, $this->seats_total - $this->seats_taken);
    }

    public function render()
    {
        return view('livewire.seat-map');
    }
}
