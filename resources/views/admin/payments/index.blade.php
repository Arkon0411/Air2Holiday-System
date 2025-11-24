@extends('layout')

@section('content')
<h1>Payments</h1>
<a href="{{ route('admin.payments.create') }}">Create payment</a>
@if(session('success'))<div>{{ session('success') }}</div>@endif
<table>
    <thead>
        <tr><th>ID</th><th>Amount</th><th>Method</th><th>Payment Date</th><th>Status</th><th>Actions</th></tr>
    </thead>
    <tbody>
    @foreach($payments as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->amount }}</td>
            <td>{{ $p->method }}</td>
            <td>{{ $p->payment_date }}</td>
            <td>{{ $p->status }}</td>
            <td>
                <a href="{{ route('admin.payments.show', $p) }}">View</a>
                <a href="{{ route('admin.payments.edit', $p) }}">Edit</a>
                <form action="{{ route('admin.payments.destroy', $p) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $payments->links() }}
@endsection
