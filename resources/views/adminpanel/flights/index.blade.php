<x-layouts.app.sidebar title="Flights">
    <flux:main>
    <div id="admin-flights" class="max-w-7xl mx-auto" x-data="flightsManager()" data-initial-flights="{{ base64_encode(json_encode($flights)) }}" data-airlines="{{ base64_encode(json_encode(isset($airlines) ? $airlines : [])) }}" data-is-airline="{{ base64_encode(json_encode(auth()->user() && auth()->user()->usertype === 'airline')) }}">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-50">Flights</h2>
                <button 
                    @click="openCreateModal()" 
                    class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-offset-gray-900">
                    Create
                </button>
            </div>

            <!-- Search Bar -->
            <div class="w-full">
                <input 
                    type="text" 
                    x-model="searchQuery"
                    @input="filterFlights()"
                    placeholder="Search by flight number..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Flights Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-xs font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Flight #</th>
                        <th scope="col" class="px-4 py-3 hidden sm:table-cell">Departure</th>
                        <th scope="col" class="px-4 py-3 hidden md:table-cell">Arrival</th>
                        <th scope="col" class="px-4 py-3 hidden lg:table-cell">Price</th>
                        <th scope="col" class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <template x-for="flight in filteredFlights" :key="flight.id">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">
                                <div class="font-semibold text-gray-900 dark:text-gray-50" x-text="flight.flight_number"></div>
                            </td>
                            <td class="px-4 py-3 hidden sm:table-cell text-gray-700 dark:text-gray-300" x-text="flight.scheduled_departure || '-'"></td>
                            <td class="px-4 py-3 hidden md:table-cell text-gray-700 dark:text-gray-300" x-text="flight.scheduled_arrival || '-'"></td>
                            <td class="px-4 py-3 hidden lg:table-cell text-gray-700 dark:text-gray-300">
                                <span x-text="flight.base_price ? '$' + parseFloat(flight.base_price).toFixed(2) : '-'"></span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end gap-2 flex-wrap">
                                    <button 
                                        @click="openEditModal(flight.id)"
                                        class="inline-flex items-center justify-center rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800 dark:focus:ring-offset-gray-900">
                                        Edit
                                    </button>
                                    <form @submit.prevent="deleteFlight(flight.id)" class="inline">
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
            <div x-show="filteredFlights.length === 0" class="p-8 text-center text-gray-500 dark:text-gray-400">
                <p>No flights found</p>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <flux:modal name="createFlightModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create New Flight</flux:heading>
            </div>
            
            <form @submit.prevent="submitCreateForm" class="space-y-4">
                <flux:input label="Flight Number" x-model="createForm.flight_number" required />
                <template x-if="!isAirline">
                    <flux:select label="Airline" x-model.number="createForm.airline_id">
                        <option value="">-- select --</option>
                        <template x-for="airline in airlines" :key="airline.id">
                            <option :value="airline.id" x-text="airline.name"></option>
                        </template>
                    </flux:select>
                </template>
                <flux:input label="Base Price" type="number" x-model.number="createForm.base_price" step="0.01" />
                
                <div class="flex gap-3 justify-end pt-4">
                    <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'createFlightModal' })">Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Create Flight</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Edit Modal -->
    <flux:modal name="editFlightModal">
        <template x-if="editingFlightId">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Flight</flux:heading>
                </div>
                
                <form @submit.prevent="submitEditForm" class="space-y-4">
                    <flux:input label="Flight Number" x-model="editForm.flight_number" required />
                    <template x-if="!isAirline">
                        <flux:select label="Airline" x-model.number="editForm.airline_id">
                            <option value="">-- select --</option>
                            <template x-for="airline in airlines" :key="airline.id">
                                <option :value="airline.id" x-text="airline.name"></option>
                            </template>
                        </flux:select>
                    </template>
                    <flux:input label="Base Price" type="number" x-model.number="editForm.base_price" step="0.01" />
                    
                    <div class="flex gap-3 justify-end pt-4">
                        <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'editFlightModal' })">Cancel</flux:button>
                        <flux:button type="submit" variant="primary">Update Flight</flux:button>
                    </div>
                </form>
            </div>
        </template>
    </flux:modal>

    <script>
        function flightsManager() {
            return {
                editingFlightId: null,
                searchQuery: '',
                allFlights: JSON.parse(atob(document.getElementById('admin-flights').dataset.initialFlights || 'W10=')),
                filteredFlights: JSON.parse(atob(document.getElementById('admin-flights').dataset.initialFlights || 'W10=')),
                airlines: JSON.parse(atob(document.getElementById('admin-flights').dataset.airlines || 'W10=')),
                isAirline: JSON.parse(atob(document.getElementById('admin-flights').dataset.isAirline || 'ZmFsc2U=')),
                createForm: {
                    flight_number: '',
                    airline_id: null,
                    base_price: null,
                },
                editForm: {
                    flight_number: '',
                    airline_id: null,
                    base_price: null,
                },

                filterFlights() {
                    const query = this.searchQuery.toLowerCase();
                    this.filteredFlights = this.allFlights.filter(flight =>
                        flight.flight_number.toLowerCase().includes(query)
                    );
                },

                openCreateModal() {
                    this.createForm = { flight_number: '', airline_id: null, base_price: null };
                    this.$dispatch('open-modal', { name: 'createFlightModal' });
                },

                closeCreateModal() {
                    this.createForm = { flight_number: '', airline_id: null, base_price: null };
                    this.$dispatch('close-modal', { name: 'createFlightModal' });
                },

                openEditModal(flightId) {
                    const flight = this.allFlights.find(f => f.id === flightId);
                    if (flight) {
                        this.editingFlightId = flightId;
                        this.editForm = {
                            flight_number: flight.flight_number,
                            airline_id: flight.airline_id,
                            base_price: flight.base_price,
                        };
                        this.$dispatch('open-modal', { name: 'editFlightModal' });
                    }
                },

                closeEditModal() {
                    this.editingFlightId = null;
                    this.editForm = { flight_number: '', airline_id: null, base_price: null };
                    this.$dispatch('close-modal', { name: 'editFlightModal' });
                },

                async submitCreateForm() {
                    try {
                        const response = await fetch('{{ route("adminpanel.flights.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.createForm)
                        });

                        if (response.ok) {
                            const newFlight = await response.json();
                            this.allFlights.push(newFlight);
                            this.filterFlights();
                            this.closeCreateModal();
                            alert('Flight created successfully!');
                        } else {
                            alert('Error creating flight');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error creating flight');
                    }
                },

                async submitEditForm() {
                    try {
                        const response = await fetch(`/adminpanel/flights/${this.editingFlightId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.editForm)
                        });

                        if (response.ok) {
                            const updatedFlight = await response.json();
                            const index = this.allFlights.findIndex(f => f.id === this.editingFlightId);
                            if (index !== -1) {
                                this.allFlights[index] = updatedFlight;
                            }
                            this.filterFlights();
                            this.closeEditModal();
                            alert('Flight updated successfully!');
                        } else {
                            alert('Error updating flight');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error updating flight');
                    }
                },

                async deleteFlight(flightId) {
                    if (!confirm('Are you sure you want to delete this flight?')) return;

                    try {
                        const response = await fetch(`/adminpanel/flights/${flightId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        if (response.ok) {
                            this.allFlights = this.allFlights.filter(f => f.id !== flightId);
                            this.filterFlights();
                            alert('Flight deleted successfully!');
                        } else {
                            alert('Error deleting flight');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error deleting flight');
                    }
                }
            };
        }
    </script>
    </flux:main>
</x-layouts.app.sidebar>
