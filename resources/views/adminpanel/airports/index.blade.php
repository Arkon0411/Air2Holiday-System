<x-layouts.app.sidebar title="Airports">
    <flux:main x-data="airportManager()">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50 text-center sm:text-left w-full sm:w-auto">Airports</h1>
                <flux:modal.trigger name="createAirportModal">
                    <flux:button variant="primary" icon="plus-circle" class="w-full sm:w-auto">Create</flux:button>
                </flux:modal.trigger>
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
                    placeholder="Search by name, IATA code, or location..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-100 text-sm font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                        <th class="px-4 py-3 sm:px-6 sm:py-4">Name</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden md:table-cell">IATA Code</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden sm:table-cell">Location</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($airports as $airport)
                        <tr class="bg-zinc-50 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-900 dark:text-gray-50">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $airport->name }}</span>
                                    <div class="flex flex-col sm:hidden mt-1 space-y-1">
                                        <span class="text-xs text-gray-500">{{ $airport->iata_code }}</span>
                                        <span class="text-xs text-gray-500">{{ $airport->location }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden md:table-cell">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $airport->iata_code }}
                                </span>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden sm:table-cell">
                                {{ $airport->location }}
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <flux:modal.trigger name="editAirportModal">
                                        <flux:button size="sm" @click="setEditingAirport({{ $airport->id }})" icon="pencil-square" />
                                    </flux:modal.trigger>
                                    <form action="{{ route('adminpanel.airports.destroy', $airport) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this airport?')">
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

        <!-- Create Airport Modal -->
        <flux:modal name="createAirportModal">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Create New Airport</flux:heading>
                </div>
                
                <form action="{{ route('adminpanel.airports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <flux:input label="Name" name="name" required />
                    <flux:input label="IATA Code" name="iata_code" required />
                    <flux:input label="Location" name="location" required />
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Airport Image</label>
                        <input type="file" name="image" accept="image/*" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Optional. Default image will be used if not provided.</p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                        <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'createAirportModal' })" type="button" class="w-full sm:w-auto order-2 sm:order-1">Cancel</flux:button>
                        <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Create Airport</flux:button>
                    </div>
                </form>
            </div>
        </flux:modal>

        <!-- Edit Airport Modal -->
        <flux:modal name="editAirportModal">
            <template x-if="editingAirportId">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Edit Airport</flux:heading>
                    </div>
                    
                    <form :action="`/adminpanel/airports/${editingAirportId}`" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <flux:input label="Name" name="name" x-model="editingAirport.name" required />
                        <flux:input label="IATA Code" name="iata_code" x-model="editingAirport.iata_code" required />
                        <flux:input label="Location" name="location" x-model="editingAirport.location" required />
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Airport Image</label>
                            <input type="file" name="image" accept="image/*" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave blank to keep current image.</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                            <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'editAirportModal' })" type="button" class="w-full sm:w-auto order-2 sm:order-1">Cancel</flux:button>
                            <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Update Airport</flux:button>
                        </div>
                    </form>
                </div>
            </template>
        </flux:modal>

        <script>
            function airportManager() {
                return {
                    editingAirportId: null,
                    editingAirport: {
                        name: '',
                        iata_code: '',
                        location: ''
                    },
                    
                    async setEditingAirport(airportId) {
                        this.editingAirportId = airportId;
                        try {
                            const response = await fetch(`/adminpanel/airports/${airportId}/edit`);
                            const airportData = await response.json();
                            this.editingAirport = airportData;
                        } catch (error) {
                            console.error('Error loading airport data:', error);
                            alert('Error loading airport data');
                        }
                    }
                };
            }

            document.addEventListener('alpine:init', () => {
                Alpine.data('airportManager', airportManager);
            });
        </script>
    </flux:main>
</x-layouts.app.sidebar>
