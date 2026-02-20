<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Manna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-vh-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl text-center">
        <div class="flex justify-center">
            <svg class="h-20 w-20 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Payment Successful!
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Thank you, {{ $donation->donator->name }}, for your generous donation of <strong>{{ number_format($donation->amount, 2) }} {{ strtoupper($donation->currency) }}</strong>.
        </p>
        <p class="mt-2 text-xs text-gray-500">
            A confirmation email has been sent to {{ $donation->donator->email }}.
        </p>
        <div class="mt-8">
            <a href="/" class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Return to Home
            </a>
        </div>
    </div>
</body>
</html>
