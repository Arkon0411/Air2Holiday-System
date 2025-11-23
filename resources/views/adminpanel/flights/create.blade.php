<x-layouts.app.header title="Create Flight">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-semibold mb-4">Create Flight</h1>

        <form action="{{ route('adminpanel.flights.store') }}" method="POST">
            @csrf
            <div>
                <label>Flight Number</label>
                <input name="flight_number" />
            </div>
            <div>
                <label>Airline (admins only)</label>
                <select name="airline_id">
                    <option value="">-- select --</option>
                    @foreach($airlines as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Base Price</label>
                <input name="base_price" />
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</x-layouts.app.header>
