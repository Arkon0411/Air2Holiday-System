<x-layouts.app.sidebar title="Airlines">
    <flux:main>
    <div id="admin-airlines" class="max-w-7xl mx-auto" x-data="airlinesManager()" data-initial-airlines="{{ base64_encode(json_encode($airlines)) }}">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50">Airlines</h1>
                <flux:modal.trigger name="createAirlineModal">    
                    <flux:button variant="primary">Create</flux:button>
                </flux:modal.trigger>
            </div>

            <!-- Search Bar -->
            <div class="w-full">
                <input 
                    type="text" 
                    x-model="searchQuery"
                    @input="filterAirlines()"
                    placeholder="Search by name or code..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Airlines Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-xs font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Name</th>
                        <th scope="col" class="px-4 py-3 hidden sm:table-cell">Code</th>
                        <th scope="col" class="px-4 py-3 hidden md:table-cell">User Email</th>
                        <th scope="col" class="px-4 py-3 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <template x-for="airline in filteredAirlines" :key="airline.id">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3">
                                <div class="font-semibold text-gray-900 dark:text-gray-50" x-text="airline.name"></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 sm:hidden" x-text="airline.code"></div>
                            </td>
                            <td class="px-4 py-3 hidden sm:table-cell">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200" x-text="airline.code"></span>
                            </td>
                            <td class="px-4 py-3 hidden md:table-cell text-gray-700 dark:text-gray-300" x-text="airline.user_email || '-'"></td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end gap-2 flex-wrap">
                                    <flux:button @click="openEditModal(airline)">
                                        Edit
                                    </flux:button>
                                    <form @submit.prevent="deleteAirline(airline.id)" class="inline">
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
            <div x-show="filteredAirlines.length === 0" class="p-8 text-center text-gray-500 dark:text-gray-400">
                <p>No airlines found</p>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <flux:modal name="createAirlineModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create New Airline</flux:heading>
            </div>
            
            <form @submit.prevent="submitCreateForm" class="space-y-4">
                <flux:input label="Name" x-model="createForm.name" required />
                <flux:input label="Code (2 letters)" x-model="createForm.code" maxlength="2" required />
                
                <div class="flex gap-3 justify-end pt-4">
                    <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'createAirlineModal' })">Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Create Airline</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Edit Modal -->
    <flux:modal name="editAirlineModal">
        <template x-if="editingAirlineId">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Airline</flux:heading>
                </div>
                
                <form @submit.prevent="submitEditForm" class="space-y-4">
                    <flux:input label="Name" x-model="editForm.name" required />
                    <flux:input label="Code (2 letters)" x-model="editForm.code" maxlength="2" required />
                    
                    <div class="flex gap-3 justify-end pt-4">
                        <flux:button variant="ghost" @click="closeEditModal()">Cancel</flux:button>
                        <flux:button type="submit" variant="primary">Update Airline</flux:button>
                    </div>
                </form>
            </div>
        </template>
    </flux:modal>

    <script>
        function airlinesManager() {
            return {
                editingAirlineId: null,
                searchQuery: '',
                allAirlines: JSON.parse(atob(document.getElementById('admin-airlines').dataset.initialAirlines || 'W10=')),
                filteredAirlines: JSON.parse(atob(document.getElementById('admin-airlines').dataset.initialAirlines || 'W10=')),
                createForm: { name: '', code: '' },
                editForm: { name: '', code: '' },

                filterAirlines() {
                    const query = this.searchQuery.toLowerCase();
                    this.filteredAirlines = this.allAirlines.filter(airline =>
                        airline.name.toLowerCase().includes(query) ||
                        airline.code.toLowerCase().includes(query)
                    );
                },

                openEditModal(airline) {
                    this.editingAirlineId = airline.id;
                    this.editForm = { 
                        name: airline.name, 
                        code: airline.code,
                        user_id: airline.user_id 
                    };
                    this.$dispatch('open-modal', { name: 'editAirlineModal' });
                },

                closeEditModal() {
                    this.editingAirlineId = null;
                    this.editForm = { name: '', code: '' };
                    this.$dispatch('close-modal', { name: 'editAirlineModal' });
                },

                closeCreateModal() {
                    this.createForm = { name: '', code: '' };
                    this.$dispatch('close-modal', { name: 'createAirlineModal' });
                },

                async submitCreateForm() {
                    try {
                        const response = await fetch('{{ route("adminpanel.airlines.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.createForm)
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.allAirlines.push(data.airline);
                            this.filterAirlines();
                            this.closeCreateModal();
                            alert('Airline created successfully!');
                        } else {
                            alert('Error: ' + (data.message || 'Failed to create airline'));
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error creating airline');
                    }
                },

                async submitEditForm() {
                    try {
                        const response = await fetch(`/adminpanel/airlines/${this.editingAirlineId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.editForm)
                        });

                        const data = await response.json();

                        if (data.success) {
                            const index = this.allAirlines.findIndex(a => a.id === this.editingAirlineId);
                            if (index !== -1) {
                                this.allAirlines[index] = data.airline;
                            }
                            this.filterAirlines();
                            this.closeEditModal();
                            alert('Airline updated successfully!');
                        } else {
                            alert('Error: ' + (data.message || 'Failed to update airline'));
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error updating airline');
                    }
                },

                async deleteAirline(airlineId) {
                    if (!confirm('Are you sure you want to delete this airline?')) return;

                    try {
                        const response = await fetch(`/adminpanel/airlines/${airlineId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.allAirlines = this.allAirlines.filter(a => a.id !== airlineId);
                            this.filterAirlines();
                            alert('Airline deleted successfully!');
                        } else {
                            alert('Error: ' + (data.message || 'Failed to delete airline'));
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error deleting airline');
                    }
                }
            }
        }
    </script>
    </flux:main>
</x-layouts.app.sidebar>
