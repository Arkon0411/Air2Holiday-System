<x-layouts.app.sidebar title="Users & Airlines">
    <flux:main x-data="userManager()">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50 text-center sm:text-left w-full sm:w-auto">Users</h1>
                <flux:modal.trigger name="createUserModal">
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
                    placeholder="Search by name or email..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-100 text-sm font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                        <th class="px-4 py-3 sm:px-6 sm:py-4">Name</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden md:table-cell">Email</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 hidden sm:table-cell">Type</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $u)
                        <tr class="bg-zinc-50 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-900 dark:text-gray-50">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $u->name }}</span>
                                    <div class="flex flex-col sm:hidden mt-1 space-y-1">
                                        <span class="text-xs text-gray-500">{{ $u->email }}</span>
                                        <span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $u->usertype === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : ($u->usertype === 'airline' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200') }}">
                                                {{ ucfirst($u->usertype) }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm text-gray-600 dark:text-gray-400 hidden md:table-cell">
                                {{ $u->email }}
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 hidden sm:table-cell">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $u->usertype === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : ($u->usertype === 'airline' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200') }}">
                                    {{ ucfirst($u->usertype) }}
                                </span>
                            </td>
                            
                            <td class="px-4 py-3 sm:px-6 sm:py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <flux:modal.trigger name="editUserModal">
                                        <flux:button size="sm" @click="setEditingUser({{ $u->id }})" icon="pencil-square" />
                                    </flux:modal.trigger>
                                    <form action="{{ route('adminpanel.users.destroy', $u) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
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

        <!-- Create User Modal -->
        <flux:modal name="createUserModal">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Create New User</flux:heading>
                </div>
                
                <form action="{{ route('adminpanel.users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <flux:input label="Name" name="name" required />
                    <flux:input label="Email" type="email" name="email" required />
                    <flux:input label="Password" type="password" name="password" required />
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">User Type</label>
                        <select name="usertype" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="airline">Airline</option>
                        </select>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                        <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Create User</flux:button>
                    </div>
                </form>
            </div>
        </flux:modal>

        <!-- Edit User Modal -->
        <flux:modal name="editUserModal">
            <template x-if="editingUserId">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Edit User</flux:heading>
                    </div>
                    
                    <form :action="`/adminpanel/users/${editingUserId}`" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <flux:input label="Name" name="name" x-model="editingUser.name" required />
                        <flux:input label="Email" type="email" name="email" x-model="editingUser.email" required />
                        <flux:input label="Password" type="password" name="password" placeholder="Leave blank to keep current password" />
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">User Type</label>
                            <select name="usertype" x-model="editingUser.usertype" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="airline">Airline</option>
                            </select>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4">
                            <flux:button type="submit" variant="primary" class="w-full sm:w-auto order-1 sm:order-2">Update User</flux:button>
                        </div>
                    </form>
                </div>
            </template>
        </flux:modal>

        <script>
            function userManager() {
                return {
                    editingUserId: null,
                    editingUser: {
                        name: '',
                        email: '',
                        usertype: 'user'
                    },
                    
                    async setEditingUser(userId) {
                        this.editingUserId = userId;
                        try {
                            const response = await fetch(`/adminpanel/users/${userId}/edit`);
                            const userData = await response.json();
                            this.editingUser = userData;
                        } catch (error) {
                            console.error('Error loading user data:', error);
                            alert('Error loading user data');
                        }
                    }
                };
            }

            document.addEventListener('alpine:init', () => {
                Alpine.data('userManager', userManager);
            });
        </script>
    </flux:main>
</x-layouts.app.sidebar>