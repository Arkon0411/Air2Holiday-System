<x-layouts.app.header>
  <div class="container mx-auto p-6">
    <flux:heading>Search Results</flux:heading>

    <div class="mt-6 space-y-4">
      @forelse($flights as $flight)
        <div class="p-4 bg-white rounded">
          <div class="flex justify-between">
            <div>
              <div class="font-semibold">{{ $flight->flight_number }} — {{ optional($flight->departureAirport)->iata_code }} → {{ optional($flight->arrivalAirport)->iata_code }}</div>
              <div class="text-sm text-zinc-500">Departs: {{ $flight->scheduled_departure }}</div>
            </div>
            <div class="text-right">
              <div class="text-sm">Seats taken: {{ $flight->seats_taken ?? 0 }}</div>
              <div class="mt-2">
                <a href="{{ route('bookings.seatmap', ['flight' => $flight->id]) }}" class="px-3 py-1 bg-accent text-white rounded">Select Seat</a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="p-4 bg-yellow-50">No flights found.</div>
      @endforelse
    </div>
  </div>
</x-layouts.app.header>
