<x-layouts.app.sidebar title="Booking Details">
    <flux:main>
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-xl font-semibold mb-4">Booking #{{ $booking->id }}</h1>

            <div>
                <p><strong>User:</strong> {{ optional($booking->user)->name }}</p>
                <p><strong>Flight:</strong> {{ optional($booking->flight)->flight_number }}</p>
                <p><strong>Date:</strong> {{ $booking->booking_date }}</p>
                <p><strong>Status:</strong> {{ $booking->status }}</p>
            </div>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
