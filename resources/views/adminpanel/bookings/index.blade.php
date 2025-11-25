<x-layouts.app.sidebar title="Bookings">
    <flux:main>
    <div id="admin-bookings" class="max-w-7xl mx-auto" x-data="bookingsManager()" data-initial-bookings="{{ base64_encode(json_encode($bookings)) }}">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50">Bookings</h1>
            </div>

            <!-- Search Bar -->
            <div class="w-full">
                <input 
                    type="text" 
                    x-model="searchQuery"
                    @input="filterBookings()"
                    placeholder="Search by booking date, user, or flight..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-xs font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Booking Date</th>
                        <th scope="col" class="px-4 py-3 hidden sm:table-cell">User</th>
                        <th scope="col" class="px-4 py-3 hidden md:table-cell">Flight</th>
                        <th scope="col" class="px-4 py-3 hidden lg:table-cell">Status</th>
                        <th scope="col" class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <template x-for="booking in filteredBookings" :key="booking.id">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">
                                <div class="font-semibold text-gray-900 dark:text-gray-50" x-text="formatDate(booking.booking_date)"></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 sm:hidden" x-text="booking.user?.name"></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 md:hidden" x-text="booking.flight?.flight_number"></div>
                            </td>
                            <td class="px-4 py-3 hidden sm:table-cell text-gray-700 dark:text-gray-300" x-text="booking.user?.name || '-'"></td>
                            <td class="px-4 py-3 hidden md:table-cell text-gray-700 dark:text-gray-300" x-text="booking.flight?.flight_number || '-'"></td>
                            <td class="px-4 py-3 hidden lg:table-cell">
                                <span :class="getStatusBadgeClass(booking.status)" class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold">
                                    <span x-text="capitalize(booking.status)"></span>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end gap-2 flex-wrap">
                                    <a 
                                        :href="'/adminpanel/bookings/' + booking.id"
                                        class="inline-flex items-center justify-center rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800 dark:focus:ring-offset-gray-900">
                                        View
                                    </a>
                                    <form @submit.prevent="deleteBooking(booking.id)" class="inline">
                                        <button 
                                            type="submit"
                                            class="inline-flex items-center justify-center rounded-md bg-red-50 px-3 py-1 text-xs font-semibold text-red-600 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-900 dark:text-red-200 dark:hover:bg-red-800 dark:focus:ring-offset-gray-900">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <div x-show="filteredBookings.length === 0" class="p-8 text-center text-gray-500 dark:text-gray-400">
                <p>No bookings found</p>
            </div>
        </div>
    </div>

    <script>
        function bookingsManager() {
            return {
                searchQuery: '',
                allBookings: JSON.parse(atob(document.getElementById('admin-bookings').dataset.initialBookings || 'W10=')),
                filteredBookings: JSON.parse(atob(document.getElementById('admin-bookings').dataset.initialBookings || 'W10=')),

                capitalize(str) {
                    return str.charAt(0).toUpperCase() + str.slice(1);
                },

                getStatusBadgeClass(status) {
                    const classes = {
                        confirmed: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                        pending: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                        cancelled: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                    };
                    return classes[status] || classes.pending;
                },

                formatDate(dateString) {
                    return new Date(dateString).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });
                },

                filterBookings() {
                    const query = this.searchQuery.toLowerCase();
                    this.filteredBookings = this.allBookings.filter(booking =>
                        (booking.booking_date && booking.booking_date.toLowerCase().includes(query)) ||
                        (booking.user && booking.user.name && booking.user.name.toLowerCase().includes(query)) ||
                        (booking.flight && booking.flight.flight_number && booking.flight.flight_number.toLowerCase().includes(query)) ||
                        (booking.status && booking.status.toLowerCase().includes(query))
                    );
                },

                async deleteBooking(bookingId) {
                    if (!confirm('Are you sure you want to delete this booking?')) return;

                    try {
                        const response = await fetch(`/adminpanel/bookings/${bookingId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        if (response.ok) {
                            this.allBookings = this.allBookings.filter(b => b.id !== bookingId);
                            this.filterBookings();
                            alert('Booking deleted successfully!');
                        } else {
                            alert('Error deleting booking');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error deleting booking');
                    }
                }
            };
        }
    </script>
    </flux:main>
</x-layouts.app.sidebar>
