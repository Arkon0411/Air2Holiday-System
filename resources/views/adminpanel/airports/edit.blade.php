<x-layouts.app.sidebar title="Edit Airport">
    <flux:main>
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-xl font-semibold mb-4">Edit Airport</h1>

            <form action="{{ route('adminpanel.airports.update', $airport) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label>Name</label>
                    <input name="name" value="{{ $airport->name }}" />
                </div>
                <div>
                    <label>IATA</label>
                    <input name="iata_code" value="{{ $airport->iata_code }}" />
                </div>
                <div>
                    <label>Location</label>
                    <input name="location" value="{{ $airport->location }}" />
                </div>
                <button type="submit">Update</button>
            </form>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
