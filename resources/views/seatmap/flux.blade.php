<x-layouts.app.header>
  <div class="container mx-auto p-6">
    <flux:heading>Select Seat — {{ $flight->flight_number }}</flux:heading>

    <div class="mt-6">
      @livewire('seat-map', ['flight' => $flight])
    </div>
  </div>
</x-layouts.app.header>
