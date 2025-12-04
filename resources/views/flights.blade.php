<x-layouts.app.header>
  <div class="container mx-auto px-4 py-6">

    {{-- Search Form --}}
    <div class="bg-gradient-to-br from-cyan-50/95 to-blue-50/95 dark:from-zinc-800 dark:to-zinc-700 rounded-lg shadow-lg p-6 mb-8 border-2 border-cyan-200 dark:border-zinc-600 backdrop-blur-sm overflow-visible">
      <form method="GET" action="{{ route('flights') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 overflow-visible">
        <div class="overflow-visible">
          <label for="departure" class="block text-sm font-medium mb-2 text-zinc-900 dark:text-zinc-200">From</label>
          <select name="departure" id="departure" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-cyan-500">
            <option value="">All Airports</option>
            @foreach(\App\Models\Airport::orderBy('location')->get() as $airport)
              <option value="{{ $airport->id }}" {{ request('departure') == $airport->id ? 'selected' : '' }}>
                {{ $airport->location }} ({{ $airport->iata_code }})
              </option>
            @endforeach
          </select>
        </div>

        <div class="overflow-visible">
          <label for="arrival" class="block text-sm font-medium mb-2 text-zinc-900 dark:text-zinc-200">To</label>
          <select name="arrival" id="arrival" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-cyan-500">
            <option value="">All Airports</option>
            @foreach(\App\Models\Airport::orderBy('location')->get() as $airport)
              <option value="{{ $airport->id }}" {{ request('arrival') == $airport->id ? 'selected' : '' }}>
                {{ $airport->location }} ({{ $airport->iata_code }})
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <x-date-picker label="Departure Date" name="date" />
        </div>

        <div class="flex items-end">
          <flux:button type="submit" variant="primary" class="w-full">Search Flights</flux:button>
        </div>
      </form>
    </div>

    @php
      $query = \App\Models\Flight::with(['departureAirport', 'arrivalAirport', 'airline'])
        ->where('status', 'scheduled')
        ->where('scheduled_departure', '>', now());

      if (request('departure')) {
        $query->where('departure_airport_id', request('departure'));
      }
      if (request('arrival')) {
        $query->where('arrival_airport_id', request('arrival'));
      }
      if (request('date')) {
        $query->whereDate('scheduled_departure', request('date'));
      }

      $flights = $query->orderBy('scheduled_departure')->paginate(12);
    @endphp

    {{-- Flight Results --}}
    <div id="flightResults" style="opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease-out, transform 0.6s ease-out;">
    @if($flights->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($flights as $flight)
          <div 
            class="flight-card bg-gradient-to-br from-white to-cyan-50/30 dark:from-zinc-800 dark:to-zinc-700 rounded-lg overflow-hidden shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer border border-cyan-100 dark:border-zinc-600"
            onclick="openBookingModal({{ json_encode([
              'id' => $flight->id,
              'flight_number' => $flight->flight_number,
              'departure' => optional($flight->departureAirport)->location ?? 'Unknown',
              'departure_code' => optional($flight->departureAirport)->iata_code ?? 'N/A',
              'arrival' => optional($flight->arrivalAirport)->location ?? 'Unknown',
              'arrival_code' => optional($flight->arrivalAirport)->iata_code ?? 'N/A',
              'departure_time' => $flight->scheduled_departure ? $flight->scheduled_departure->format('M d, Y H:i') : 'TBA',
              'arrival_time' => $flight->scheduled_arrival ? $flight->scheduled_arrival->format('M d, Y H:i') : 'TBA',
              'airline' => optional($flight->airline)->name ?? 'Unknown',
              'base_price' => number_format($flight->base_price, 2),
              'business_price' => number_format($flight->business_price ?? $flight->base_price * 1.5, 2),
              'image' => optional($flight->arrivalAirport)->image ?? 'img/loginsplash.jpeg'
            ]) }})"
          >
            <div class="relative overflow-hidden h-48">
              <img 
                src="{{ asset(optional($flight->arrivalAirport)->image ?? 'img/loginsplash.jpeg') }}" 
                alt="{{ optional($flight->arrivalAirport)->location ?? 'Destination' }}" 
                class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500"
              >
              <div class="absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent"></div>
              @if(optional($flight->airline)->logo)
                <div class="absolute top-3 right-3 p-2 w-16 h-16 flex items-center justify-center">
                  <img 
                    src="{{ asset($flight->airline->logo) }}" 
                    alt="{{ $flight->airline->name }}" 
                    class="max-w-full max-h-full object-contain"
                    title="{{ $flight->airline->name }}"
                    style="filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.8)) drop-shadow(0 0 12px rgba(255, 255, 255, 0.6)) drop-shadow(0 0 16px rgba(255, 255, 255, 0.4));"
                  >
                </div>
              @endif
              <div class="absolute bottom-3 left-3 right-3 text-white">
                <h3 class="text-xl font-bold">{{ optional($flight->arrivalAirport)->location ?? 'Unknown' }}</h3>
                <p class="text-sm opacity-90">{{ $flight->flight_number }} • {{ optional($flight->airline)->name }}</p>
              </div>
            </div>
            
            <div class="p-4">
              <div class="flex justify-between items-center mb-3">
                <div class="text-center">
                  <div class="text-2xl font-bold text-zinc-900 dark:text-white">{{ optional($flight->departureAirport)->iata_code ?? 'N/A' }}</div>
                  <div class="text-xs text-zinc-600 dark:text-zinc-400">
                    {{ $flight->scheduled_departure ? $flight->scheduled_departure->format('H:i') : 'TBA' }}
                  </div>
                </div>
                
                <div class="flex-1 mx-4">
                  <div class="border-t-2 border-dashed border-zinc-300 dark:border-zinc-600 relative">
                    <svg class="w-6 h-6 text-cyan-500 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                    </svg>
                  </div>
                </div>
                
                <div class="text-center">
                  <div class="text-2xl font-bold text-zinc-900 dark:text-white">{{ optional($flight->arrivalAirport)->iata_code ?? 'N/A' }}</div>
                  <div class="text-xs text-zinc-600 dark:text-zinc-400">
                    {{ $flight->scheduled_arrival ? $flight->scheduled_arrival->format('H:i') : 'TBA' }}
                  </div>
                </div>
              </div>
              
              <div class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">
                {{ $flight->scheduled_departure ? $flight->scheduled_departure->format('M d, Y') : 'TBA' }}
              </div>
              
              <div class="flex justify-between items-center">
                <span class="text-sm text-zinc-600 dark:text-zinc-400">From</span>
                <span class="text-xl font-bold text-cyan-600 dark:text-cyan-400">₱{{ number_format($flight->base_price, 2) }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-8">
        {{ $flights->appends(request()->query())->links() }}
      </div>
    @else
      <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-white">No flights found</h3>
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Try adjusting your search criteria.</p>
      </div>
    @endif
    </div>
  </div>

  {{-- Booking Modal --}}
  <div id="bookingModal" class="hidden fixed inset-0 bg-black/50 z-50 overflow-y-auto" style="animation: fadeIn 0.2s ease-out;">
    <div class="flex min-h-screen items-center justify-center p-4">
      <div id="modalInner" class="bg-white dark:bg-zinc-800 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()" style="animation: scaleIn 0.3s ease-out;">
        <div id="modalContent"></div>
      </div>
    </div>
  </div>

  <style>
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
      }
      to {
        opacity: 0;
      }
    }

    @keyframes scaleOut {
      from {
        opacity: 1;
        transform: scale(1);
      }
      to {
        opacity: 0;
        transform: scale(0.95);
      }
    }
  </style>

  <script>
    // Use window object to avoid redeclaration errors with Livewire navigation
    window.flightBooking = window.flightBooking || {
      currentFlight: null,
      selectedSeat: null,
      selectedClass: 'economy',
      bookedSeats: [],
      currentStep: 'booking'
    };

    function openBookingModal(flight) {
      // Check if user is authenticated
      @guest
        window.location.href = "{{ route('login') }}";
      @endguest

      window.flightBooking.currentFlight = flight;
      window.flightBooking.selectedSeat = null;
      window.flightBooking.selectedClass = 'economy';
      window.flightBooking.currentStep = 'booking';
      
      // Fetch booked seats for this flight
      fetch(`/api/flights/${flight.id}/booked-seats`)
        .then(response => response.json())
        .then(data => {
          window.flightBooking.bookedSeats = data.booked_seats || [];
          renderBookingStep();
        })
        .catch(error => {
          console.error('Error fetching booked seats:', error);
          window.flightBooking.bookedSeats = [];
          renderBookingStep();
        });
    }

    function renderBookingStep() {
      const modal = document.getElementById('bookingModal');
      const modalContent = document.getElementById('modalContent');
      const flight = window.flightBooking.currentFlight;
      
      modalContent.innerHTML = `
        <div class="p-6">
          <div class="flex justify-between items-start mb-6">
            <div>
              <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Book Flight ${flight.flight_number}</h2>
              <div class="flex items-center gap-2 mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                <span>Booking</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-zinc-400">Checkout</span>
              </div>
            </div>
            <button onclick="closeBookingModal()" class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>

          <div class="mb-6 rounded-lg overflow-hidden">
            <img src="{{ asset('${flight.image}') }}" alt="${flight.arrival}" class="w-full h-48 object-cover">
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-zinc-100 dark:bg-zinc-700 p-4 rounded-lg">
              <h3 class="font-semibold mb-2 text-zinc-900 dark:text-white">Flight Details</h3>
              <div class="space-y-2 text-sm text-zinc-700 dark:text-zinc-300">
                <div><span class="font-medium">Flight:</span> ${flight.flight_number}</div>
                <div><span class="font-medium">Airline:</span> ${flight.airline}</div>
                <div><span class="font-medium">From:</span> ${flight.departure} (${flight.departure_code})</div>
                <div><span class="font-medium">To:</span> ${flight.arrival} (${flight.arrival_code})</div>
                <div><span class="font-medium">Departure:</span> ${flight.departure_time}</div>
                <div><span class="font-medium">Arrival:</span> ${flight.arrival_time}</div>
              </div>
            </div>

            <div class="bg-zinc-100 dark:bg-zinc-700 p-4 rounded-lg">
              <h3 class="font-semibold mb-2 text-zinc-900 dark:text-white">Class & Pricing</h3>
              <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-3">Automatically selected based on your seat choice</p>
              <div class="space-y-2">
                <div id="economy-class-display" class="flex items-center justify-between p-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-800 opacity-60">
                  <div>
                    <div class="font-medium text-zinc-900 dark:text-white">Economy</div>
                    <div class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">₱${flight.base_price}</div>
                  </div>
                  <div class="w-5 h-5 rounded-full border-2 border-zinc-300 dark:border-zinc-600"></div>
                </div>
                <div id="business-class-display" class="flex items-center justify-between p-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-800 opacity-60">
                  <div>
                    <div class="font-medium text-zinc-900 dark:text-white">Business</div>
                    <div class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">₱${flight.business_price}</div>
                  </div>
                  <div class="w-5 h-5 rounded-full border-2 border-zinc-300 dark:border-zinc-600"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-zinc-900 text-white rounded-lg p-6 mb-6">
            <h3 class="font-semibold mb-4 text-center">Select Your Seat</h3>
            
            <div class="max-w-md mx-auto">
              <div class="mb-6">
                <div class="text-xs text-zinc-400 mb-2 text-center">Business Class</div>
                ${generateSeats(1, 2)}
              </div>

              <div>
                <div class="text-xs text-zinc-400 mb-2 text-center">Economy Class</div>
                ${generateSeats(3, 6)}
              </div>

              <div class="flex items-center justify-center gap-6 mt-6 text-xs">
                <div class="flex items-center gap-2">
                  <span class="inline-block w-6 h-6 bg-zinc-800 rounded border border-zinc-600"></span>
                  <span>Available</span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="inline-block w-6 h-6 bg-green-500 rounded"></span>
                  <span>Selected</span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="inline-block w-6 h-6 bg-red-500 rounded"></span>
                  <span>Occupied</span>
                </div>
              </div>

              <div class="mt-4 text-center text-sm">
                <span id="selectedSeatDisplay" class="text-zinc-300">No seat selected</span>
              </div>
            </div>
          </div>

          <div class="flex justify-end gap-3">
            <button id="checkoutButton" onclick="showCheckoutStep()" disabled class="px-6 py-2 bg-zinc-400 text-white rounded-lg cursor-not-allowed transition">Select a seat to continue</button>
          </div>
        </div>
      `;
      
      modal.classList.remove('hidden');
      
      // Reset animations
      modal.style.animation = 'fadeIn 0.2s ease-out';
      modalInner.style.animation = 'scaleIn 0.3s ease-out';
      
      document.querySelectorAll('.seat-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          if (this.disabled) return;
          
          document.querySelectorAll('.seat-btn:not([disabled])').forEach(b => {
            b.classList.remove('bg-green-500');
            b.classList.add('bg-zinc-800');
          });
          this.classList.remove('bg-zinc-800');
          this.classList.add('bg-green-500');
          window.flightBooking.selectedSeat = this.dataset.seat;
          
          // Auto-detect class based on seat row (rows 1-2 = business, rows 3-6 = economy)
          const seatRow = parseInt(window.flightBooking.selectedSeat.charAt(0));
          if (seatRow >= 1 && seatRow <= 2) {
            window.flightBooking.selectedClass = 'business';
            // Update UI to show business class selected
            document.getElementById('business-class-display').classList.remove('opacity-60', 'border-zinc-300', 'dark:border-zinc-600');
            document.getElementById('business-class-display').classList.add('border-cyan-500', 'bg-cyan-50', 'dark:bg-cyan-900/20');
            document.getElementById('business-class-display').querySelector('.w-5').innerHTML = '<div class="w-3 h-3 rounded-full bg-cyan-600 m-auto"></div>';
            
            document.getElementById('economy-class-display').classList.add('opacity-60');
            document.getElementById('economy-class-display').classList.remove('border-cyan-500', 'bg-cyan-50', 'dark:bg-cyan-900/20');
            document.getElementById('economy-class-display').classList.add('border-zinc-300', 'dark:border-zinc-600');
            document.getElementById('economy-class-display').querySelector('.w-5').innerHTML = '';
          } else {
            window.flightBooking.selectedClass = 'economy';
            // Update UI to show economy class selected
            document.getElementById('economy-class-display').classList.remove('opacity-60', 'border-zinc-300', 'dark:border-zinc-600');
            document.getElementById('economy-class-display').classList.add('border-cyan-500', 'bg-cyan-50', 'dark:bg-cyan-900/20');
            document.getElementById('economy-class-display').querySelector('.w-5').innerHTML = '<div class="w-3 h-3 rounded-full bg-cyan-600 m-auto"></div>';
            
            document.getElementById('business-class-display').classList.add('opacity-60');
            document.getElementById('business-class-display').classList.remove('border-cyan-500', 'bg-cyan-50', 'dark:bg-cyan-900/20');
            document.getElementById('business-class-display').classList.add('border-zinc-300', 'dark:border-zinc-600');
            document.getElementById('business-class-display').querySelector('.w-5').innerHTML = '';
          }
          
          document.getElementById('selectedSeatDisplay').textContent = 'Selected: ' + window.flightBooking.selectedSeat + ' (' + window.flightBooking.selectedClass.charAt(0).toUpperCase() + window.flightBooking.selectedClass.slice(1) + ')';
          
          // Enable checkout button
          const checkoutBtn = document.getElementById('checkoutButton');
          checkoutBtn.disabled = false;
          checkoutBtn.classList.remove('bg-zinc-400', 'cursor-not-allowed');
          checkoutBtn.classList.add('bg-cyan-600', 'hover:bg-cyan-700');
          checkoutBtn.textContent = 'Proceed to Checkout';
        });
      });
    }

    function generateSeats(startRow, endRow) {
      let html = '';
      
      for (let row = startRow; row <= endRow; row++) {
        html += '<div class="flex items-center justify-center gap-2 mb-2">';
        html += '<div class="flex gap-1">';
        for (let col of ['A', 'B', 'C']) {
          const seat = row + col;
          const isBooked = window.flightBooking.bookedSeats.includes(seat);
          const disabledAttr = isBooked ? 'disabled' : '';
          const bgClass = isBooked ? 'bg-red-500 cursor-not-allowed' : 'bg-zinc-800 hover:bg-zinc-700 hover:scale-105';
          html += `<button type="button" class="seat-btn ${bgClass} w-8 h-8 rounded text-xs transform transition" data-seat="${seat}" ${disabledAttr}>${seat}</button>`;
        }
        html += '</div><div class="w-4"></div><div class="flex gap-1">';
        for (let col of ['D', 'E', 'F']) {
          const seat = row + col;
          const isBooked = window.flightBooking.bookedSeats.includes(seat);
          const disabledAttr = isBooked ? 'disabled' : '';
          const bgClass = isBooked ? 'bg-red-500 cursor-not-allowed' : 'bg-zinc-800 hover:bg-zinc-700 hover:scale-105';
          html += `<button type="button" class="seat-btn ${bgClass} w-8 h-8 rounded text-xs transform transition" data-seat="${seat}" ${disabledAttr}>${seat}</button>`;
        }
        html += '</div></div>';
      }
      
      return html;
    }

    function closeBookingModal() {
      const modal = document.getElementById('bookingModal');
      const modalInner = document.getElementById('modalInner');
      
      // Animate out
      modal.style.animation = 'fadeOut 0.2s ease-out';
      modalInner.style.animation = 'scaleOut 0.2s ease-out';
      
      setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.animation = '';
        modalInner.style.animation = '';
        window.flightBooking.currentStep = 'booking';
      }, 200);
    }

    function showCheckoutStep() {
      if (!window.flightBooking.selectedSeat) {
        return; // Button should be disabled, but double-check
      }

      window.flightBooking.currentStep = 'checkout';
      const modalContent = document.getElementById('modalContent');
      const flight = window.flightBooking.currentFlight;
      const price = window.flightBooking.selectedClass === 'business' ? flight.business_price : flight.base_price;

      modalContent.innerHTML = `
        <div class="p-6">
          <div class="flex justify-between items-start mb-6">
            <div>
              <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Checkout</h2>
              <div class="flex items-center gap-2 mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                <svg class="w-4 h-4 text-cyan-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
                <span class="text-cyan-600 font-medium">Booking</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-cyan-600 font-medium">Checkout</span>
              </div>
            </div>
            <button onclick="closeBookingModal()" class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>

          <div class="bg-cyan-50 dark:bg-cyan-900/20 border border-cyan-200 dark:border-cyan-800 rounded-lg p-4 mb-6">
            <div class="flex items-start gap-3">
              <svg class="w-6 h-6 text-cyan-600 dark:text-cyan-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <div class="text-sm text-cyan-800 dark:text-cyan-300">
                <p class="font-semibold mb-1">Mockup Checkout Page</p>
                <p>This is a demonstration checkout page. In a real application, this would include payment processing, passenger details forms, and booking confirmation.</p>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="space-y-6">
              <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg border border-zinc-200 dark:border-zinc-600">
                <h3 class="font-semibold text-lg mb-4 text-zinc-900 dark:text-white">Booking Summary</h3>
                <div class="space-y-3 text-sm">
                  <div class="flex justify-between">
                    <span class="text-zinc-600 dark:text-zinc-400">Flight Number:</span>
                    <span class="font-medium text-zinc-900 dark:text-white">${flight.flight_number}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-zinc-600 dark:text-zinc-400">Route:</span>
                    <span class="font-medium text-zinc-900 dark:text-white">${flight.departure_code} → ${flight.arrival_code}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-zinc-600 dark:text-zinc-400">Departure:</span>
                    <span class="font-medium text-zinc-900 dark:text-white">${flight.departure_time}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-zinc-600 dark:text-zinc-400">Class:</span>
                    <span class="font-medium text-zinc-900 dark:text-white capitalize">${window.flightBooking.selectedClass}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-zinc-600 dark:text-zinc-400">Seat:</span>
                    <span class="font-medium text-zinc-900 dark:text-white">${window.flightBooking.selectedSeat}</span>
                  </div>
                  <div class="border-t border-zinc-200 dark:border-zinc-600 pt-3 mt-3">
                    <div class="flex justify-between items-center">
                      <span class="font-semibold text-zinc-900 dark:text-white">Total:</span>
                      <span class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">₱${price}</span>
                    </div>
                  </div>
                </div>  
              </div>

              <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg border border-zinc-200 dark:border-zinc-600">
                <h3 class="font-semibold text-lg mb-4 text-zinc-900 dark:text-white">Passenger Details</h3>
                <div class="space-y-4">
                  <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Full Name</label>
                    <input type="text" disabled placeholder="John Doe" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Email</label>
                    <input type="email" disabled placeholder="john@example.com" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Phone</label>
                    <input type="tel" disabled placeholder="+63 912 345 6789" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white">
                  </div>
                </div>
              </div>
            </div>

            <div class="space-y-6">
              <div class="bg-white dark:bg-zinc-700 p-6 rounded-lg border border-zinc-200 dark:border-zinc-600">
                <h3 class="font-semibold text-lg mb-4 text-zinc-900 dark:text-white">Payment Method</h3>
                <div class="space-y-3">
                  <label class="flex items-center p-4 border-2 border-cyan-500 rounded-lg cursor-not-allowed bg-zinc-50 dark:bg-zinc-800">
                    <input type="radio" checked disabled class="w-5 h-5 text-cyan-600">
                    <div class="ml-3">
                      <div class="font-medium text-zinc-900 dark:text-white">Credit/Debit Card</div>
                      <div class="text-xs text-zinc-500 dark:text-zinc-400">Visa, Mastercard, Amex</div>
                    </div>
                  </label>
                  <label class="flex items-center p-4 border-2 border-zinc-300 dark:border-zinc-600 rounded-lg cursor-not-allowed bg-zinc-50 dark:bg-zinc-800 opacity-60">
                    <input type="radio" disabled class="w-5 h-5">
                    <div class="ml-3">
                      <div class="font-medium text-zinc-900 dark:text-white">PayPal</div>
                      <div class="text-xs text-zinc-500 dark:text-zinc-400">Pay securely with PayPal</div>
                    </div>
                  </label>
                  <label class="flex items-center p-4 border-2 border-zinc-300 dark:border-zinc-600 rounded-lg cursor-not-allowed bg-zinc-50 dark:bg-zinc-800 opacity-60">
                    <input type="radio" disabled class="w-5 h-5">
                    <div class="ml-3">
                      <div class="font-medium text-zinc-900 dark:text-white">GCash</div>
                      <div class="text-xs text-zinc-500 dark:text-zinc-400">Mobile wallet payment</div>
                    </div>
                  </label>
                </div>

                <div class="mt-4 space-y-3">
                  <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Card Number</label>
                    <input type="text" disabled placeholder="1234 5678 9012 3456" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white">
                  </div>
                  <div class="grid grid-cols-2 gap-3">
                    <div>
                      <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Expiry</label>
                      <input type="text" disabled placeholder="MM/YY" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white">
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">CVV</label>
                      <input type="text" disabled placeholder="123" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white">
                    </div>
                  </div>
                </div>
              </div>

              <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <div class="flex items-start gap-3">
                  <svg class="w-6 h-6 text-green-600 dark:text-green-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                  </svg>
                  <div class="text-sm text-green-800 dark:text-green-300">
                    <p class="font-semibold">Secure Payment</p>
                    <p class="text-xs">Your payment information is encrypted and secure.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-between items-center pt-6 border-t border-zinc-200 dark:border-zinc-600">
            <button onclick="renderBookingStep()" class="px-4 py-2 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white flex items-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
              </svg>
              Back to Booking
            </button>
            <button onclick="confirmBooking()" class="px-8 py-3 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition font-semibold flex items-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
              Confirm & Pay ₱${price}
            </button>
          </div>
        </div>
      `;
    }

    function confirmBooking() {
      const confirmBtn = event.target;
      confirmBtn.disabled = true;
      confirmBtn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...';

      fetch('{{ route("book.flight") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          flight_id: window.flightBooking.currentFlight.id,
          seat_number: window.flightBooking.selectedSeat,
          class: window.flightBooking.selectedClass
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Flight booked successfully! Check My Bookings to view your booking.');
          window.location.href = '{{ route("bookings") }}';
        } else {
          alert('Booking failed: ' + (data.message || 'Unknown error'));
          confirmBtn.disabled = false;
          confirmBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Confirm & Pay';
        }
      })
      .catch(error => {
        alert('An error occurred. Please try again.');
        console.error(error);
        confirmBtn.disabled = false;
        confirmBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Confirm & Pay';
      });
    }

    document.getElementById('bookingModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeBookingModal();
      }
    });

    // Searchable dropdown functionality
    function makeSelectSearchable(selectId) {
      const select = document.getElementById(selectId);
      const parent = select.parentElement;
      
      // Create wrapper
      const wrapper = document.createElement('div');
      wrapper.className = 'relative searchable-select-wrapper';
      parent.insertBefore(wrapper, select);
      wrapper.appendChild(select);
      
      // Create search input
      const searchInput = document.createElement('input');
      searchInput.type = 'text';
      searchInput.placeholder = 'Search or select...';
      searchInput.className = 'w-full pl-4 pr-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-cyan-500';
      
      // Create dropdown container
      const dropdown = document.createElement('div');
      dropdown.className = 'absolute w-full mt-1 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-600 rounded-lg shadow-xl max-h-60 overflow-y-auto hidden';
      dropdown.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2)';
      dropdown.style.zIndex = '10000';
      
      // Get all options
      const options = Array.from(select.options);
      
      // Populate dropdown
      options.forEach(option => {
        const div = document.createElement('div');
        div.className = 'px-4 py-2 hover:bg-cyan-100 dark:hover:bg-zinc-700 cursor-pointer text-zinc-900 dark:text-white';
        div.textContent = option.textContent.trim();
        div.dataset.value = option.value;
        
        div.addEventListener('click', () => {
          select.value = option.value;
          searchInput.value = option.textContent.trim();
          dropdown.classList.add('hidden');
          select.dispatchEvent(new Event('change'));
        });
        
        dropdown.appendChild(div);
      });
      
      // Replace select with search input
      select.style.display = 'none';
      wrapper.insertBefore(searchInput, select);
      document.body.appendChild(dropdown); // Append to body to avoid stacking context issues
      
      // Set initial value
      const selectedOption = options.find(opt => opt.selected);
      if (selectedOption && selectedOption.value) {
        searchInput.value = selectedOption.textContent.trim();
      }
      
      // Position dropdown
      function positionDropdown() {
        const rect = searchInput.getBoundingClientRect();
        dropdown.style.position = 'fixed';
        dropdown.style.top = (rect.bottom + 2) + 'px';
        dropdown.style.left = rect.left + 'px';
        dropdown.style.width = rect.width + 'px';
      }
      
      // Search functionality
      searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.toLowerCase();
        let hasVisibleItems = false;
        let firstVisibleDiv = null;
        
        dropdown.querySelectorAll('div').forEach(div => {
          const text = div.textContent.toLowerCase();
          if (text.includes(searchTerm)) {
            div.style.display = 'block';
            hasVisibleItems = true;
            if (!firstVisibleDiv) {
              firstVisibleDiv = div;
            }
          } else {
            div.style.display = 'none';
          }
        });
        
        if (hasVisibleItems) {
          positionDropdown();
          dropdown.classList.remove('hidden');
        } else {
          dropdown.classList.add('hidden');
        }
      });
      
      // Handle Enter key to auto-select first match
      searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
          e.preventDefault();
          const searchTerm = searchInput.value.toLowerCase();
          
          // Find first visible option that matches
          const visibleDivs = Array.from(dropdown.querySelectorAll('div')).filter(div => 
            div.style.display !== 'none' && div.textContent.toLowerCase().includes(searchTerm)
          );
          
          if (visibleDivs.length > 0) {
            const firstMatch = visibleDivs[0];
            select.value = firstMatch.dataset.value;
            searchInput.value = firstMatch.textContent.trim();
            dropdown.classList.add('hidden');
            select.dispatchEvent(new Event('change'));
          }
        }
      });
      
      // Auto-select first match on blur if text was entered
      searchInput.addEventListener('blur', (e) => {
        // Small delay to allow click events on dropdown to fire first
        setTimeout(() => {
          const searchTerm = searchInput.value.toLowerCase();
          
          if (searchTerm && select.value === '') {
            // Find first visible option that matches
            const visibleDivs = Array.from(dropdown.querySelectorAll('div')).filter(div => 
              div.style.display !== 'none' && div.textContent.toLowerCase().includes(searchTerm)
            );
            
            if (visibleDivs.length > 0) {
              const firstMatch = visibleDivs[0];
              select.value = firstMatch.dataset.value;
              searchInput.value = firstMatch.textContent.trim();
              select.dispatchEvent(new Event('change'));
            }
          }
        }, 200);
      });
      
      // Show dropdown on focus
      searchInput.addEventListener('focus', () => {
        positionDropdown();
        dropdown.classList.remove('hidden');
      });
      
      // Reposition on scroll/resize
      window.addEventListener('scroll', () => {
        if (!dropdown.classList.contains('hidden')) {
          positionDropdown();
        }
      });
      
      window.addEventListener('resize', () => {
        if (!dropdown.classList.contains('hidden')) {
          positionDropdown();
        }
      });
      
      // Hide dropdown when clicking outside
      document.addEventListener('click', (e) => {
        if (!wrapper.contains(e.target) && !dropdown.contains(e.target)) {
          dropdown.classList.add('hidden');
        }
      });
    }
    
    // Initialize searchable selects
    makeSelectSearchable('departure');
    makeSelectSearchable('arrival');

    // Page load animation - only on first load, not after search
    (function() {
      const animateContent = function() {
        const flightResults = document.getElementById('flightResults');
        if (flightResults && !sessionStorage.getItem('flightsAnimated')) {
          flightResults.style.opacity = '1';
          flightResults.style.transform = 'translateY(0)';
          sessionStorage.setItem('flightsAnimated', 'true');
        } else if (flightResults) {
          // Skip animation on subsequent searches
          flightResults.style.opacity = '1';
          flightResults.style.transform = 'translateY(0)';
          flightResults.style.transition = 'none';
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
