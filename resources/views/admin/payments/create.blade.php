@extends('layout')

@section('content')
<h1>Create Payment</h1>
<form method="POST" action="{{ route('admin.payments.store') }}">
    @csrf
    <label>Amount<br><input name="amount" value="{{ old('amount') }}"></label><br>
    <label>Method<br><input name="method" value="{{ old('method') }}"></label><br>
    <label>Payment date<br><input type="datetime-local" name="payment_date" value="{{ old('payment_date') }}"></label><br>
    <label>Status<br><input name="status" value="{{ old('status') }}"></label><br>
    <button type="submit">Create</button>
</form>
@endsection
