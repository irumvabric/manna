@extends('layouts.guest')

@section('title', 'Get Involved - Donate Now')

@section('content')

    <!-- Contribute Now Section -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="fw-bold mb-3">Contribute now for Growth</h2>
            <p class="text-muted mb-5">
                Every donation helps us support more university students on their academic journey. Your generosity fuels
                mentorship programs, tuition support, and opportunities that change lives.
            </p>

            <div class="row justify-content-center g-4">
                <!-- First Donation Card -->
                <div class="col-md-5">
                    <div class="p-4 rounded-4 shadow-sm bg-light">
                        <h5 class="fw-bold mb-2">Your donation</h5>
                        <p class="small text-muted">
                            {{-- You are about to become a Maana supporter — someone committed to helping students succeed all
                            year long. --}}
                            Please download this form, fill it out, and send it back to us via <span class="mx-3 fw-bold"
                                style="color:#005d9b"><a
                                    href="mailto:initiativemanna@gmail.com">initiativemanna@gmail.com</a>
                            </span>
                        </p>
                        <div class="form-pdf">
                            <a href="{{ asset('docs/donation_form.pdf') }}" class="btn btn-primary px-4" download>Download
                                Donation Form (PDF)</a>
                        </div>
                        {{-- <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                            <button class="btn btn-outline-primary px-4">10$</button>
                            <button class="btn btn-outline-primary px-4">20$</button>
                            <button class="btn btn-outline-primary px-4">50$</button>
                            <button class="btn btn-outline-primary px-4">100$</button>
                        </div>
                        <!-- This link might route to a donation form view -->
                        <a href="{{ url('/donate/form') }}" class="btn btn-primary px-5">Donate</a> 
                    </div> --}}
                    </div>

                    {{-- <!-- Second Donation Card -->
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
                    </div> --}}
                </div>
            </div>
    </section>

    <!-- Thank You Section -->
    <section class="text-white text-center py-5" style="background-color: #005d9b">
        <div class="container">
            <h2 class="fw-bold mb-3">Thank you</h2>
            <p>
                Your support truly matters. It enables us to reach more students, offer stronger programs, and build a
                brighter future for young leaders.
            </p>
        </div>
    </section>

    <!-- Get Involved section -->
    <section class="get-involved text-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-8 content">
                    <h2 class="fw-bold">Get involved</h2>
                    <p class="lead mb-0">
                        You can change a student's life today — whether by donating, volunteering, or spreading the
                        word.
                        Together, we can make higher education accessible for all.
                    </p>
                </div>
                <div class="col-md-4 text-md-end content text-white">
                    <a href="{{ url('/contact') }}" class="btn btn-primary btn-contact px-4">Contact us</a>
                </div>
            </div>
        </div>
    </section>

@endsection
