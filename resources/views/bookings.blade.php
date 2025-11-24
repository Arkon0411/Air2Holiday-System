<x-layouts.app.header>
  <div class="container mx-auto px-4 py-6">
    <flux:heading size="lg">Bookings</flux:heading>

    @php
      // Flight-centric view but limited to flights that have bookings for the authenticated user
      $userId = auth()->id();

      // If user was redirected from dashboard with flight_id & seat, find their booking for that flight
        $selectedFlightId = request()->query('flight_id');
        $selectedSeat = request()->query('seat');
        $selectedBooking = null;

        // Support direct booking_id param (preferred) or fallback to flight_id
        $selectedBookingId = request()->query('booking_id');
        if ($selectedBookingId) {
          $selectedBooking = \App\Models\Booking::where('id', $selectedBookingId)->where('user_id', $userId)->first();
        } elseif ($selectedFlightId) {
          $selectedBooking = \App\Models\Booking::where('user_id', $userId)->where('flight_id', $selectedFlightId)->first();
        }

      $flights = \App\Models\Flight::whereHas('bookings', function($q) use ($userId) {
          $q->where('user_id', $userId);
      })
      ->with([
          'bookings' => function($q) use ($userId) { $q->where('user_id', $userId)->with('user'); },
          'departureAirport','arrivalAirport'
      ])
      ->orderBy('scheduled_departure','asc')
      ->get();
    @endphp

    <div class="mt-6 space-y-6">

      {{-- Seat confirmation area (when user clicked an available seat on dashboard) --}}
      @if($selectedBooking && $selectedSeat)
        <div class="p-4 bg-white dark:bg-zinc-800 rounded-md mb-4">
          <div class="flex items-center justify-between">
            <div>
              <div class="text-sm">Confirm seat for booking #{{ $selectedBooking->id }}</div>
              <div class="font-semibold">Flight: {{ optional($selectedBooking->flight)->flight_number ?? '—' }}</div>
              <div class="text-xs text-zinc-500">Selected: <strong class="text-green-500">{{ $selectedSeat }}</strong></div>
            </div>
            <div>
              <form method="POST" action="{{ route('booking.seat', ['booking' => $selectedBooking->id]) }}">
                @csrf
                <input type="hidden" name="seat_number" value="{{ $selectedSeat }}">
                <button type="submit" class="inline-flex items-center px-3 py-1 rounded bg-accent text-white">Confirm Seat</button>
              </form>
            </div>
          </div>
        </div>
      @elseif($selectedFlightId && ! $selectedBooking)
        <div class="p-4 bg-yellow-50 dark:bg-zinc-700 rounded-md mb-4 text-sm text-zinc-700">You don't have a booking for that flight.</div>
      @endif
      @foreach($flights as $flight)
        <div class="bg-white dark:bg-zinc-800 rounded-md shadow-sm overflow-hidden">
          <div class="p-4 flex items-center justify-between">
            <div>
              <div class="font-semibold">{{ $flight->flight_number ?? '—' }} • {{ optional($flight->departureAirport)->iata_code ?? $flight->departure_airport_id }} → {{ optional($flight->arrivalAirport)->iata_code ?? $flight->arrival_airport_id }}</div>
              <div class="text-xs text-zinc-500">Scheduled: {{ \Carbon\Carbon::parse($flight->scheduled_departure)->format('M d, Y H:i') }}</div>
            </div>
            <div class="text-sm text-zinc-500">Bookings: {{ $flight->bookings->count() }}</div>
          </div>

          <div class="p-4 border-t border-zinc-100 dark:border-zinc-700">
            @if($flight->bookings->isEmpty())
              <div class="text-sm text-zinc-500">No bookings for this flight.</div>
            @else
              <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-zinc-700 dark:text-zinc-200">
                  <thead>
                    <tr class="text-left text-xs text-zinc-500">
                      <th class="px-3 py-2">Customer</th>
                      <th class="px-3 py-2">Seat</th>
                      <th class="px-3 py-2">Status</th>
                      <th class="px-3 py-2">Booked At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($flight->bookings as $b)
                      <tr class="border-t border-zinc-100 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-900">
                        <td class="px-3 py-2">{{ optional($b->user)->name ?? 'Guest' }}</td>
                        <td class="px-3 py-2">{{ $b->seat_number ?? '—' }}</td>
                        <td class="px-3 py-2">{{ ucfirst($b->status ?? 'pending') }}</td>
                        <td class="px-3 py-2">{{ $b->created_at ? $b->created_at->format('M d, Y H:i') : '' }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</x-layouts.app.header>
