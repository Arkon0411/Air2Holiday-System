  <x-layouts.app.header>
      <div class="container mx-auto px-4 py-6">
        <div class="welcome mb-4">
        </div>

        <h2 class="section-title">Choose your destination</h2>

        @php
          $flights = \App\Models\Flight::with(['arrivalAirport','departureAirport'])->get();
          $destinations = $flights->unique('arrival_airport_id')->take(6);
        @endphp

        <div class="destinations grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
          @forelse($destinations as $flight)
            @php
              $seats_total = \Illuminate\Support\Facades\DB::table('seats')->where('flight_id', $flight->id)->count();
              $seats_taken = \Illuminate\Support\Facades\DB::table('bookings')->where('flight_id', $flight->id)->whereNotNull('seat_number')->count();
              $seats_available = max(0, $seats_total - $seats_taken);
              // load seat map for inline template
              $seatRows = \Illuminate\Support\Facades\DB::table('seats')->where('flight_id', $flight->id)->orderBy('seat_number')->get();
              $takenSeats = \Illuminate\Support\Facades\DB::table('bookings')->where('flight_id', $flight->id)->whereNotNull('seat_number')->pluck('seat_number')->all();
            @endphp

            <div class="card rounded-lg overflow-hidden shadow-sm bg-zinc-100 dark:bg-zinc-700 hover:shadow-md transition-shadow duration-300 cursor-pointer flight-card" data-flight-id="{{ $flight->id }}">
              <img src="{{ asset($flight->image ?: 'img/loginsplash.jpeg') }}" alt="{{ optional($flight->arrivalAirport)->location ?? 'Destination' }}" class="w-full h-40 object-cover">
              <div class="card-info p-3">
                <h3 class="text-lg font-medium">{{ optional($flight->arrivalAirport)->location ?? 'Unknown' }}</h3>
                <p class="text-sm text-zinc-accent">Starting at <strong class="text-accent">₱ {{ number_format($flight->base_price,2) }}</strong></p>
                <div class="mt-2 text-xs text-zinc-600 dark:text-zinc-300">
                  <span class="inline-block mr-3">Available: <strong class="text-green-500">{{ $seats_available }}</strong></span>
                  <span class="inline-block">Taken: <strong class="text-red-500">{{ $seats_taken }}</strong></span>
                </div>
              </div>
            </div>

            {{-- Seat template will be fetched on-demand via AJAX when card is clicked --}}

          @empty
            <div>No destinations available yet.</div>
          @endforelse
        </div>
      </div>
    </x-layouts.app.header>

    <!-- Seat modal -->
    <div id="seatModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white dark:bg-zinc-800 rounded-lg w-11/12 md:w-3/4 lg:w-1/2 overflow-hidden">
        <div class="p-4 border-b border-zinc-100 dark:border-zinc-700 flex items-center justify-between">
          <div id="seatModalTitle" class="font-semibold">Seat map</div>
          <button id="seatModalClose" class="px-3 py-1 rounded bg-zinc-200 dark:bg-zinc-700">Close</button>
        </div>
        <div id="seatModalBody" class="p-4 overflow-auto max-h-[60vh]"></div>
      </div>
    </div>

    <script>
      (function(){
        const modal = document.getElementById('seatModal');
        const modalBody = document.getElementById('seatModalBody');
        const modalTitle = document.getElementById('seatModalTitle');
        const closeBtn = document.getElementById('seatModalClose');

        function showModal(content, title) {
          modalBody.innerHTML = '';
          modalBody.appendChild(content);
          modalTitle.textContent = title || 'Seat map';
          modal.classList.remove('hidden');
          modal.classList.add('flex');
          // attach click handlers for available seats inside the modal
          modalBody.querySelectorAll('.seat-available').forEach(el => {
            el.addEventListener('click', async () => {
              const flightId = el.getAttribute('data-flight-id');
              const seat = el.getAttribute('data-seat');
              const bookingId = el.getAttribute('data-booking-id') || null;
              if (! seat || ! flightId) return;
              // quick confirm
              if (! confirm('Reserve seat ' + seat + ' now?')) return;

              // get CSRF token
              const tokenMeta = document.querySelector('meta[name="csrf-token"]');
              const csrf = tokenMeta ? tokenMeta.getAttribute('content') : '';

              // show loading state
              el.classList.add('opacity-60');
              el.style.pointerEvents = 'none';

              try {
                const res = await fetch('/flights/' + encodeURIComponent(flightId) + '/reserve', {
                  method: 'POST',
                  credentials: 'same-origin',
                  headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                  },
                  body: JSON.stringify({ seat: seat, booking_id: bookingId })
                });

                const json = await res.json().catch(() => ({}));
                if (! res.ok || ! json.success) {
                  alert(json.message || 'Could not reserve seat.');
                  el.classList.remove('opacity-60');
                  el.style.pointerEvents = '';
                  return;
                }

                // update seat UI to taken
                el.classList.remove('bg-zinc-800','seat-available');
                el.classList.add('bg-red-500');
                el.textContent = json.seat || seat;
                el.removeAttribute('data-seat');
                el.removeAttribute('data-booking-id');
                el.removeAttribute('data-flight-id');

                // update counts on the card if present
                const card = document.querySelector('.flight-card[data-flight-id="' + flightId + '"]');
                if (card) {
                  const availEl = card.querySelector('.text-green-500');
                  const takenEl = card.querySelector('.text-red-500');
                  if (availEl && takenEl) {
                    const available = parseInt(availEl.textContent) || 0;
                    const taken = parseInt(takenEl.textContent) || 0;
                    availEl.textContent = Math.max(0, available - 1);
                    takenEl.textContent = taken + 1;
                  }
                }

                // small success feedback
                alert(json.message || 'Seat reserved.');
              } catch (err) {
                console.error(err);
                alert('Could not reserve seat.');
                el.classList.remove('opacity-60');
                el.style.pointerEvents = '';
              }
            });
          });
        }

        function hideModal(){
          modal.classList.remove('flex');
          modal.classList.add('hidden');
        }

        closeBtn.addEventListener('click', hideModal);
        modal.addEventListener('click', (e) => { if (e.target === modal) hideModal(); });

        document.querySelectorAll('.flight-card').forEach(card => {
          card.addEventListener('click', async () => {
            const id = card.getAttribute('data-flight-id');
            if (!id) return;
            // fetch seat map HTML from server
            try {
              const res = await fetch('/flights/' + encodeURIComponent(id) + '/seats', { credentials: 'same-origin' });
              if (!res.ok) throw new Error('Failed to load seats');
              const html = await res.text();
              // create a container and parse HTML
              const container = document.createElement('div');
              container.innerHTML = html;
              showModal(container, 'Seat map');
            } catch (err) {
              console.error(err);
              alert('Could not load seat map.');
            }
          });
        });
      })();
    </script>
