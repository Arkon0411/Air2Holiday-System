<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Booking;

class SeatSelector extends Component
{
    public int $bookingId;
    public ?Booking $booking = null;
    public ?string $selectedSeat = null;

    public function mount(int $bookingId)
    {
        $this->bookingId = $bookingId;
        $this->booking = Booking::with('flight')->find($bookingId);
    }

    // Livewire may call the method name in different forms; provide both.
    public function selectSeat($seat)
    {
        $this->selectedSeat = $seat;
    }

    // Backwards-compatible alias
    public function select($seat)
    {
        return $this->selectSeat($seat);
    }

    public function confirm()
    {
        if (! $this->selectedSeat) {
            $this->dispatchBrowserEvent('flux:notification', ['type' => 'error', 'message' => 'Please select a seat first.']);
            return;
        }

        $b = Booking::find($this->bookingId);
        if (! $b) {
            $this->dispatchBrowserEvent('flux:notification', ['type' => 'error', 'message' => 'Booking not found.']);
            return;
        }

        $b->seat_number = $this->selectedSeat;
        $b->save();

        $this->booking = $b->fresh();
        $this->dispatchBrowserEvent('flux:notification', ['type' => 'success', 'message' => 'Seat saved.']);
        $this->emit('seatConfirmed', $this->bookingId);
    }

    public function render()
    {
        return view('livewire.seat-selector', [
            'booking' => $this->booking,
            'selectedSeat' => $this->selectedSeat,
        ]);
    }
}
