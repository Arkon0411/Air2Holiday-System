<x-layouts.app.sidebar title="Airports">
    <flux:main>
    <div id="admin-airports" class="max-w-7xl mx-auto" x-data="airportsManager()" data-initial-airports="{{ base64_encode(json_encode($airports)) }}">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50">Airports</h1>
                <flux:modal.trigger name="createAirportModal">    
                    <flux:button variant="primary">Create</flux:button>
                </flux:modal.trigger>
            </div>

            <!-- Search Bar -->
            <div class="w-full">
                <input 
                    type="text" 
                    x-model="searchQuery"
                    @input="filterAirports()"
                    placeholder="Search by name, IATA code, or location..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Airports Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-xs font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Name</th>
                        <th scope="col" class="px-4 py-3 hidden sm:table-cell">IATA Code</th>
                        <th scope="col" class="px-4 py-3 hidden md:table-cell">Location</th>
                        <th scope="col" class="px-4 py-3 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <template x-for="airport in filteredAirports" :key="airport.id">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">
                                <div class="font-semibold text-gray-900 dark:text-gray-50" x-text="airport.name"></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 sm:hidden" x-text="airport.iata_code"></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 md:hidden" x-text="airport.location"></div>
                            </td>
                            <td class="px-4 py-3 hidden sm:table-cell">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200" x-text="airport.iata_code"></span>
                            </td>
                            <td class="px-4 py-3 hidden md:table-cell text-gray-700 dark:text-gray-300" x-text="airport.location || '-'"></td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end gap-2 flex-wrap">
                                    <flux:button @click="openEditModal(airport)">
                                        Edit
                                    </flux:button>
                                    <form @submit.prevent="deleteAirport(airport.id)" class="inline">
                                        <flux:button type="submit" variant="danger">
                                            Delete
                                        </flux:button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <div x-show="filteredAirports.length === 0" class="p-8 text-center text-gray-500 dark:text-gray-400">
                <p>No airports found</p>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <flux:modal name="createAirportModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create New Airport</flux:heading>
            </div>
            
            <form @submit.prevent="submitCreateForm" class="space-y-4">
                <flux:input label="Name" x-model="createForm.name" required />
                <flux:input label="IATA Code" x-model="createForm.iata_code" required />
                <flux:input label="Location" x-model="createForm.location" />
                
                <div class="flex gap-3 justify-end pt-4">
                    <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'createAirportModal' })">Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Create Airport</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Edit Modal -->
    <flux:modal name="editAirportModal">
        <template x-if="editingAirportId">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Airport</flux:heading>
                </div>
                
                <form @submit.prevent="submitEditForm" class="space-y-4">
                    <flux:input label="Name" x-model="editForm.name" required />
                    <flux:input label="IATA Code" x-model="editForm.iata_code" required />
                    <flux:input label="Location" x-model="editForm.location" />
                    
                    <div class="flex gap-3 justify-end pt-4">
                        <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'editAirportModal' })">Cancel</flux:button>
                        <flux:button type="submit" variant="primary">Update Airport</flux:button>
                    </div>
                </form>
            </div>
        </template>
    </flux:modal>

    <script>
        function airportsManager() {
            return {
                editingAirportId: null,
                searchQuery: '',
                allAirports: JSON.parse(atob(document.getElementById('admin-airports').dataset.initialAirports || 'W10=')),
                filteredAirports: JSON.parse(atob(document.getElementById('admin-airports').dataset.initialAirports || 'W10=')),
                createForm: { name: '', iata_code: '', location: '' },
                editForm: { name: '', iata_code: '', location: '' },

                filterAirports() {
                    const query = this.searchQuery.toLowerCase();
                    this.filteredAirports = this.allAirports.filter(airport =>
                        airport.name.toLowerCase().includes(query) ||
                        airport.iata_code.toLowerCase().includes(query) ||
                        (airport.location && airport.location.toLowerCase().includes(query))
                    );
                },

                openEditModal(airport) {
                    this.editingAirportId = airport.id;
                    this.editForm = { 
                        name: airport.name, 
                        iata_code: airport.iata_code,
                        location: airport.location 
                    };
                    this.$dispatch('open-modal', { name: 'editAirportModal' });
                },

                closeEditModal() {
                    this.editingAirportId = null;
                    this.editForm = { name: '', iata_code: '', location: '' };
                    this.$dispatch('close-modal', { name: 'editAirportModal' });
                },

                closeCreateModal() {
                    this.createForm = { name: '', iata_code: '', location: '' };
                    this.$dispatch('close-modal', { name: 'createAirportModal' });
                },

                async submitCreateForm() {
                    try {
                        const response = await fetch('{{ route("adminpanel.airports.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.createForm)
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.allAirports.push(data.airport);
                            this.filterAirports();
                            this.closeCreateModal();
                            alert('Airport created successfully!');
                        } else {
                            alert('Error: ' + (data.message || 'Failed to create airport'));
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error creating airport');
                    }
                },

                async submitEditForm() {
                    try {
                        const response = await fetch(`/adminpanel/airports/${this.editingAirportId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.editForm)
                        });

                        const data = await response.json();

                        if (data.success) {
                            const index = this.allAirports.findIndex(a => a.id === this.editingAirportId);
                            if (index !== -1) {
                                this.allAirports[index] = data.airport;
                            }
                            this.filterAirports();
                            this.closeEditModal();
                            alert('Airport updated successfully!');
                        } else {
                            alert('Error: ' + (data.message || 'Failed to update airport'));
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error updating airport');
                    }
                },

                async deleteAirport(airportId) {
                    if (!confirm('Are you sure you want to delete this airport?')) return;

                    try {
                        const response = await fetch(`/adminpanel/airports/${airportId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.allAirports = this.allAirports.filter(a => a.id !== airportId);
                            this.filterAirports();
                            alert('Airport deleted successfully!');
                        } else {
                            alert('Error: ' + (data.message || 'Failed to delete airport'));
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error deleting airport');
                    }
                }
            };
        }
    </script>
    </flux:main>
</x-layouts.app.sidebar>
