  <x-layouts.app.header>
      <div class="container mx-auto px-4 py-6">
        <div class="welcome mb-4">
          <h1>Hello, {{ Auth::user()->name ?? 'User' }}!</h1>
        </div>

        <h2 class="section-title">Choose your destination</h2>

        @php
          $flights = \App\Models\Flight::with('arrivalAirport')->get();
          $destinations = $flights->unique('arrival_airport_id')->take(6);
        @endphp

        <div class="destinations grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
          @forelse($destinations as $flight)
            @php
              $location = optional($flight->arrivalAirport)->location ?? '';
              $slug = \Illuminate\Support\Str::slug($location);
            @endphp
            <a
              href="{{ route('flights', ['dest' => $slug]) }}"
              class="card rounded-lg overflow-hidden shadow-sm block"
              data-destination="{{ $location }}"
              role="link"
              tabindex="0"
              aria-label="View flights to {{ $location }}"
            >
              <img src="{{ asset($flight->image ?: 'img/loginsplash.jpeg') }}" alt="{{ $location ?: 'Destination' }}" class="w-full h-40 object-cover">
              <div class="card-info p-3">
                <h3 class="text-lg font-medium">{{ $location ?: 'Unknown' }}</h3>
                <p class="text-sm text-zinc-600">Starting at <strong>{{ number_format($flight->base_price,2) }}</strong></p>
              </div>
            </a>
          @empty
            <div>No destinations available yet.</div>
          @endforelse
        </div>

        <div class="bookings mt-6">
          <h3>Bookings</h3>
          <a href="{{ route('bookings') }}" class="view-all">View Bookings</a>
        </div>
      </div>
    </x-layouts.app.header>


  <script src="{{ asset('js/dashboard.js') }}"></script>
