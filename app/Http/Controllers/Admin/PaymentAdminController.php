<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentAdminController extends Controller
{
    public function index()
    {
        $payments = Payment::latest('id')->paginate(20);
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'method' => 'nullable|string|max:100',
            'payment_date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        Payment::create($data);

        return redirect()->route('admin.payments.index')->with('success', 'Payment created');
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'method' => 'nullable|string|max:100',
            'payment_date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        $payment->update($data);

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted');
    }
}
