      <x-layouts.app.header>
        <div class="container mx-auto px-4 py-6">
        <h2 class="section-title">My Flights</h2>

          @php
          $userId = auth()->id() ?? 0;
          $bookings = \App\Models\Booking::with('flight')->where('user_id', $userId)->get();

          // Available flights: scheduled and departing in the future, exclude flights user already booked
          $bookedFlightIds = $bookings->pluck('flight_id')->filter()->values()->all();

          $availableFlights = \App\Models\Flight::with('departureAirport','arrivalAirport')
            ->where('status', 'Scheduled')
            ->where('scheduled_departure', '>', now())
            ->when(!empty($bookedFlightIds), function($q) use ($bookedFlightIds) {
                $q->whereNotIn('id', $bookedFlightIds);
            })
            ->orderBy('scheduled_departure')
            ->take(8)
            ->get();
        @endphp

        <div class="mt-4 bg-white dark:bg-zinc-800 rounded-lg shadow-sm overflow-hidden">
          <div class="p-4">
            @if(session('success'))
              <div class="mb-3 p-2 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
            @endif
            @if(session('error'))
              <div class="mb-3 p-2 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
            @endif
            <flux:heading size="lg">My Flights</flux:heading>
            <div class="mt-4">
              <div class="flex gap-2" role="tablist">
                <button type="button" data-tab="seat" class="tab-btn active px-3 py-1 rounded bg-zinc-800 text-sm">Seat Selection</button>
                <button type="button" data-tab="reservations" class="tab-btn px-3 py-1 rounded bg-zinc-700 text-sm">My Reservations</button>
              </div>
            </div>

            {{-- Seat selection preview (shows first booking if available) --}}
            <div id="tab-seat" class="tab-content mt-6">
                @php
                  $selectedBookingId = session('booking_id');
                  if ($selectedBookingId) {
                    $selectedBooking = $bookings->firstWhere('id', $selectedBookingId);
                    if ($selectedBooking) {
                      $first = $selectedBooking;
                      $flight = $first->flight;
                    }
                  }
                @endphp

                @if($bookings->isEmpty())
                <div class="p-4 bg-white dark:bg-zinc-700 rounded-md">
                  <div>No active bookings yet.</div>
                </div>
              @else
                @php if (!isset($first)) { $first = $bookings->first(); $flight = $first->flight; } @endphp

                <div class="p-0 overflow-hidden">
                  <div class="p-0">
                    {{-- Simple JS-backed seat selector (non-Livewire) --}}
                    <form method="POST" action="{{ route('booking.seat', ['booking' => $first->id]) }}" id="seatForm">
                      @csrf
                      <input type="hidden" name="seat_number" id="selectedSeatInput" value="{{ $first->seat_number ?? '' }}">

                      <div class="mb-3 p-3 bg-blue-700 text-white rounded-t-md">
                        <div class="text-xs">Philippine Airlines</div>
                        <div class="text-lg font-semibold">{{ optional($flight)->departure_airport_id ?? 'MNL' }} to {{ optional($flight)->arrival_airport_id ?? 'NRT' }}</div>
                        <div class="text-xs">{{ optional($flight)->flight_number ?? 'PR 428' }}</div>
                      </div>

                      <div class="p-4 bg-zinc-900 text-white rounded-b-md">
                        <div class="seat-grid">
                          @php $cols = ['A','B','C','D','E','F']; @endphp
                          <div class="grid grid-cols-6 gap-2 text-center text-xs text-zinc-300">
                            @foreach($cols as $col)
                              <div>{{ $col }}</div>
                            @endforeach
                          </div>

                          @for($row=1;$row<=6;$row++)
                            <div class="mt-2 grid grid-cols-6 gap-2">
                              @foreach($cols as $col)
                                @php $seat = $row.$col; @endphp
                                <button type="button" class="seat-btn bg-zinc-800 px-2 py-2 rounded text-sm hover:bg-zinc-700 hover:scale-105 transform transition duration-150 ease-in-out" data-seat="{{ $seat }}">{{ $seat }}</button>
                              @endforeach
                            </div>
                          @endfor

                          <div class="flex items-center gap-3 mt-4">
                            <div><span class="inline-block w-3 h-3 bg-zinc-800 rounded-sm border"></span> Available</div>
                            <div><span class="inline-block w-3 h-3 bg-green-500 rounded-sm"></span> Selected</div>
                          </div>

                          <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-3 py-1 rounded bg-accent text-white">Confirm Seat</button>
                            <span id="seatChosen" class="ml-3 text-sm text-zinc-300">{{ $first->seat_number ? 'Selected: ' . $first->seat_number : '' }}</span>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              @endif
            </div>

            {{-- Available flights (from DB) --}}
            <div class="mt-6">
              <flux:heading size="md">Available Flights</flux:heading>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-3">
                @forelse($availableFlights as $af)
                  <div class="p-3 bg-white dark:bg-zinc-800 rounded-md flex items-center justify-between">
                    <div>
                      <div class="font-semibold">{{ optional($af->departureAirport)->iata_code ?? $af->departure_airport_id }} to {{ optional($af->arrivalAirport)->iata_code ?? $af->arrival_airport_id }}</div>
                      <div class="text-xs text-zinc-500">{{ $af->flight_number }} • {{ \Carbon\Carbon::parse($af->scheduled_departure)->format('M d, Y H:i') }}</div>
                    </div>

                    <div class="text-right">
                      <div class="font-semibold">₱ {{ number_format($af->base_price ?? 0,2) }}</div>
                      <form method="POST" action="{{ route('book.flight') }}" class="mt-2">
                        @csrf
                        <input type="hidden" name="flight_id" value="{{ $af->id }}">
                        <button type="submit" class="inline-flex items-center px-3 py-1 rounded bg-accent text-white text-sm">Book</button>
                      </form>
                    </div>
                  </div>
                @empty
                  <div class="p-3 bg-white dark:bg-zinc-700 rounded-md">No available flights at the moment.</div>
                @endforelse
              </div>
            </div>
            </div> <!-- end tab-seat -->

            {{-- Reservations tab content --}}
            <div id="tab-reservations" class="tab-content mt-6" style="display:none">
              @foreach($bookings as $b)
                @php $f = $b->flight; @endphp
                <div class="mb-3 p-3 bg-white dark:bg-zinc-800 rounded-md reservation-card cursor-pointer transform transition hover:-translate-y-1 hover:shadow-lg">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                      <div class="airline-logo text-sm text-red-600 font-semibold">Philippine Airlines</div>
                      <div>
                        <div class="font-semibold">{{ optional($f)->departure_airport_id ?? 'MNL' }} to {{ optional($f)->arrival_airport_id ?? 'NRT' }}</div>
                        <div class="text-xs text-zinc-500">{{ $f->flight_number ?? 'PR 428' }} • Seat: {{ $b->seat_number ?? '—' }}</div>
                      </div>
                    </div>

                    <div class="flex items-center gap-3">
                      @if($b->status === 'confirmed' || $b->status === 'Confirmed')
                        <flux:badge color="green">Confirmed</flux:badge>
                      @else
                        <flux:badge color="amber">{{ ucfirst($b->status ?? 'Pending') }}</flux:badge>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        </div>
      </x-layouts.app.header>

      <script>
        (function(){
          // Seat selection JS for the non-Livewire seat selector
          const seatBtns = document.querySelectorAll('.seat-btn');
          let selectedBtn = null;
          seatBtns.forEach(btn => {
            btn.addEventListener('click', () => {
              // toggle previous
              if (selectedBtn) {
                selectedBtn.classList.remove('bg-green-500');
                selectedBtn.classList.add('bg-zinc-800');
              }
              btn.classList.remove('bg-zinc-800');
              btn.classList.add('bg-green-500');
              selectedBtn = btn;
              const input = document.getElementById('selectedSeatInput');
              if (input) input.value = btn.getAttribute('data-seat');
              const chosen = document.getElementById('seatChosen');
              if (chosen) chosen.textContent = 'Selected: ' + btn.getAttribute('data-seat');
            });
          });

          // Tab switching logic
          const tabButtons = document.querySelectorAll('.tab-btn');
          const tabSeat = document.getElementById('tab-seat');
          const tabReservations = document.getElementById('tab-reservations');

          function setActiveTab(name) {
            tabButtons.forEach(b => b.classList.toggle('active', b.getAttribute('data-tab') === name));
            if (name === 'seat') {
              if (tabSeat) tabSeat.style.display = '';
              if (tabReservations) tabReservations.style.display = 'none';
            } else {
              if (tabSeat) tabSeat.style.display = 'none';
              if (tabReservations) tabReservations.style.display = '';
            }
          }

          tabButtons.forEach(b => b.addEventListener('click', () => setActiveTab(b.getAttribute('data-tab'))));

          // Initialize tab from query param `tab` if present
          const params = new URLSearchParams(window.location.search);
          const initialTab = params.get('tab') || 'seat';
          setActiveTab(initialTab);

          // Reservation card selection (single-select)
          const reservationCards = document.querySelectorAll('.reservation-card');
          reservationCards.forEach(card => {
            card.addEventListener('click', () => {
              reservationCards.forEach(c => c.classList.remove('ring-2','ring-accent','ring-offset-2'));
              reservationCards.forEach(c => c.classList.remove('bg-zinc-800'));
              card.classList.add('ring-2','ring-accent','ring-offset-2');
              // visually keep dark background when selected
              card.classList.add('bg-zinc-800');
            });
          });
        })();
      </script>
