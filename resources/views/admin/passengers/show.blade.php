@extends('layout')

@section('content')
<h1>Passenger #{{ $passenger->id }}</h1>
<ul>
    <li>Name: {{ $passenger->name }}</li>
    <li>Passport: {{ $passenger->passport }}</li>
    <li>Date of birth: {{ $passenger->date_of_birth }}</li>
</ul>
<a href="{{ route('admin.passengers.index') }}">Back</a>
@endsection
