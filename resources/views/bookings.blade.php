<x-layouts.app.header>
        <div class="container mx-auto px-4 py-6">

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

        <div class="mt-4 bg-white bg-zinc-100 dark:bg-zinc-600 rounded-lg shadow-sm overflow-hidden">
          <div class="p-4">
            @if(session('success'))
              <div class="mb-3 p-2 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
            @endif
            @if(session('error'))
              <div class="mb-3 p-2 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
            @endif
            <div class="mt-4">
              <div class="flex gap-2" role="tablist">
                <flux:button data-tab="seat">Seat Selection</flux:button>
                <flux:button data-tab="reservations">Reservations</flux:button>
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

              

                      <div class="p-4 bg-zinc-900 text-white rounded-md">
                        <div class="seat-grid">
                          <div class="mb-3 p-3 bg-blue-700 text-white rounded-md">
                        <div class="text-xs">Philippine Airlines</div>
                        <div class="text-lg font-semibold">{{ optional($flight)->departure_airport_id ?? 'MNL' }} to {{ optional($flight)->arrival_airport_id ?? 'NRT' }}</div>
                        <div class="text-xs">{{ optional($flight)->flight_number ?? 'PR 428' }}</div>
                      </div>
                          @php $cols = ['A','B','C','D','E','F']; @endphp
          

                          {{-- Business Class Section (Rows 1-2) --}}
                          <div class="mb-6">
                            <div class="text-xs text-zinc-400 mb-2 text-center">Business Class</div>
                            @for($row=1;$row<=2;$row++)
                              <div class="flex items-center justify-center gap-2 mb-2">
                                {{-- Left side seats (A,B,C) --}}
                                <div class="flex gap-1">
                                  @foreach(['A','B','C'] as $col)
                                    @php $seat = $row.$col; @endphp
                                    <button type="button" class="seat-btn bg-zinc-800 w-8 h-8 rounded text-xs hover:bg-zinc-700 hover:scale-105 transform transition duration-150 ease-in-out flex items-center justify-center" data-seat="{{ $seat }}">{{ $seat }}</button>
                                  @endforeach
                                </div>
                                
                                {{-- Aisle gap --}}
                                <div class="w-4"></div>
                                
                                {{-- Right side seats (D,E,F) --}}
                                <div class="flex gap-1">
                                  @foreach(['D','E','F'] as $col)
                                    @php $seat = $row.$col; @endphp
                                    <button type="button" class="seat-btn bg-zinc-800 w-8 h-8 rounded text-xs hover:bg-zinc-700 hover:scale-105 transform transition duration-150 ease-in-out flex items-center justify-center" data-seat="{{ $seat }}">{{ $seat }}</button>
                                  @endforeach
                                </div>
                              </div>
                            @endfor
                          </div>

                          {{-- Separator between Business and Economy --}}

                          {{-- Economy Class Section (Rows 3-6) --}}
                          <div>
                            <div class="text-xs text-zinc-400 mb-2 text-center">Economy Class</div>
                            @for($row=3;$row<=6;$row++)
                              <div class="flex items-center justify-center gap-2 mb-2">
                                {{-- Left side seats (A,B,C) --}}
                                <div class="flex gap-1">
                                  @foreach(['A','B','C'] as $col)
                                    @php $seat = $row.$col; @endphp
                                    <button type="button" class="seat-btn bg-zinc-800 w-8 h-8 rounded text-xs hover:bg-zinc-700 hover:scale-105 transform transition duration-150 ease-in-out flex items-center justify-center" data-seat="{{ $seat }}">{{ $seat }}</button>
                                  @endforeach
                                </div>
                                
                                {{-- Aisle gap --}}
                                <div class="w-4"></div>
                                
                                {{-- Right side seats (D,E,F) --}}
                                <div class="flex gap-1">
                                  @foreach(['D','E','F'] as $col)
                                    @php $seat = $row.$col; @endphp
                                    <button type="button" class="seat-btn bg-zinc-800 w-8 h-8 rounded text-xs hover:bg-zinc-700 hover:scale-105 transform transition duration-150 ease-in-out flex items-center justify-center" data-seat="{{ $seat }}">{{ $seat }}</button>
                                  @endforeach
                                </div>
                              </div>
                            @endfor
                          </div>

                          <div class="flex items-center justify-center gap-6 mt-6">
                            <div class="flex items-center gap-2">
                              <span class="inline-block w-4 h-4 bg-zinc-800 rounded-sm border border-zinc-600"></span>
                              <span class="text-xs text-zinc-300">Available</span>
                            </div>
                            <div class="flex items-center gap-2">
                              <span class="inline-block w-4 h-4 bg-green-500 rounded-sm"></span>
                              <span class="text-xs text-zinc-300">Selected</span>
                            </div>
                            <div class="flex items-center gap-2">
                              <span class="inline-block w-4 h-4 bg-zinc-600 rounded-sm"></span>
                              <span class="text-xs text-zinc-300">Occupied</span>
                            </div>
                          </div>

                          <div class="mt-6 text-center">
                            <button type="submit" class="inline-flex items-center px-4 py-2 rounded bg-accent text-white font-medium">Confirm Seat Selection</button>
                            <span id="seatChosen" class="ml-4 text-sm text-zinc-300">{{ $first->seat_number ? 'Selected: ' . $first->seat_number : 'No seat selected' }}</span>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              @endif
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