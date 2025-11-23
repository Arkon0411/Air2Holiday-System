<x-layouts.app.header title="Edit User">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl font-semibold mb-4">Edit User</h1>

        <form action="{{ route('adminpanel.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label>Name</label>
                <input name="name" value="{{ $user->name }}" />
            </div>
            <div>
                <label>Email</label>
                <input name="email" value="{{ $user->email }}" />
            </div>
            <div>
                <label>Password (leave blank to keep)</label>
                <input name="password" type="password" />
            </div>
            <div>
                <label>Type</label>
                <select name="usertype">
                    <option value="user" {{ $user->usertype === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->usertype === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="airline" {{ $user->usertype === 'airline' ? 'selected' : '' }}>Airline</option>
                </select>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</x-layouts.app.header>
