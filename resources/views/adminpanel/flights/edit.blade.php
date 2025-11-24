<x-layouts.app.sidebar title="Edit Flight">
    <flux:main>
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-xl font-semibold mb-4">Edit Flight</h1>

            <form action="{{ route('adminpanel.flights.update', $flight) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label>Flight Number</label>
                    <input name="flight_number" value="{{ $flight->flight_number }}" />
                </div>
                <div>
                    <label>Airline (admins only)</label>
                    <select name="airline_id">
                        <option value="">-- select --</option>
                        @foreach($airlines as $a)
                            <option value="{{ $a->id }}" {{ $flight->airline_id == $a->id ? 'selected' : '' }}>{{ $a->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Base Price</label>
                    <input name="base_price" value="{{ $flight->base_price }}" />
                </div>
                <button type="submit">Update</button>
            </form>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
