<x-layouts.app.header title="Create User">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-semibold mb-4">Create User</h1>

        <form action="{{ route('adminpanel.users.store') }}" method="POST">
            @csrf
            <div>
                <label>Name</label>
                <input name="name" />
            </div>
            <div>
                <label>Email</label>
                <input name="email" />
            </div>
            <div>
                <label>Password</label>
                <input name="password" type="password" />
            </div>
            <div>
                <label>Type</label>
                <select name="usertype">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="airline">Airline</option>
                </select>
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</x-layouts.app.header>
