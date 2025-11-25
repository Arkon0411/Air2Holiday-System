<x-layouts.app.sidebar title="Bookings">
    <flux:main x-data="bookingManager()">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50 text-center sm:text-left w-full sm:w-auto">Bookings</h1>
            </div>

            <!-- Search Bar -->
            <div class="w-full" x-data="{ searchQuery: '' }">
                <input 
                    type="text" 
                    x-model="searchQuery"
                    @input="document.querySelectorAll('tbody tr').forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchQuery.toLowerCase()) ? '' : 'none';
                    })"
                    placeholder="Search by user, flight, seat number, or status..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-100 text-sm font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                        <th class="px-4 py-3 sm:px-6 sm:py-4">User</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden lg:table-cell">Airline</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden md:table-cell">Flight</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden xl:table-cell">Seat</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden sm:table-cell">Departure</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4">Status</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($bookings as $b)
                        <tr class="bg-zinc-50 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-900 dark:text-gray-50">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ optional($b->user)->name ?? 'N/A' }}</span>
                                    <span class="text-xs text-gray-500">ID: {{ $b->user_id ?? 'N/A' }}</span>
                                    <div class="flex flex-col lg:hidden mt-1 space-y-1">
                                        <span class="text-xs text-gray-500">{{ optional($b->flight->airline)->name ?? 'N/A' }}</span>
                                        <span class="text-xs text-gray-500">{{ optional($b->flight)->flight_number ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden lg:table-cell">
                                {{ optional($b->flight->airline)->name ?? 'N/A' }}
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden md:table-cell">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ optional($b->flight)->flight_number ?? 'N/A' }}</span>
                                    <span class="text-xs text-gray-500">ID: {{ $b->flight_id ?? 'N/A' }}</span>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden xl:table-cell">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $b->seat_number ?? 'N/A' }}
                                </span>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden sm:table-cell">
                                {{ optional($b->flight)->scheduled_departure ? \Carbon\Carbon::parse($b->flight->scheduled_departure)->format('M d, Y H:i') : 'N/A' }}
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $b->status === 'confirmed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : ($b->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <flux:modal.trigger name="viewBookingModal">
                                        <flux:button size="sm" @click="setViewingBooking({{ $b->id }})" icon="eye" />
                                    </flux:modal.trigger>
                                    <form action="{{ route('adminpanel.bookings.destroy', $b) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button size="sm" type="submit" variant="danger" icon="archive-box-x-mark" />
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- View Booking Modal -->
        <flux:modal name="viewBookingModal" class="max-w-2xl">
            <template x-if="viewingBookingId">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Booking Details</flux:heading>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Booking Information Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Booking ID</div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-50" x-text="viewingBooking.id"></div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Booking Date</div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-50" x-text="viewingBooking.booking_date"></div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">User</div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-50" x-text="viewingBooking.user_name"></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400" x-text="'ID: ' + viewingBooking.user_id"></div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Flight Number</div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-50" x-text="viewingBooking.flight_number"></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400" x-text="'ID: ' + viewingBooking.flight_id"></div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Airline</div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-50" x-text="viewingBooking.airline_name"></div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Seat Number</div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-50" x-text="viewingBooking.seat_number"></div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Class</div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-50" x-text="viewingBooking.class"></div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Departure</div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-50" x-text="viewingBooking.scheduled_departure"></div>
                            </div>
                        </div>
                        
                        <!-- Status Update Form -->
                        <form :action="`/adminpanel/bookings/${viewingBookingId}`" method="POST" class="space-y-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update Status</label>
                                <flux:select name="status" x-model="viewingBooking.status" required>
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="cancelled">Cancelled</option>
                                </flux:select>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                                <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'viewBookingModal' })" type="button" class="w-full sm:w-auto order-2 sm:order-1">Close</flux:button>
                                <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Update Status</flux:button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        </flux:modal>

        <script>
            function bookingManager() {
                return {
                    viewingBookingId: null,
                    viewingBooking: {
                        id: '',
                        booking_date: '',
                        status: '',
                        user_id: '',
                        user_name: '',
                        flight_id: '',
                        flight_number: '',
                        airline_name: '',
                        seat_number: '',
                        class: '',
                        scheduled_departure: ''
                    },
                    
                    async setViewingBooking(bookingId) {
                        this.viewingBookingId = bookingId;
                        try {
                            const response = await fetch(`/adminpanel/bookings/${bookingId}/edit`);
                            const bookingData = await response.json();
                            this.viewingBooking = bookingData;
                        } catch (error) {
                            console.error('Error fetching booking:', error);
                        }
                    }
                }
            }
        </script>
    </flux:main>
</x-layouts.app.sidebar>
