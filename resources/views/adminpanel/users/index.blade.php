<x-layouts.app.sidebar title="Users & Airlines">
    <flux:main>
    <div id="admin-users" class="max-w-7xl mx-auto" x-data="usersManager()" data-initial-users="{{ base64_encode(json_encode($users)) }}">
        <!-- Header -->
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50">Accounts</h1>
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
                    @input="filterUsers()"
                    placeholder="Search by name or email..."
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-50 dark:placeholder-gray-400" />
            </div>
        </div>

        
        </div>
    </div>
    </flux:main>

    <!-- Create Modal -->
    <flux:modal name="createUserModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create New User</flux:heading>
            </div>
            
            <form @submit.prevent="submitCreateForm" class="space-y-4">
                <flux:input label="Name" x-model="createForm.name" required />
                <flux:input label="Email" type="email" x-model="createForm.email" required />
                <flux:input label="Password" type="password" x-model="createForm.password" required />
                <flux:select label="User Type" x-model="createForm.usertype" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="airline">Airline</option>
                </flux:select>
                
                <div class="flex gap-3 justify-end pt-4">
                    <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'createUserModal' })">Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Create User</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Edit Modal -->
    <flux:modal name="editUserModal">
        <template x-if="editingUserId">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit User</flux:heading>
                </div>
                
                <form @submit.prevent="submitEditForm" class="space-y-4">
                    <flux:input label="Name" x-model="editForm.name" required />
                    <flux:input label="Email" type="email" x-model="editForm.email" required />
                    <flux:input label="Password (leave blank to keep)" type="password" x-model="editForm.password" />
                    <flux:select label="User Type" x-model="editForm.usertype" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="airline">Airline</option>
                    </flux:select>
                    
                    <div class="flex gap-3 justify-end pt-4">
                        <flux:button variant="ghost" @click="$dispatch('close-modal', { name: 'editUserModal' })">Cancel</flux:button>
                        <flux:button type="submit" variant="primary">Update User</flux:button>
                    </div>
                </form>
            </div>
        </template>
    </flux:modal>

    <script>
        function usersManager() {
            return {
                editingUserId: null,
                searchQuery: '',
                allUsers: JSON.parse(atob(document.getElementById('admin-users').dataset.initialUsers || 'W10=')),
                filteredUsers: JSON.parse(atob(document.getElementById('admin-users').dataset.initialUsers || 'W10=')),
                createForm: {
                    name: '',
                    email: '',
                    password: '',
                    usertype: 'user'
                },
                editForm: {
                    name: '',
                    email: '',
                    password: '',
                    usertype: 'user'
                },

                capitalize(str) {
                    return str.charAt(0).toUpperCase() + str.slice(1);
                },

                getBadgeClass(usertype) {
                    const classes = {
                        admin: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                        airline: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                        user: 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200'
                    };
                    return classes[usertype] || classes.user;
                },

                filterUsers() {
                    const query = this.searchQuery.toLowerCase();
                    this.filteredUsers = this.allUsers.filter(user =>
                        user.name.toLowerCase().includes(query) ||
                        user.email.toLowerCase().includes(query)
                    );
                },

                openCreateModal() {
                    this.createForm = { name: '', email: '', password: '', usertype: 'user' };
                    this.$dispatch('open-modal', { name: 'createUserModal' });
                },

                closeCreateModal() {
                    this.createForm = { name: '', email: '', password: '', usertype: 'user' };
                    this.$dispatch('close-modal', { name: 'createUserModal' });
                },

                openEditModal(userId) {
                    const user = this.allUsers.find(u => u.id === userId);
                    if (user) {
                        this.editingUserId = userId;
                        this.editForm = {
                            name: user.name,
                            email: user.email,
                            password: '',
                            usertype: user.usertype
                        };
                        this.$dispatch('open-modal', { name: 'editUserModal' });
                    }
                },

                closeEditModal() {
                    this.editingUserId = null;
                    this.editForm = { name: '', email: '', password: '', usertype: 'user' };
                    this.$dispatch('close-modal', { name: 'editUserModal' });
                },

                async submitCreateForm() {
                    try {
                        const response = await fetch('{{ route("adminpanel.users.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.createForm)
                        });

                        if (response.ok) {
                            const newUser = await response.json();
                            this.allUsers.push(newUser);
                            this.filterUsers();
                            this.closeCreateModal();
                            alert('User created successfully!');
                        } else {
                            alert('Error creating user');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error creating user');
                    }
                },

                async submitEditForm() {
                    try {
                        const response = await fetch(`/adminpanel/users/${this.editingUserId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.editForm)
                        });

                        if (response.ok) {
                            const updatedUser = await response.json();
                            const index = this.allUsers.findIndex(u => u.id === this.editingUserId);
                            if (index !== -1) {
                                this.allUsers[index] = updatedUser;
                            }
                            this.filterUsers();
                            this.closeEditModal();
                            alert('User updated successfully!');
                        } else {
                            alert('Error updating user');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error updating user');
                    }
                },

                async deleteUser(userId) {
                    if (!confirm('Are you sure you want to delete this user?')) return;

                    try {
                        const response = await fetch(`/adminpanel/users/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        if (response.ok) {
                            this.allUsers = this.allUsers.filter(u => u.id !== userId);
                            this.filterUsers();
                            alert('User deleted successfully!');
                        } else {
                            alert('Error deleting user');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error deleting user');
                    }
                }
            };
        }
    </script>