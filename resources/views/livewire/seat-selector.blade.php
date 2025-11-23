<div>
    @php
        // ensure variables exist when the view is rendered outside Livewire context
        $booking = $booking ?? null;
        $selectedSeat = $selectedSeat ?? null;
        $cols = ['A','B','C','D','E','F'];
    @endphp

    <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-4 rounded-t-lg">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs opacity-80">Philippine Airlines</div>
                <div class="text-lg font-semibold">{{ data_get($booking, 'flight.departure_airport_id', 'MNL') }} to {{ data_get($booking, 'flight.arrival_airport_id', 'NRT') }}</div>
                <div class="text-xs mt-1">{{ data_get($booking, 'flight.flight_number', 'PR 428') }}</div>
            </div>
            <div>
                <flux:badge color="zinc" size="sm">{{ ucfirst(data_get($booking, 'status', 'Confirmed')) }}</flux:badge>
            </div>
        </div>
    </div>

    <div class="bg-zinc-900 text-white p-6 rounded-b-lg">
        <div class="seat-grid p-6 rounded-lg">
            <div class="grid gap-3 grid-cols-6 justify-center items-center">
                @foreach($cols as $col)
                    <div class="text-xs text-zinc-400 text-center">{{ $col }}</div>
                @endforeach
            </div>

            @for($row=1;$row<=6;$row++)
                <div class="mt-3 grid grid-cols-6 gap-3">
                    @foreach($cols as $col)
                        @php $seat = $row.$col; $taken = false; @endphp
                        <button type="button"
                            wire:click.prevent="selectSeat('{{ $seat }}')"
                            class="size-8 rounded-md text-white shadow-xs"
                            :class="{
                                'bg-red-500 cursor-not-allowed': false,
                                'bg-green-500': '{{ $selectedSeat ?? '' }}' === '{{ $seat }}',
                                'bg-zinc-800': '{{ $selectedSeat ?? '' }}' !== '{{ $seat }}'
                            }"
                        >
                            <div class="text-sm">{{ $col }}</div>
                            <div class="text-[10px] opacity-70">{{ $row }}</div>
                        </button>
                    @endforeach
                </div>
            @endfor

            <div class="flex items-center gap-4 mt-4">
                <div class="flex items-center gap-2"><span class="inline-block w-3 h-3 bg-zinc-800 rounded-sm border"></span><span class="text-xs text-zinc-300">Available</span></div>
                <div class="flex items-center gap-2"><span class="inline-block w-3 h-3 bg-green-500 rounded-sm"></span><span class="text-xs text-zinc-300">Your Selection</span></div>
                <div class="flex items-center gap-2"><span class="inline-block w-3 h-3 bg-red-500 rounded-sm"></span><span class="text-xs text-zinc-300">Taken</span></div>
            </div>

            <div class="mt-6">
                <flux:button wire:click.prevent="confirm" variant="filled" color="cyan">Confirm Seat</flux:button>
            </div>
        </div>
    </div>
</div>
