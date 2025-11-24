@extends('layout')

@section('content')
<h1>Edit Seat</h1>
<form method="POST" action="{{ route('admin.seats.update', $seat) }}">
    @csrf
    @method('PUT')
    <label>Flight<br>
        <select name="flight_id">
            @foreach($flights as $f)
                <option value="{{ $f->id }}" {{ old('flight_id', $seat->flight_id) == $f->id ? 'selected' : '' }}>{{ $f->flight_number }} (#{{ $f->id }})</option>
            @endforeach
        </select>
    </label><br>
    <label>Seat number<br><input name="seat_number" value="{{ old('seat_number', $seat->seat_number) }}"></label><br>
    <label>Class<br><input name="class" value="{{ old('class', $seat->class) }}"></label><br>
    <label>Available<input type="checkbox" name="is_available" value="1" {{ old('is_available', $seat->is_available) ? 'checked' : '' }}></label><br>
    <button type="submit">Save</button>
</form>
@endsection
