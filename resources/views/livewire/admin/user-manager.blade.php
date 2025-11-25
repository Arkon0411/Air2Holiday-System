<x-layouts.app.sidebar title="Users & Airlines">
    <flux:main>
        <div class="max-w-7xl mx-auto">
            <!-- Session Messages -->
            @if(session()->has('message'))
                <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-800 dark:bg-green-900 dark:text-green-200">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Header -->
    <div class="flex flex-col gap-4 mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50">Accounts</h1>
            <button 
                wire:click="openCreateModal"
                class="inline-flex items-center justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-offset-gray-900">
                Create
            </button>
        </div>

        <!-- Search Bar -->
        <div class="w-full">
            <input 
                type="text" 
                wire:model.live="search"
                placeholder="Search by name or email..."
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-gray-200 bg-gray-50 text-xs font-semibold text-gray-900 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3">Name</th>
                    <th scope="col" class="px-4 py-3 hidden sm:table-cell">Email</th>
                    <th scope="col" class="px-4 py-3 hidden md:table-cell">Type</th>
                    <th scope="col" class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-3">
                            <div class="font-semibold text-gray-900 dark:text-gray-50">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 sm:hidden">{{ $user->email }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 md:hidden">{{ ucfirst($user->usertype) }}</div>
                        </td>
                        <td class="px-4 py-3 hidden sm:table-cell text-gray-700 dark:text-gray-300">{{ $user->email }}</td>
                        <td class="px-4 py-3 hidden md:table-cell">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ 
                                $user->usertype === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                                ($user->usertype === 'airline' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 
                                'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200') 
                            }}">
                                {{ ucfirst($user->usertype) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2 flex-wrap">
                                <button 
                                    wire:click="openEditModal({{ $user->id }})"
                                    class="inline-flex items-center justify-center rounded-md bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800 dark:focus:ring-offset-gray-900">
                                    Edit
                                </button>
                                <button 
                                    wire:click="deleteUser({{ $user->id }})"
                                    wire:confirm="Are you sure you want to delete this user?"
                                    class="inline-flex items-center justify-center rounded-md bg-red-50 px-3 py-1 text-xs font-semibold text-red-600 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-900 dark:text-red-200 dark:hover:bg-red-800 dark:focus:ring-offset-gray-900">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                            No users found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <!-- Create Modal -->
    <flux:modal.trigger name="createUserModal" />
    <flux:modal name="createUserModal" class="md:w-96">
        <form wire:submit="createUser">
            <div class="space-y-4">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-50">Create New User</h2>
                
                <flux:input wire:model="name" label="Name" required />
                
                <flux:input wire:model="email" type="email" label="Email" required />
                
                <flux:input wire:model="password" type="password" label="Password" required />
                
                <flux:select wire:model="usertype" label="User Type">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="airline">Airline</option>
                </flux:select>

                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                @error('usertype') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3 justify-end pt-4 border-t border-gray-200 dark:border-gray-700 mt-6">
                <flux:modal.close variant="subtle">Cancel</flux:modal.close>
                <flux:button type="submit" variant="primary">Create User</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Edit Modal -->
    <flux:modal.trigger name="editUserModal" />
    <flux:modal name="editUserModal" class="md:w-96">
        @if($showEditModal)
            <form wire:submit="updateUser">
                <div class="space-y-4">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-50">Edit User</h2>
                    
                    <flux:input wire:model="name" label="Name" required />
                    
                    <flux:input wire:model="email" type="email" label="Email" required />
                    
                    <flux:input wire:model="password" type="password" label="Password (leave blank to keep)" />
                    
                    <flux:select wire:model="usertype" label="User Type">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="airline">Airline</option>
                    </flux:select>

                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('usertype') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex gap-3 justify-end pt-4 border-t border-gray-200 dark:border-gray-700 mt-6">
                    <flux:modal.close variant="subtle">Cancel</flux:modal.close>
                    <flux:button type="submit" variant="primary">Update User</flux:button>
                </div>
            </form>
        @endif
    </flux:modal>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
