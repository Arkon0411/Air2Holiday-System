<x-layouts.app.header>
        <div class="container mx-auto px-4 py-6">
          <h1 class="text-3xl font-bold mb-6 text-zinc-900 dark:text-white">My Bookings</h1>

          @php
          $userId = auth()->id() ?? 0;
          $bookings = \App\Models\Booking::with(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline'])->where('user_id', $userId)->orderBy('created_at', 'desc')->get();

          @endphp

          @if(session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">{{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="mb-4 p-4 rounded bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">{{ session('error') }}</div>
          @endif

          @if($bookings->isEmpty())
            <div class="text-center py-12 bg-white dark:bg-zinc-700 rounded-lg shadow-md">
              <svg class="mx-auto h-16 w-16 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <h3 class="mt-4 text-lg font-medium text-zinc-900 dark:text-white">No bookings yet</h3>
              <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Book your first flight to see it here.</p>
              <a href="{{ route('flights') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                Browse Flights
              </a>
            </div>
          @else
            {{-- Bookings List --}}
            <div class="space-y-6">
              @foreach($bookings as $booking)
                @php
                  $flight = $booking->flight;
                  $statusColors = [
                    'confirmed' => 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200',
                    'pending' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200',
                    'cancelled' => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200'
                  ];
                  $statusColor = $statusColors[$booking->status] ?? 'bg-zinc-100 dark:bg-zinc-700 text-zinc-800 dark:text-zinc-200';
                @endphp

                <div class="bg-white dark:bg-zinc-700 rounded-lg shadow-md overflow-hidden">
                  <div class="p-6">
                    {{-- Booking Header --}}
                    <div class="flex justify-between items-start mb-4">
                      <div>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-1">
                          {{ optional($flight->departureAirport)->location ?? 'Unknown' }} 
                          <svg class="inline w-5 h-5 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                          </svg>
                          {{ optional($flight->arrivalAirport)->location ?? 'Unknown' }}
                        </h3>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400">
                          Flight {{ optional($flight)->flight_number }} • {{ optional($flight->airline)->name ?? 'Unknown Airline' }}
                        </p>
                      </div>
                      <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                        {{ ucfirst($booking->status) }}
                      </span>
                    </div>

                    {{-- Flight Details Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                      <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-1">Departure</p>
                        <p class="text-sm font-medium text-zinc-900 dark:text-white">
                          {{ optional($flight)->scheduled_departure ? $flight->scheduled_departure->format('M d, Y H:i') : 'TBA' }}
                        </p>
                        <p class="text-xs text-zinc-600 dark:text-zinc-400">
                          {{ optional($flight->departureAirport)->iata_code }} - {{ optional($flight->departureAirport)->name }}
                        </p>
                      </div>

                      <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-1">Arrival</p>
                        <p class="text-sm font-medium text-zinc-900 dark:text-white">
                          {{ optional($flight)->scheduled_arrival ? $flight->scheduled_arrival->format('M d, Y H:i') : 'TBA' }}
                        </p>
                        <p class="text-xs text-zinc-600 dark:text-zinc-400">
                          {{ optional($flight->arrivalAirport)->iata_code }} - {{ optional($flight->arrivalAirport)->name }}
                        </p>
                      </div>

                      <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-1">Booking Details</p>
                        <p class="text-sm font-medium text-zinc-900 dark:text-white">
                          Seat: {{ $booking->seat_number ?? 'Not assigned' }}
                        </p>
                        <p class="text-xs text-zinc-600 dark:text-zinc-400">
                          Class: {{ ucfirst($booking->class ?? 'economy') }}
                        </p>
                        <p class="text-xs text-zinc-600 dark:text-zinc-400">
                          Booked: {{ $booking->created_at->format('M d, Y') }}
                        </p>
                      </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-600">
                      @if($booking->status === 'confirmed' && !$booking->seat_number)
                        <button onclick="openSeatSelection({{ $booking->id }}, '{{ $flight->flight_number }}')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                          Select Seat
                        </button>
                      @endif

                      @if($booking->status === 'confirmed')
                        <button onclick="requestRefund({{ $booking->id }})" class="px-4 py-2 border-2 border-yellow-600 text-yellow-600 dark:text-yellow-400 rounded-lg hover:bg-yellow-50 dark:hover:bg-zinc-600 transition text-sm font-medium">
                          Request Refund
                        </button>
                      @endif

                      @if($booking->status === 'pending')
                        <span class="px-4 py-2 text-sm text-zinc-600 dark:text-zinc-400">
                          Refund pending approval
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>

        {{-- Seat Selection Modal --}}
        <div id="seatModal" class="hidden fixed inset-0 bg-black/50 z-50 overflow-y-auto">
          <div class="flex min-h-screen items-center justify-center p-4">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-xl max-w-2xl w-full" onclick="event.stopPropagation()">
              <div id="seatModalContent"></div>
            </div>
          </div>
        </div>

        <script>
          let currentBookingId = null;

          function openSeatSelection(bookingId, flightNumber) {
            currentBookingId = bookingId;
            const modal = document.getElementById('seatModal');
            const modalContent = document.getElementById('seatModalContent');
            
            modalContent.innerHTML = `
              <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                  <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Select Your Seat</h2>
                  <button onclick="closeSeatModal()" class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </div>

                <div class="bg-zinc-900 text-white rounded-lg p-6 mb-6">
                  <div class="mb-4 p-3 bg-blue-700 text-white rounded-md text-center">
                    <div class="text-sm">Flight ${flightNumber}</div>
                  </div>

                  <div class="max-w-md mx-auto">
                    <div class="mb-6">
                      <div class="text-xs text-zinc-400 mb-2 text-center">Business Class</div>
                      ${generateSeatsForModal(1, 2)}
                    </div>

                    <div>
                      <div class="text-xs text-zinc-400 mb-2 text-center">Economy Class</div>
                      ${generateSeatsForModal(3, 6)}
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
                      <span id="selectedSeatDisplayModal" class="text-zinc-300">No seat selected</span>
                    </div>
                  </div>
                </div>

                <div class="flex justify-end gap-3">
                  <button onclick="closeSeatModal()" class="px-4 py-2 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white">Cancel</button>
                  <button onclick="confirmSeatSelection()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Confirm Seat</button>
                </div>
              </div>
            `;
            
            modal.classList.remove('hidden');
            
            setTimeout(() => {
              document.querySelectorAll('.seat-btn-modal').forEach(btn => {
                btn.addEventListener('click', function() {
                  document.querySelectorAll('.seat-btn-modal').forEach(b => {
                    b.classList.remove('bg-green-500');
                    b.classList.add('bg-zinc-800');
                  });
                  this.classList.remove('bg-zinc-800');
                  this.classList.add('bg-green-500');
                  selectedSeat = this.dataset.seat;
                  document.getElementById('selectedSeatDisplayModal').textContent = 'Selected: ' + selectedSeat;
                });
              });
            }, 100);
          }

          function generateSeatsForModal(startRow, endRow) {
            let html = '';
            for (let row = startRow; row <= endRow; row++) {
              html += '<div class="flex items-center justify-center gap-2 mb-2">';
              html += '<div class="flex gap-1">';
              for (let col of ['A', 'B', 'C']) {
                const seat = row + col;
                html += `<button type="button" class="seat-btn-modal bg-zinc-800 w-8 h-8 rounded text-xs hover:bg-zinc-700 hover:scale-105 transform transition" data-seat="${seat}">${seat}</button>`;
              }
              html += '</div><div class="w-4"></div><div class="flex gap-1">';
              for (let col of ['D', 'E', 'F']) {
                const seat = row + col;
                html += `<button type="button" class="seat-btn-modal bg-zinc-800 w-8 h-8 rounded text-xs hover:bg-zinc-700 hover:scale-105 transform transition" data-seat="${seat}">${seat}</button>`;
              }
              html += '</div></div>';
            }
            return html;
          }

          function closeSeatModal() {
            document.getElementById('seatModal').classList.add('hidden');
            selectedSeat = null;
          }

          let selectedSeat = null;

          function confirmSeatSelection() {
            if (!selectedSeat) {
              alert('Please select a seat first!');
              return;
            }

            const confirmBtn = event.target;
            confirmBtn.disabled = true;
            confirmBtn.textContent = 'Processing...';

            fetch(`{{ url('bookings') }}/${currentBookingId}/seat`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({
                seat_number: selectedSeat
              })
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                alert('Seat selected successfully!');
                location.reload();
              } else {
                alert('Failed to select seat: ' + (data.message || 'Unknown error'));
                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Confirm Seat';
              }
            })
            .catch(error => {
              alert('An error occurred. Please try again.');
              console.error(error);
              confirmBtn.disabled = false;
              confirmBtn.textContent = 'Confirm Seat';
            });
          }

          function requestRefund(bookingId) {
            if (!confirm('Are you sure you want to request a refund for this booking? This action cannot be undone.')) {
              return;
            }

            fetch(`{{ url('bookings') }}/${bookingId}/refund`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                alert('Refund requested successfully! Your booking status has been changed to pending.');
                location.reload();
              } else {
                alert('Failed to request refund: ' + (data.message || 'Unknown error'));
              }
            })
            .catch(error => {
              alert('An error occurred. Please try again.');
              console.error(error);
            });
          }

          document.getElementById('seatModal').addEventListener('click', function(e) {
            if (e.target === this) {
              closeSeatModal();
            }
          });
        </script>
      </x-layouts.app.header>