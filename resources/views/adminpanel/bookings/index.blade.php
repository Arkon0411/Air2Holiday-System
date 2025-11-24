<x-layouts.app.sidebar title="Bookings">
    <flux:main>
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-xl font-semibold mb-4">Bookings</h1>

            <table class="w-full">
                <thead>
                    <tr>
                        <th>Booking Date</th>
                        <th>User</th>
                        <th>Flight</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $b)
                        <tr>
                            <td>{{ $b->booking_date }}</td>
                            <td>{{ optional($b->user)->name }}</td>
                            <td>{{ optional($b->flight)->flight_number }}</td>
                            <td>{{ $b->status }}</td>
                            <td>
                                <a href="{{ route('adminpanel.bookings.show', $b) }}">Show</a>
                                <form action="{{ route('adminpanel.bookings.destroy', $b) }}" method="POST" style="display:inline">
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
