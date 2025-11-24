<x-layouts.app.sidebar title="Flights">
    <flux:main>
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold">Flights</h1>
                <a href="{{ route('adminpanel.flights.create') }}" class="btn">Create</a>
            </div>

            <table class="w-full">
                <thead>
                    <tr>
                        <th>Flight #</th>
                        <th>Airline</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flights as $f)
                        <tr>
                            <td>{{ $f->flight_number }}</td>
                            <td>{{ optional($f->airline)->name ?? $f->airline_id }}</td>
                            <td>{{ optional($f->departureAirport)->iata_code }}</td>
                            <td>{{ optional($f->arrivalAirport)->iata_code }}</td>
                            <td>
                                <a href="{{ route('adminpanel.flights.edit', $f) }}">Edit</a>
                                <form action="{{ route('adminpanel.flights.destroy', $f) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
