<x-layouts.app.sidebar title="Airports">
    <flux:main>
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold">Airports</h1>
                <a href="{{ route('adminpanel.airports.create') }}" class="btn">Create</a>
            </div>

            <table class="w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>IATA</th>
                        <th>Location</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($airports as $airport)
                        <tr>
                            <td>{{ $airport->name }}</td>
                            <td>{{ $airport->iata_code }}</td>
                            <td>{{ $airport->location }}</td>
                            <td>
                                <a href="{{ route('adminpanel.airports.edit', $airport) }}">Edit</a>
                                <form action="{{ route('adminpanel.airports.destroy', $airport) }}" method="POST" style="display:inline">
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
