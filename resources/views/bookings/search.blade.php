<x-layouts.app.header>
  <div class="container mx-auto p-6">
    <flux:heading>Find Flights</flux:heading>

    <form action="{{ route('bookings.results') }}" method="GET" class="mt-6 space-y-4">
      <div class="grid grid-cols-3 gap-4">
        <div>
          <label class="text-sm">From</label>
          <select name="from" class="w-full rounded border p-2">
            @foreach($airports as $a)
              <option value="{{ $a->id }}">{{ $a->iata_code }} — {{ $a->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="text-sm">To</label>
          <select name="to" class="w-full rounded border p-2">
            @foreach($airports as $a)
              <option value="{{ $a->id }}">{{ $a->iata_code }} — {{ $a->name }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="text-sm">Date</label>
          <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full rounded border p-2">
        </div>
      </div>

      <div>
        <button class="px-4 py-2 bg-accent text-white rounded">Search</button>
      </div>
    </form>
  </div>
</x-layouts.app.header>
