<x-layouts.app.header>
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6 text-zinc-900 dark:text-white">Browse Flights</h1>

    {{-- Search Form --}}
    <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-md p-6 mb-8">
      <form method="GET" action="{{ route('flights') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
          <label for="departure" class="block text-sm font-medium mb-2 text-zinc-900 dark:text-zinc-200">From</label>
          <select name="departure" id="departure" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500">
            <option value="">All Airports</option>
            @foreach(\App\Models\Airport::orderBy('location')->get() as $airport)
              <option value="{{ $airport->id }}" {{ request('departure') == $airport->id ? 'selected' : '' }}>
                {{ $airport->location }} ({{ $airport->iata_code }})
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label for="arrival" class="block text-sm font-medium mb-2 text-zinc-900 dark:text-zinc-200">To</label>
          <select name="arrival" id="arrival" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500">
            <option value="">All Airports</option>
            @foreach(\App\Models\Airport::orderBy('location')->get() as $airport)
              <option value="{{ $airport->id }}" {{ request('arrival') == $airport->id ? 'selected' : '' }}>
                {{ $airport->location }} ({{ $airport->iata_code }})
              </option>
            @endforeach
          </select>
        </div>

        <div>
          <label for="date" class="block text-sm font-medium mb-2 text-zinc-900 dark:text-zinc-200">Departure Date</label>
          <input type="date" name="date" id="date" value="{{ request('date') }}" class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex items-end">
          <flux:button type="submit" variant="primary" class="w-full">Search Flights</flux:button>
        </div>
      </form>
    </div>

    @php
      $query = \App\Models\Flight::with(['departureAirport', 'arrivalAirport', 'airline'])
        ->where('status', 'Scheduled')
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
    @if($flights->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($flights as $flight)
          <div 
            class="flight-card bg-white dark:bg-zinc-700 rounded-lg overflow-hidden shadow-md hover:shadow-xl transform hover:-translate-y-2 transition-all duration-300 cursor-pointer"
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
                    <svg class="w-6 h-6 text-blue-500 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 20 20">
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
                <span class="text-xl font-bold text-blue-600 dark:text-blue-400">₱{{ number_format($flight->base_price, 2) }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-8">
        {{ $flights->links() }}
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

  {{-- Booking Modal --}}
  <div id="bookingModal" class="hidden fixed inset-0 bg-black/50 z-50 overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center p-4">
      <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <div id="modalContent"></div>
      </div>
    </div>
  </div>

  <script>
    let currentFlight = null;
    let selectedSeat = null;
    let selectedClass = 'economy';

    function openBookingModal(flight) {
      currentFlight = flight;
      selectedSeat = null;
      selectedClass = 'economy';
      
      const modal = document.getElementById('bookingModal');
      const modalContent = document.getElementById('modalContent');
      
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
              <h3 class="font-semibold mb-2 text-zinc-900 dark:text-white">Select Class</h3>
              <div class="space-y-2">
                <label class="flex items-center justify-between p-3 border-2 border-blue-500 rounded-lg cursor-pointer hover:bg-zinc-200 dark:hover:bg-zinc-600 transition class-option" data-class="economy">
                  <div>
                    <div class="font-medium text-zinc-900 dark:text-white">Economy</div>
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">₱${flight.base_price}</div>
                  </div>
                  <input type="radio" name="class" value="economy" checked class="w-5 h-5">
                </label>
                <label class="flex items-center justify-between p-3 border-2 border-zinc-300 dark:border-zinc-600 rounded-lg cursor-pointer hover:bg-zinc-200 dark:hover:bg-zinc-600 transition class-option" data-class="business">
                  <div>
                    <div class="font-medium text-zinc-900 dark:text-white">Business</div>
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">₱${flight.business_price}</div>
                  </div>
                  <input type="radio" name="class" value="business" class="w-5 h-5">
                </label>
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
              </div>

              <div class="mt-4 text-center text-sm">
                <span id="selectedSeatDisplay" class="text-zinc-300">No seat selected</span>
              </div>
            </div>
          </div>

          <div class="flex justify-end gap-3">
            <button onclick="closeBookingModal()" class="px-4 py-2 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Cancel</button>
            <button onclick="proceedToCheckout()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Proceed to Checkout</button>
          </div>
        </div>
      `;
      
      modal.classList.remove('hidden');
      
      document.querySelectorAll('.class-option').forEach(option => {
        option.addEventListener('click', function() {
          selectedClass = this.dataset.class;
          document.querySelectorAll('.class-option').forEach(o => {
            o.classList.remove('border-blue-500');
            o.classList.add('border-zinc-300', 'dark:border-zinc-600');
          });
          this.classList.remove('border-zinc-300', 'dark:border-zinc-600');
          this.classList.add('border-blue-500');
        });
      });

      document.querySelectorAll('.seat-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          document.querySelectorAll('.seat-btn').forEach(b => {
            b.classList.remove('bg-green-500');
            b.classList.add('bg-zinc-800');
          });
          this.classList.remove('bg-zinc-800');
          this.classList.add('bg-green-500');
          selectedSeat = this.dataset.seat;
          document.getElementById('selectedSeatDisplay').textContent = 'Selected: ' + selectedSeat;
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
          html += `<button type="button" class="seat-btn bg-zinc-800 w-8 h-8 rounded text-xs hover:bg-zinc-700 hover:scale-105 transform transition" data-seat="${seat}">${seat}</button>`;
        }
        html += '</div><div class="w-4"></div><div class="flex gap-1">';
        for (let col of ['D', 'E', 'F']) {
          const seat = row + col;
          html += `<button type="button" class="seat-btn bg-zinc-800 w-8 h-8 rounded text-xs hover:bg-zinc-700 hover:scale-105 transform transition" data-seat="${seat}">${seat}</button>`;
        }
        html += '</div></div>';
      }
      
      return html;
    }

    function closeBookingModal() {
      document.getElementById('bookingModal').classList.add('hidden');
    }

    function proceedToCheckout() {
      if (!selectedSeat) {
        alert('Please select a seat first!');
        return;
      }

      const checkoutBtn = event.target;
      checkoutBtn.disabled = true;
      checkoutBtn.textContent = 'Processing...';

      fetch('{{ route("book.flight") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          flight_id: currentFlight.id,
          seat_number: selectedSeat,
          class: selectedClass
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Flight booked successfully! Check My Bookings to view your booking.');
          window.location.href = '{{ route("bookings") }}';
        } else {
          alert('Booking failed: ' + (data.message || 'Unknown error'));
          checkoutBtn.disabled = false;
          checkoutBtn.textContent = 'Proceed to Checkout';
        }
      })
      .catch(error => {
        alert('An error occurred. Please try again.');
        console.error(error);
        checkoutBtn.disabled = false;
        checkoutBtn.textContent = 'Proceed to Checkout';
      });
    }

    document.getElementById('bookingModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeBookingModal();
      }
    });
  </script>
</x-layouts.app.header>
