<x-layouts.app.header title="Create Airport">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-semibold mb-4">Create Airport</h1>

        <form action="{{ route('adminpanel.airports.store') }}" method="POST">
            @csrf
            <div>
                <label>Name</label>
                <input name="name" />
            </div>
            <div>
                <label>IATA</label>
                <input name="iata_code" />
            </div>
            <div>
                <label>Location</label>
                <input name="location" />
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</x-layouts.app.header>
