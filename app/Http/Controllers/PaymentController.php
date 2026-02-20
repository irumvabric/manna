<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Show the checkout page.
     */
    public function index()
    {
        return view('payments.checkout', [
            'stripeKey' => config('services.stripe.key'),
        ]);
    }

    /**
     * Create a payment intent.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string|size:3',
            'phone' => 'nullable|string|max:20',
            'periodicity' => 'nullable|string',
        ]);

        try {
            $result = $this->paymentService->createPaymentIntent($request->all());

            return response()->json([
                'clientSecret' => $result['client_secret'],
                'donationId' => $result['donation_id'],
            ]);
        } catch (\Exception $e) {
            Log::error('Payment creation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Payment creation failed. Please try again.'], 500);
        }
    }

    /**
     * Handle successful payment (frontend redirect).
     */
    public function success(Request $request)
    {
        $paymentIntentId = $request->get('payment_intent');

        if (!$paymentIntentId) {
            return redirect()->route('checkout')->with('error', 'Invalid payment session.');
        }

        $donation = $this->paymentService->completePayment($paymentIntentId);

        if ($donation) {
            return view('payments.success', compact('donation'));
        }

        return redirect()->route('checkout')->with('error', 'Payment could not be verified.');
    }
}
