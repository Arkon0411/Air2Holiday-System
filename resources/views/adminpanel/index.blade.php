<x-layouts.app.header title="Admin Panel">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4">Admin Panel</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('adminpanel.airports.index') }}" class="card p-4 bg-zinc-100 rounded">Airports</a>
            <a href="{{ route('adminpanel.users.index') }}" class="card p-4 bg-zinc-100 rounded">Users & Airlines</a>
            <a href="{{ route('adminpanel.bookings.index') }}" class="card p-4 bg-zinc-100 rounded">Bookings</a>
        </div>
    </div>
</x-layouts.app.header>
