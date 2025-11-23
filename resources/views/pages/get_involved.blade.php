@extends('layouts.guest')

@section('title', 'Get Involved - Donate Now')

@section('content')

    <!-- Contribute Now Section -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="fw-bold mb-3">Contribute now for Growth</h2>
            <p class="text-muted mb-5">
                Your small contribution means a lot. Officia amet hic aeququms magni
                reprehenderit dolorem. Your support helps us empower more students
                every day.
            </p>

            <div class="row justify-content-center g-4">
                <!-- First Donation Card -->
                <div class="col-md-5">
                    <div class="p-4 rounded-4 shadow-sm bg-light">
                        <h5 class="fw-bold mb-2">Your monthly donation</h5>
                        <p class="small text-muted">
                            You are about to become a WFP monthly supporter
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                            <button class="btn btn-outline-primary px-4">10$</button>
                            <button class="btn btn-outline-primary px-4">20$</button>
                            <button class="btn btn-outline-primary px-4">50$</button>
                            <button class="btn btn-outline-primary px-4">100$</button>
                        </div>
                        <!-- This link might route to a donation form view -->
                        <a href="{{ url('/donate/form') }}" class="btn btn-primary px-5">Donate</a>
                    </div>
                </div>

                <!-- Second Donation Card -->
                <div class="col-md-5">
                    <div class="p-4 rounded-4 shadow-sm bg-light">
                        <h5 class="fw-bold mb-2">Your monthly donation</h5>
                        <p class="small text-muted">
                            You are about to become a Maana monthly supporter
                        </p>
                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                            <button class="btn btn-outline-primary px-4">10$</button>
                            <button class="btn btn-outline-primary px-4">20$</button>
                            <button class="btn btn-outline-primary px-4">50$</button>
                            <button class="btn btn-outline-primary px-4">100$</button>
                        </div>
                        <!-- This link might route to a donation form view -->
                        <a href="{{ url('/donate/form') }}" class="btn btn-primary px-5">Donate</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Thank You Section -->
    <section class="bg-primary text-white text-center py-5">
        <div class="container">
            <h2 class="fw-bold mb-3">Thank you</h2>
            <p class="lead mb-0">
                Your small contribution means a lot. Officia amet hic aeququms magni
                reprehenderit dolorem.
            </p>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="text-white text-center py-5" style="background: url('{{ asset('bac.png') }}') center/cover no-repeat;">
        <div class="container">
            <h3 class="fw-bold mb-3">Contact us</h3>
            <p class="mb-4">
                Your small contribution means a lot. Officia amet hic aeququms magni
                reprehenderit dolorem.
            </p>
            <a href="{{ url('/contact') }}" class="btn btn-primary btn-lg">Contact us</a>
        </div>
    </section>

@endsection
