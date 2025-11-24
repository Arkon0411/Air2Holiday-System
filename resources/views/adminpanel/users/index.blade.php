<x-layouts.app.sidebar title="Users & Airlines">
    <flux:main>
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl font-semibold">Users & Airlines</h1>
            <a href="{{ route('adminpanel.users.create') }}" class="btn">Create</a>
        </div>

        <table class="w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->usertype }}</td>
                        <td>
                            <a href="{{ route('adminpanel.users.edit', $u) }}">Edit</a>
                            <form action="{{ route('adminpanel.users.destroy', $u) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </flux:main>
</x-layouts.app.sidebar>
