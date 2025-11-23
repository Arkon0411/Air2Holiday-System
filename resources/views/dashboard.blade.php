  <x-layouts.app.header>
      <div class="container mx-auto px-4 py-6">
        <div class="welcome mb-4">
        </div>

        <h2 class="section-title">Choose your destination</h2>

        @php
          $flights = \App\Models\Flight::with('arrivalAirport')->get();
          $destinations = $flights->unique('arrival_airport_id')->take(6);
        @endphp

        <div class="destinations grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
          @forelse($destinations as $flight)
            <div class="card rounded-lg overflow-hidden shadow-sm">
            <div class="card rounded-lg overflow-hidden shadow-sm bg-zinc-100 dark:bg-zinc-700 hover:shadow-md transition-shadow duration-300">
              <img src="{{ asset($flight->image ?: 'img/loginsplash.jpeg') }}" alt="{{ optional($flight->arrivalAirport)->location ?? 'Destination' }}" class="w-full h-40 object-cover">
              <div class="card-info p-3">
                <h3 class="text-lg font-medium">{{ optional($flight->arrivalAirport)->location ?? 'Unknown' }}</h3>
                <p class="text-sm text-zinc-600">Starting at <strong>{{ number_format($flight->base_price,2) }}</strong></p>
                <p class="text-sm text-zinc-400">Starting at <strong class="text-accent">₱ {{ number_format($flight->base_price,2) }}</strong></p>
              </div>
            </div>
          @empty
            <div>No destinations available yet.</div>
          @endforelse
        </div>
      </div>
    </x-layouts.app.header>
