<x-layouts.app.header>
  <div class="container mx-auto px-4 py-6">
    <h1 class="page-title">Flights</h1>

    @php
      $dest = request()->query('dest');
      $search = request()->query('search');
    @endphp

    @if($dest)
      <p class="mb-4">Showing flights to <strong>{{ str_replace('-', ' ', $dest) }}</strong></p>
    @elseif($search)
      <p class="mb-4">Search results for <strong>{{ $search }}</strong></p>
    @endif

    @php
      $flightsQuery = \App\Models\Flight::with('arrivalAirport', 'departureAirport');
      if ($dest) {
        $clean = str_replace('-', ' ', $dest);
        $flightsQuery = $flightsQuery->whereHas('arrivalAirport', fn($q) => $q->where('location', 'like', "%{$clean}%"));
      }
      if ($search) {
        $flightsQuery = $flightsQuery->where(function($q) use ($search) {
          $q->where('code', 'like', "%{$search}%")
            ->orWhereHas('arrivalAirport', fn($a)=> $a->where('location', 'like', "%{$search}%"));
        });
      }
      $flights = $flightsQuery->get();
    @endphp

    <div class="flights-section">
      @forelse($flights as $f)
        <div class="reservation-card mb-4">
          <div>
            <div class="route">{{ optional($f->departureAirport)->location ?? 'Unknown' }} → {{ optional($f->arrivalAirport)->location ?? 'Unknown' }}</div>
            <div class="flight-code">{{ $f->code ?? '' }}</div>
          </div>
          <div style="text-align:right;">
            <div>Price: <strong>{{ number_format($f->base_price,2) }}</strong></div>
            <a href="{{ route('bookings') }}" class="confirm-seat" style="display:inline-block; margin-top:8px;">Book</a>
          </div>
        </div>
      @empty
        <p>No flights found.</p>
      @endforelse
    </div>
  </div>
</x-layouts.app.header>

<script src="{{ asset('js/dashboard.js') }}"></script>
