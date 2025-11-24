<div>
  <div class="mb-3">
    <div class="text-sm text-zinc-400">Flight <strong>{{ $flight->flight_number }}</strong> — {{ optional($flight->departureAirport)->iata_code ?? $flight->departure_airport_id }} to {{ optional($flight->arrivalAirport)->iata_code ?? $flight->arrival_airport_id }}</div>
    <div class="text-xs text-zinc-500">Seats: {{ $seats_total }} • Available: {{ $seats_available }} • Taken: {{ $seats_taken }}</div>
  </div>

  <div class="seat-grid grid gap-2">
    @if($seatRows->isEmpty())
      <div class="text-sm text-zinc-500">No seat map available for this flight.</div>
    @else
      <div class="grid grid-cols-6 gap-2 text-center text-xs text-zinc-300">
        @foreach(['A','B','C','D','E','F'] as $col)
          <div>{{ $col }}</div>
        @endforeach
      </div>
      @php
        $rows = [];
        foreach ($seatRows as $s) {
          preg_match('/^(\d+)([A-Z])/', $s->seat_number, $m);
          if ($m) {
            $r = $m[1];
            $rows[$r][] = $s->seat_number;
          }
        }
        $bookingId = $booking ? $booking->id : null;
      @endphp

      @foreach($rows as $rnum => $cols)
        <div class="mt-2 grid grid-cols-6 gap-2">
          @foreach(['A','B','C','D','E','F'] as $col)
            @php $seat = $rnum.$col; $isTaken = in_array($seat, $takenSeats); @endphp
            @if($isTaken)
              <div class="px-2 py-2 rounded text-sm text-white text-center bg-red-500">{{ $seat }}</div>
            @else
              <div class="px-2 py-2 rounded text-sm text-white text-center bg-zinc-800 cursor-pointer seat-available" data-seat="{{ $seat }}" data-flight-id="{{ $flight->id }}" @if($bookingId) data-booking-id="{{ $bookingId }}" @endif>{{ $seat }}</div>
            @endif
          @endforeach
        </div>
      @endforeach
    @endif
  </div>
</div>
