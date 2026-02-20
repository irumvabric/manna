<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Donator;
use App\Models\Engagement;
use App\Mail\DonationNotification;
use App\Mail\DonationConfirmation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe PaymentIntent and record the initial donation.
     */
    public function createPaymentIntent(array $data)
    {
        // 1. Find or create donator (current logic)
        $donator = Donator::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'phone' => $data['phone'] ?? null,
                'target_amount' => $data['amount'],
                'periodicity' => $data['periodicity'] ?? 'once',
                'currency' => $data['currency'] ?? 'USD',
            ]
        );

        // 2. Create the engagement record (current logic)
        $engagement = Engagement::create([
            'donator_id' => $donator->id,
            'amount' => $data['amount'],
            'currency' => $data['currency'] ?? 'USD',
            'periodicity' => $data['periodicity'] ?? 'once',
            'status' => 'active',
        ]);

        // 3. Record the initial donation as pending (current logic)
        $donation = Donation::create([
            'donator_id' => $donator->id,
            'engagement_id' => $engagement->id,
            'amount' => $data['amount'],
            'currency' => $data['currency'] ?? 'USD',
            'status' => 'pending',
            'payment_method' => 'stripe',
        ]);

        try {
            // 4. Create Stripe PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $data['amount'] * 100, // Stripe uses cents
                'currency' => strtolower($data['currency'] ?? 'usd'),
                'metadata' => [
                    'donation_id' => $donation->id,
                    'donator_email' => $donator->email,
                ],
            ]);

            return [
                'client_secret' => $paymentIntent->client_secret,
                'donation_id' => $donation->id,
            ];
        } catch (\Exception $e) {
            Log::error('Stripe PaymentIntent creation failed: ' . $e->getMessage());
            $donation->update(['status' => 'failed']);
            throw $e;
        }
    }

    /**
     * Complete the payment after Stripe confirmation.
     */
    public function completePayment(string $paymentIntentId)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            $donationId = $paymentIntent->metadata->donation_id;
            $donation = Donation::with('donator')->findOrFail($donationId);

            if ($paymentIntent->status === 'succeeded') {
                $donation->update(['status' => 'approved']);

                // 5. Trigger existing email notification logic (current logic)
                $this->sendNotifications($donation);

                return $donation;
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Stripe Payment confirmation failed: ' . $e->getMessage());
            return null;
        }
    }

    protected function sendNotifications(Donation $donation)
    {
        try {
            $adminEmail = 'irumvabric@gmail.com';
            $donatorEmail = $donation->donator->email;

            $data = [
                'name' => $donation->donator->name,
                'email' => $donation->donator->email,
                'amount' => $donation->amount,
                'currency' => $donation->currency,
            ];

            // To Admin: System notification
            Mail::to($adminEmail)->queue(new DonationNotification($data));

            // To Donor: Appreciative confirmation
            Mail::to($donatorEmail)->queue(new DonationConfirmation($data));
        } catch (\Exception $e) {
            Log::error('Donation Mail sending failed: ' . $e->getMessage());
        }
    }
}
