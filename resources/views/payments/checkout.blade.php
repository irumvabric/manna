<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Checkout - Manna</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-vh-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Complete Your Donation
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Secure payment via Stripe
            </p>
        </div>
        <form id="payment-form" class="mt-8 space-y-6">
            @csrf
            <input type="hidden" id="stripe-key" value="{{ $stripeKey }}">
            
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="John Doe">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="john@example.com">
                </div>
                <div class="mb-4 flex space-x-4">
                    <div class="flex-1">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                        <input type="number" id="amount" name="amount" required min="1" class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" value="50">
                    </div>
                    <div class="w-1/3">
                        <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                        <select id="currency" name="currency" class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="card-element" class="block text-sm font-medium text-gray-700">Credit or Debit Card</label>
                    <div id="card-element" class="mt-1">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert" class="text-red-500 text-xs mt-2"></div>
                </div>
            </div>

            <div>
                <button id="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    <span id="button-text">Pay Now</span>
                    <span id="spinner" class="hidden ml-2 animate-spin h-5 w-5 text-white">
                        &#9696;
                    </span>
                </button>
            </div>
        </form>
    </div>

    <script>
        const stripe = Stripe(document.getElementById('stripe-key').value);
        const elements = stripe.elements();

        const style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        const card = elements.create('card', {style: style});
        card.mount('#card-element');

        card.on('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit');
        const spinner = document.getElementById('spinner');
        const buttonText = document.getElementById('button-text');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            setLoading(true);

            const {token, error} = await stripe.createToken(card);

            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
                setLoading(false);
            } else {
                // Fetch the payment intent from the server
                const response = await fetch('{{ route("payment.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value,
                        amount: document.getElementById('amount').value,
                        currency: document.getElementById('currency').value,
                    })
                });

                const data = await response.json();

                if (data.error) {
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = data.error;
                    setLoading(false);
                    return;
                }

                const result = await stripe.confirmCardPayment(data.clientSecret, {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: document.getElementById('name').value,
                        },
                    }
                });

                if (result.error) {
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    setLoading(false);
                } else {
                    if (result.paymentIntent.status === 'succeeded') {
                        window.location.href = `{{ route("payment.success") }}?payment_intent=${result.paymentIntent.id}`;
                    }
                }
            }
        });

        function setLoading(isLoading) {
            if (isLoading) {
                submitButton.disabled = true;
                spinner.classList.remove('hidden');
                buttonText.textContent = 'Processing...';
            } else {
                submitButton.disabled = false;
                spinner.classList.add('hidden');
                buttonText.textContent = 'Pay Now';
            }
        }
    </script>
</body>
</html>
