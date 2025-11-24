<x-layouts.app.header>
  <div class="container mx-auto p-6">
    <flux:heading>Select Seat — {{ $flight->flight_number }}</flux:heading>

    <div class="mt-6">
      <div class="grid grid-cols-6 gap-2">
        @foreach($seats as $seat)
          @php $isTaken = in_array($seat->seat_number, $taken); @endphp
          <div class="p-2 border rounded text-center {{ $isTaken ? 'bg-red-100 text-red-700' : 'bg-green-50' }}">
            <div class="font-semibold">{{ $seat->seat_number }}</div>
            <div class="text-xs">{{ $seat->seat_class }}</div>
            @if(! $isTaken)
              <button type="button" class="mt-2 px-2 py-1 bg-accent text-white rounded text-xs select-seat" data-seat="{{ $seat->seat_number }}">Book</button>
            @else
              <div class="text-xs mt-2">Taken</div>
            @endif
          </div>
        @endforeach
      </div>

      <div class="mt-6 bg-white p-4 rounded shadow" id="booking-form" style="display:none;">
        <flux:heading size="sm">Passenger Details & Confirm</flux:heading>
        <form method="POST" action="{{ route('bookings.create', ['flight' => $flight->id]) }}">
          @csrf
          <input type="hidden" name="seat" id="selected-seat">

          <div class="mb-4">
            <label class="text-sm">Number of passengers</label>
            <select id="p-count" class="block mt-1 rounded border p-2">
              @for($i=1;$i<=6;$i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>

          <div id="passenger-rows">
            <div class="passenger-row mb-3">
              <input type="text" name="passengers[0][first_name]" placeholder="First name" class="border p-2 rounded w-1/2" required>
              <input type="text" name="passengers[0][last_name]" placeholder="Last name" class="border p-2 rounded w-1/2" required>
            </div>
          </div>

          <div class="mt-4">
            <button class="px-4 py-2 bg-accent text-white rounded">Confirm & Continue</button>
          </div>
        </form>
      </div>

      <script>
        (function(){
          const bookingForm = document.getElementById('booking-form');
          const selectedSeatInput = document.getElementById('selected-seat');
          const pCount = document.getElementById('p-count');
          const passengerRows = document.getElementById('passenger-rows');

          document.querySelectorAll('.select-seat').forEach(btn => {
            btn.addEventListener('click', function(){
              const seat = this.dataset.seat;
              selectedSeatInput.value = seat;
              bookingForm.style.display = 'block';
              window.scrollTo({ top: bookingForm.offsetTop - 20, behavior: 'smooth' });
            });
          });

          function renderRows(count){
            passengerRows.innerHTML = '';
            for(let i=0;i<count;i++){
              const div = document.createElement('div');
              div.className = 'passenger-row mb-3';
              div.innerHTML = `<input type="text" name="passengers[${i}][first_name]" placeholder="First name" class="border p-2 rounded w-1/2" required>
                               <input type="text" name="passengers[${i}][last_name]" placeholder="Last name" class="border p-2 rounded w-1/2" required>`;
              passengerRows.appendChild(div);
            }
          }

          pCount.addEventListener('change', function(){ renderRows(parseInt(this.value,10)); });
          // initial render
          renderRows(parseInt(pCount.value,10));
        })();
      </script>
    </div>
  </div>
</x-layouts.app.header>
