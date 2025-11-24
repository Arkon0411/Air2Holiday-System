@extends('layout')

@section('content')
<h1>Seat #{{ $seat->id }}</h1>
<ul>
    <li>Flight ID: {{ $seat->flight_id }}</li>
    <li>Seat number: {{ $seat->seat_number }}</li>
    <li>Class: {{ $seat->class }}</li>
    <li>Available: {{ $seat->is_available ? 'Yes' : 'No' }}</li>
</ul>
<a href="{{ route('admin.seats.index') }}">Back</a>
@endsection
