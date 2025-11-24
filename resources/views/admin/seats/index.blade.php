@extends('layout')

@section('content')
<h1>Seats</h1>
<a href="{{ route('admin.seats.create') }}">Create seat</a>
@if(session('success'))<div>{{ session('success') }}</div>@endif
<table>
    <thead>
        <tr><th>ID</th><th>Flight</th><th>Seat</th><th>Class</th><th>Available</th><th>Actions</th></tr>
    </thead>
    <tbody>
    @foreach($seats as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->flight_id }}</td>
            <td>{{ $s->seat_number }}</td>
            <td>{{ $s->class }}</td>
            <td>{{ $s->is_available ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.seats.show', $s) }}">View</a>
                <a href="{{ route('admin.seats.edit', $s) }}">Edit</a>
                <form action="{{ route('admin.seats.destroy', $s) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $seats->links() }}
@endsection
