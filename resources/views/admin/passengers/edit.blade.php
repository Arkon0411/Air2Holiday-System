@extends('layout')

@section('content')
<h1>Edit Passenger</h1>
<form method="POST" action="{{ route('admin.passengers.update', $passenger) }}">
    @csrf
    @method('PUT')
    <label>Booking<br>
        <select name="booking_id">
            <option value="">-- none --</option>
            @foreach($bookings as $b)
                <option value="{{ $b->id }}" {{ old('booking_id', $passenger->booking_id) == $b->id ? 'selected' : '' }}>#{{ $b->id }} - {{ optional($b->user)->name ?? 'User '.$b->user_id }}</option>
            @endforeach
        </select>
    </label><br>
    <label>Name<br><input name="name" value="{{ old('name', $passenger->name) }}"></label><br>
    <label>Passport<br><input name="passport" value="{{ old('passport', $passenger->passport) }}"></label><br>
    <label>Date of birth<br><input type="date" name="date_of_birth" value="{{ old('date_of_birth', $passenger->date_of_birth) }}"></label><br>
    <button type="submit">Save</button>
</form>
@endsection
