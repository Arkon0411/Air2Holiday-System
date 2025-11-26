  <x-layouts.app.header>
      <div class="container mx-auto px-4 py-8">
        {{-- Welcome Hero Section --}}
        <div class="text-center mb-12">
          <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 dark:text-white mb-4">
            Welcome to Air2Holiday
          </h1>
          <p class="text-xl text-zinc-600 dark:text-zinc-400 mb-8">
            Discover your next adventure and book flights to amazing destinations
          </p>
          <div class="flex justify-center gap-4">
            <a href="{{ route('flights') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
              </svg>
              Browse All Flights
            </a>
            @auth
            <a href="{{ route('bookings') }}" class="inline-flex items-center px-6 py-3 border-2 border-blue-600 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-zinc-700 transition font-semibold">
              My Bookings
            </a>
            @endauth
          </div>
        </div>

        {{-- Featured Destinations --}}
        <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-6">Featured Destinations</h2>

        @php
          // Featured destination locations
          $featuredLocations = ['Tokyo', 'Seoul', 'Palawan', 'Los Angeles', 'Manila'];
          
          // Get airports for featured destinations
          $featuredAirports = \App\Models\Airport::whereIn('location', array_map(function($loc) {
            return '%' . $loc . '%';
          }, $featuredLocations))
          ->orWhere(function($query) use ($featuredLocations) {
            foreach ($featuredLocations as $loc) {
              $query->orWhere('location', 'LIKE', '%' . $loc . '%');
            }
          })
          ->get();

          // Get flights to these airports
          $featured = \App\Models\Flight::with(['arrivalAirport', 'departureAirport'])
            ->whereIn('arrival_airport_id', $featuredAirports->pluck('id'))
            ->where('status', 'Scheduled')
            ->where('scheduled_departure', '>', now())
            ->get()
            ->groupBy('arrival_airport_id')
            ->map(function($flights) {
              return $flights->sortBy('base_price')->first();
            })
            ->take(5);
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-12">
          @forelse($featured as $flight)
            <a href="{{ route('flights', ['arrival' => $flight->arrival_airport_id]) }}" 
               class="group relative rounded-lg overflow-hidden shadow-md hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
              <div class="relative h-64 overflow-hidden">
                <img 
                  src="{{ asset(optional($flight->arrivalAirport)->image ?? 'img/loginsplash.jpeg') }}" 
                  alt="{{ optional($flight->arrivalAirport)->location ?? 'Destination' }}" 
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                  <h3 class="text-xl font-bold mb-1">{{ optional($flight->arrivalAirport)->location ?? 'Unknown' }}</h3>
                  <p class="text-sm mb-2 opacity-90">{{ optional($flight->arrivalAirport)->name }}</p>
                  <div class="flex items-center justify-between">
                    <span class="text-xs opacity-75">From</span>
                    <span class="text-lg font-bold">₱{{ number_format($flight->base_price, 2) }}</span>
                  </div>
                </div>
              </div>
            </a>
          @empty
            <div class="col-span-full text-center py-8 text-zinc-600 dark:text-zinc-400">
              No featured destinations available yet.
            </div>
          @endforelse
        </div>

        {{-- Why Choose Us Section --}}
        <div class="bg-white dark:bg-zinc-700 rounded-lg p-8 shadow-md mb-12">
          <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6 text-center">Why Choose Air2Holiday?</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Best Prices</h3>
              <p class="text-zinc-600 dark:text-zinc-400">Competitive fares to destinations worldwide</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Easy Booking</h3>
              <p class="text-zinc-600 dark:text-zinc-400">Book your flight in just a few clicks</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">24/7 Support</h3>
              <p class="text-zinc-600 dark:text-zinc-400">We're here to help you anytime</p>
            </div>
          </div>
        </div>

        {{-- All Destinations --}}
        <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Explore All Destinations</h2>
        @php
          $flights = \App\Models\Flight::with('arrivalAirport')
            ->where('status', 'Scheduled')
            ->where('scheduled_departure', '>', now())
            ->get();
          $destinations = $flights->unique('arrival_airport_id')->values()->take(9);
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
          @forelse($destinations as $flight)
            <a href="{{ route('flights', ['arrival' => $flight->arrival_airport_id]) }}" 
               class="group bg-white dark:bg-zinc-700 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
              <div class="relative h-48 overflow-hidden">
                <img 
                  src="{{ asset(optional($flight->arrivalAirport)->image ?? 'img/loginsplash.jpeg') }}" 
                  alt="{{ optional($flight->arrivalAirport)->location ?? 'Destination' }}" 
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                >
              </div>
              <div class="p-4">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">
                  {{ optional($flight->arrivalAirport)->location ?? 'Unknown' }}
                </h3>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">
                  {{ optional($flight->arrivalAirport)->name }}
                </p>
                <div class="flex items-center justify-between">
                  <span class="text-sm text-zinc-500 dark:text-zinc-400">Starting at</span>
                  <span class="text-xl font-bold text-blue-600 dark:text-blue-400">₱{{ number_format($flight->base_price, 2) }}</span>
                </div>
              </div>
            </a>
          @empty
            <div class="col-span-full text-center py-8 text-zinc-600 dark:text-zinc-400">
              No destinations available yet.
            </div>
          @endforelse
        </div>

        @if($destinations->count() > 0)
          <div class="text-center mt-8">
            <a href="{{ route('flights') }}" class="inline-flex items-center px-6 py-3 border-2 border-blue-600 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-zinc-700 transition font-semibold">
              View All Flights
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </a>
          </div>
        @endif
      </div>
    </x-layouts.app.header>