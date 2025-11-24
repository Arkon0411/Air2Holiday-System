@extends('layout')

@section('content')
<h1>Edit Payment</h1>
<form method="POST" action="{{ route('admin.payments.update', $payment) }}">
    @csrf
    @method('PUT')
    <label>Amount<br><input name="amount" value="{{ old('amount', $payment->amount) }}"></label><br>
    <label>Method<br><input name="method" value="{{ old('method', $payment->method) }}"></label><br>
    <label>Payment date<br><input type="datetime-local" name="payment_date" value="{{ old('payment_date', $payment->payment_date) }}"></label><br>
    <label>Status<br><input name="status" value="{{ old('status', $payment->status) }}"></label><br>
    <button type="submit">Save</button>
</form>
@endsection
