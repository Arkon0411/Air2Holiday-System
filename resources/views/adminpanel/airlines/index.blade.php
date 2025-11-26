<x-layouts.app.sidebar title="Airlines">
    <flux:main x-data="airlineManager()">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-800 dark:bg-green-900/20 dark:text-green-400" role="alert">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-800 dark:bg-red-900/20 dark:text-red-400" role="alert">
                <strong>Error!</strong> {{ session('error') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-800 dark:bg-red-900/20 dark:text-red-400" role="alert">
                <strong>Validation Errors:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50 text-center sm:text-left w-full sm:w-auto">Airlines</h1>
                <flux:modal.trigger name="createAirlineModal">
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
                    placeholder="Search by name, code, or account..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-100 text-sm font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                        <th class="px-4 py-3 sm:px-6 sm:py-4">Name</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden md:table-cell">Code</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden sm:table-cell">Associated Account</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($airlines as $airline)
                        <tr class="bg-zinc-50 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-900 dark:text-gray-50">
                                <div class="flex items-center gap-3">
                                    @if($airline->logo)
                                        <img src="{{ asset($airline->logo) }}" alt="{{ $airline->name }}" class="h-8 w-8 rounded object-cover">
                                    @else
                                        <div class="h-8 w-8 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                            <span class="text-xs text-gray-500">N/A</span>
                                        </div>
                                    @endif
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $airline->name }}</span>
                                        <div class="flex flex-col sm:hidden mt-1 space-y-1">
                                            <span class="text-xs text-gray-500">{{ $airline->code }}</span>
                                            <span class="text-xs text-gray-500">{{ $airline->user ? $airline->user->name : 'No account' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden md:table-cell">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $airline->code }}
                                </span>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden sm:table-cell">
                                {{ $airline->user ? $airline->user->name : 'No account' }}
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <flux:modal.trigger name="editAirlineModal">
                                        <flux:button size="sm" @click="setEditingAirline({{ $airline->id }})" icon="pencil-square" />
                                    </flux:modal.trigger>
                                    <form action="{{ route('adminpanel.airlines.destroy', $airline) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this airline?')">
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

        <!-- Create Airline Modal -->
        <flux:modal name="createAirlineModal">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Create New Airline</flux:heading>
                </div>
                
                <form action="{{ route('adminpanel.airlines.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <flux:input label="Name" name="name" required />
                    <flux:input label="Code" name="code" required placeholder="e.g., AA, UA, DL" />
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Associated Account</label>
                        <select name="user_id" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                            <option value="">-- No Account --</option>
                            @foreach($airlineUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Select an airline user account to associate with this airline</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Airline Logo</label>
                        <input type="file" name="logo" accept="image/*" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Optional. Upload airline logo image.</p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                        <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'createAirlineModal' })" type="button" class="w-full sm:w-auto order-2 sm:order-1">Cancel</flux:button>
                        <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Create Airline</flux:button>
                    </div>
                </form>
            </div>
        </flux:modal>

        <!-- Edit Airline Modal -->
        <flux:modal name="editAirlineModal">
            <template x-if="editingAirlineId">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Edit Airline</flux:heading>
                    </div>
                    
                    <form :action="`/adminpanel/airlines/${editingAirlineId}`" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <flux:input label="Name" name="name" x-model="editingAirline.name" required />
                        <flux:input label="Code" name="code" x-model="editingAirline.code" required />
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Associated Account</label>
                            <select name="user_id" x-model="editingAirline.user_id" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                <option value="">-- No Account --</option>
                                @foreach($airlineUsers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Airline Logo</label>
                            <input type="file" name="logo" accept="image/*" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave blank to keep current logo.</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                            <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'editAirlineModal' })" type="button" class="w-full sm:w-auto order-2 sm:order-1">Cancel</flux:button>
                            <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Update Airline</flux:button>
                        </div>
                    </form>
                </div>
            </template>
        </flux:modal>

        <script>
            function airlineManager() {
                return {
                    editingAirlineId: null,
                    editingAirline: {
                        name: '',
                        code: '',
                        user_id: ''
                    },
                    
                    async setEditingAirline(airlineId) {
                        this.editingAirlineId = airlineId;
                        try {
                            const response = await fetch(`/adminpanel/airlines/${airlineId}/edit`);
                            const airlineData = await response.json();
                            this.editingAirline = airlineData;
                        } catch (error) {
                            console.error('Error loading airline data:', error);
                            alert('Error loading airline data');
                        }
                    }
                };
            }

            document.addEventListener('alpine:init', () => {
                Alpine.data('airlineManager', airlineManager);
            });
        </script>
    </flux:main>
</x-layouts.app.sidebar>
