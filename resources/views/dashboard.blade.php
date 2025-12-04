  <x-layouts.app.header>
      <div class="container mx-auto px-4 py-8" style="opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease-out, transform 0.6s ease-out;">
        {{-- Welcome Hero Section --}}
        <div class="text-center mb-12">
          {{-- SVG Logo with Fancy Styling --}}
          <div class="flex justify-center mb-6">
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-500 rounded-full blur-xl opacity-75 group-hover:opacity-100 animate-pulse"></div>
              <div class="relative bg-gradient-to-br from-cyan-50 to-cyan-100 dark:from-cyan-900/30 dark:to-cyan-800/30 rounded-full p-6 shadow-2xl transform group-hover:scale-110 transition duration-500 border-4 border-cyan-100 dark:border-cyan-800/50">
                <x-app-logo-icon class="h-24 w-24 md:h-32 md:w-32 text-black dark:text-white" />
              </div>
            </div>
          </div>

          <h1 class="text-4xl md:text-5xl font-bold mb-4">
            <span class="bg-gradient-to-r from-cyan-600 via-blue-600 to-purple-600 bg-clip-text text-transparent">
              Welcome to Air2Holiday
            </span>
          </h1>
          <p class="text-xl text-zinc-600 dark:text-zinc-400 mb-8">
            Discover your next adventure and book flights to amazing destinations
          </p>
          <div class="flex justify-center gap-4">
            <a href="{{ route('flights') }}" class="inline-flex items-center px-6 py-3 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition font-semibold">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
              </svg>
              Browse All Flights
            </a>
            @auth
            <a href="{{ route('bookings') }}" class="inline-flex items-center px-6 py-3 border-2 border-cyan-600 text-cyan-600 dark:text-cyan-400 rounded-lg hover:bg-cyan-50 dark:hover:bg-zinc-700 transition font-semibold">
              My Bookings
            </a>
            @endauth
          </div>
        </div>

        {{-- Featured Destinations --}}
        <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-6">Featured Destinations</h2>

        @php
          // Featured destination locations
          $featuredLocations = ['Tokyo', 'Beijing', 'Palawan', 'Los Angeles', 'Manila' , 'Singapore'];
          
          // Get airports for featured destinations
          $featuredAirports = \App\Models\Airport::where(function($query) use ($featuredLocations) {
            foreach ($featuredLocations as $loc) {
              $query->orWhere('location', 'LIKE', '%' . $loc . '%');
            }
          })->get();

          // Get flights to these airports - one per unique destination
          $featured = \App\Models\Flight::with(['arrivalAirport', 'departureAirport'])
            ->whereIn('arrival_airport_id', $featuredAirports->pluck('id'))
            ->where('status', 'scheduled')
            ->where('scheduled_departure', '>', now())
            ->get()
            ->groupBy('arrival_airport_id')
            ->map(function($flights) {
              return $flights->sortBy('base_price')->first();
            })
            ->values()
            ->take(5);
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-12">
          @forelse($featured as $flight)
            <a href="{{ route('flights', ['arrival' => $flight->arrival_airport_id]) }}" 
               class="group relative rounded-lg overflow-hidden shadow-md hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border-2 border-zinc-200 dark:border-zinc-600">
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
        <div class="bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-800 dark:to-zinc-700 rounded-lg p-8 shadow-md mb-12 border border-zinc-200 dark:border-zinc-600">
          <h2 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6 text-center">Why Choose Air2Holiday?</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
              <div class="w-16 h-16 bg-cyan-100 dark:bg-cyan-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Easy & Friendly UI</h3>
              <p class="text-zinc-600 dark:text-zinc-400">Intuitive design for seamless booking experience</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-cyan-100 dark:bg-cyan-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Easy Booking</h3>
              <p class="text-zinc-600 dark:text-zinc-400">Book your flight in just a few clicks</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-cyan-100 dark:bg-cyan-900 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            ->where('status', 'scheduled')
            ->where('scheduled_departure', '>', now())
            ->get();
          $destinations = $flights->unique('arrival_airport_id')->values()->take(9);
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
          @forelse($destinations as $flight)
            <a href="{{ route('flights', ['arrival' => $flight->arrival_airport_id]) }}" 
               class="group bg-gradient-to-br from-zinc-50 to-white dark:from-zinc-800 dark:to-zinc-700 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-zinc-200 dark:border-zinc-600">
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
                  <span class="text-xl font-bold text-cyan-600 dark:text-cyan-400">₱{{ number_format($flight->base_price, 2) }}</span>
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
            <a href="{{ route('flights') }}" class="inline-flex items-center px-6 py-3 border-2 border-cyan-600 text-cyan-600 dark:text-cyan-400 rounded-lg hover:bg-cyan-50 dark:hover:bg-zinc-700 transition font-semibold">
              View All Flights
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </a>
          </div>
        @endif
      </div>

      <script>
        // Page load animation
        (function() {
          const animateContent = function() {
            const container = document.querySelector('.container.mx-auto');
            if (container) {
              container.style.opacity = '1';
              container.style.transform = 'translateY(0)';
            }
          };
          
          if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', animateContent);
          } else {
            setTimeout(animateContent, 50);
          }
        })();
      </script>
    </x-layouts.app.header>