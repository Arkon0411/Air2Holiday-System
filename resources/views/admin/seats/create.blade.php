@extends('layout')

@section('content')
<h1>Create Seat</h1>
<form method="POST" action="{{ route('admin.seats.store') }}">
    @csrf
    <label>Flight<br>
        <select name="flight_id">
            @foreach($flights as $f)
                <option value="{{ $f->id }}" {{ old('flight_id') == $f->id ? 'selected' : '' }}>{{ $f->flight_number }} (#{{ $f->id }})</option>
            @endforeach
        </select>
    </label><br>
    <label>Seat number<br><input name="seat_number" value="{{ old('seat_number') }}"></label><br>
    <label>Class<br><input name="class" value="{{ old('class') }}"></label><br>
    <label>Available<input type="checkbox" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}></label><br>
    <button type="submit">Create</button>
</form>
@endsection
