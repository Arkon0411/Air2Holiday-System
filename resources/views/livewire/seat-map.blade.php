<div class="p-4">
  <div class="mb-3">
    <div class="text-sm text-zinc-400">Flight <strong>{{ $flight->flight_number }}</strong></div>
    <div class="text-xs text-zinc-500">Seats: {{ $seats_total }} • Available: {{ $seats_available }} • Taken: {{ $seats_taken }}</div>
  </div>

  @if($seatRows->isEmpty())
    <div class="text-sm text-zinc-500">No seat map available for this flight.</div>
  @else
    @php
      $rows = [];
      foreach ($seatRows as $s) {
        preg_match('/^(\d+)([A-Z])/', $s->seat_number, $m);
        if ($m) { $r = $m[1]; $rows[$r][] = $s->seat_number; }
      }
    @endphp

    <div class="grid grid-cols-6 gap-2 text-center text-xs text-zinc-300 mb-2">
      @foreach(['A','B','C','D','E','F'] as $col)
        <div>{{ $col }}</div>
      @endforeach
    </div>

    @foreach($rows as $rnum => $cols)
      <div class="mt-2 grid grid-cols-6 gap-2">
        @foreach(['A','B','C','D','E','F'] as $col)
          @php $seat = $rnum.$col; $isTaken = in_array($seat, $takenSeats); @endphp
          @if($isTaken)
            <div class="px-2 py-2 rounded text-sm text-white text-center bg-red-500">{{ $seat }}</div>
          @else
            <div class="px-2 py-2 rounded text-sm text-white text-center bg-zinc-800 cursor-pointer seat-available" data-seat="{{ $seat }}" data-flight-id="{{ $flight->id }}">{{ $seat }}</div>
          @endif
        @endforeach
      </div>
    @endforeach
  @endif
</div>

<script>
  // same client-side reservation flow (uses existing reserve endpoint)
  (function(){
    document.querySelectorAll('.seat-available').forEach(el => {
      el.addEventListener('click', async () => {
        const seat = el.getAttribute('data-seat');
        const flightId = el.getAttribute('data-flight-id');
        if (!confirm('Reserve ' + seat + '?')) return;
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrf = tokenMeta ? tokenMeta.getAttribute('content') : '';
        el.classList.add('opacity-60'); el.style.pointerEvents = 'none';
        try {
          const res = await fetch('/flights/' + encodeURIComponent(flightId) + '/reserve', {
            method: 'POST', credentials: 'same-origin',
            headers: { 'Content-Type':'application/json', 'Accept':'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify({ seat: seat })
          });
          const json = await res.json().catch(()=>({}));
          if (!res.ok || !json.success) { alert(json.message || 'Could not reserve seat'); el.classList.remove('opacity-60'); el.style.pointerEvents=''; return; }
          el.classList.remove('bg-zinc-800'); el.classList.add('bg-red-500'); el.textContent = json.seat || seat;
          alert(json.message || 'Seat reserved');
        } catch (err) { console.error(err); alert('Could not reserve seat'); el.classList.remove('opacity-60'); el.style.pointerEvents=''; }
      });
    });
  })();
</script>
