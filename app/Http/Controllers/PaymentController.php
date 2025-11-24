<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

// Optional: stripe integration if package installed
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentController extends Controller
{
    // Simple stub endpoint to mark payment as paid
    public function pay(Request $request, Payment $payment)
    {
        // If Stripe is available and a 'checkout' action requested, create a session
        if (class_exists('\Stripe\\Stripe') && $request->input('action') === 'checkout') {
            try {
                Stripe::setApiKey(env('STRIPE_SECRET'));

                $session = StripeSession::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => ['name' => 'Flight booking #' . $payment->booking_id],
                            'unit_amount' => intval($payment->amount * 100),
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => route('payments.stripe_success', ['payment' => $payment->id]),
                    'cancel_url' => route('bookings.confirm', ['booking' => $payment->booking_id]),
                ]);

                return redirect($session->url);
            } catch (\Throwable $e) {
                Log::error('Stripe checkout error: ' . $e->getMessage());
                return back()->withErrors(['payment' => 'Could not start Stripe checkout.']);
            }
        }

        // Fallback stub: mark as paid
        $payment->status = 'paid';
        $payment->provider = $request->input('provider', 'stub');
        $payment->provider_payment_id = $request->input('provider_payment_id');
        $payment->amount = $request->input('amount', $payment->amount);
        $payment->save();

        // reflect to booking
        if ($payment->booking) {
            $booking = $payment->booking;
            $booking->status = 'confirmed';
            $booking->save();
        }

        return redirect()->route('bookings.confirm', ['booking' => $payment->booking_id])->with('success', 'Payment recorded.');
    }

    // Stripe success redirect endpoint
    public function stripeSuccess(Payment $payment)
    {
        // mark payment as paid (server should verify webhook in production)
        $payment->status = 'paid';
        $payment->provider = 'stripe';
        $payment->save();

        if ($payment->booking) {
            $b = $payment->booking;
            $b->status = 'confirmed';
            $b->save();
        }

        return redirect()->route('bookings.confirm', ['booking' => $payment->booking_id])->with('success','Payment successful.');
    }

    // Webhook endpoint (optional) to process Stripe events
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sig = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            if ($endpoint_secret && class_exists('\Stripe\\Webhook')) {
                $event = \Stripe\Webhook::constructEvent($payload, $sig, $endpoint_secret);
            } else {
                $event = json_decode($payload);
            }
        } catch (\Throwable $e) {
            Log::error('Stripe webhook error: ' . $e->getMessage());
            return response('Invalid payload', 400);
        }

        // handle checkout.session.completed
        $type = $event->type ?? ($event->object->type ?? null);
        if ($type === 'checkout.session.completed' || ($event->type ?? null) === 'checkout.session.completed') {
            $session = $event->data->object ?? $event->object->data->object;
            // we used success_url with payment id in query but cannot rely on that here; in production store metadata during session creation
            Log::info('Stripe checkout completed', (array) $session);
        }

        return response('OK', 200);
    }
}
