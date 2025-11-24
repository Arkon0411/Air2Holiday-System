@extends('layout')

@section('content')
<h1>Passengers</h1>
<a href="{{ route('admin.passengers.create') }}">Create passenger</a>
@if(session('success'))<div>{{ session('success') }}</div>@endif
<table>
    <thead>
        <tr><th>ID</th><th>Name</th><th>Passport</th><th>DOB</th><th>Actions</th></tr>
    </thead>
    <tbody>
    @foreach($passengers as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->passport }}</td>
            <td>{{ $p->date_of_birth }}</td>
            <td>
                <a href="{{ route('admin.passengers.show', $p) }}">View</a>
                <a href="{{ route('admin.passengers.edit', $p) }}">Edit</a>
                <form action="{{ route('admin.passengers.destroy', $p) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $passengers->links() }}
@endsection
