@extends('layout')

@section('content')
<h1>Payment #{{ $payment->id }}</h1>
<ul>
    <li>Amount: {{ $payment->amount }}</li>
    <li>Method: {{ $payment->method }}</li>
    <li>Payment date: {{ $payment->payment_date }}</li>
    <li>Status: {{ $payment->status }}</li>
</ul>
<a href="{{ route('admin.payments.index') }}">Back</a>
@endsection
