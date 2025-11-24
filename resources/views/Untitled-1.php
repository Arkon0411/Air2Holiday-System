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