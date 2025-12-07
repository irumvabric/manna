@extends('layouts.web')

@section('title', 'Empowering Students Through Education')

@section('content')

    <!-- Hero Section -->
    <section class="hero d-flex align-items-center text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">Empowering Students Through Education</h1>
            <p class="lead mt-3 mb-4">
                Helping university scholars from low-income families achieve their
                dreams.
            </p>
            <a href="{{ url('/about') }}" style="color: #0070ba;" class="btn btn-light btn-lg text-primary fw-semibold">Learn
                More</a>
        </div>
    </section>

    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6 text-center text-lg-start">
                    {{-- <img src="{{ asset('img/bac.png') }}" alt="About Maana" class="about-image img-fluid"> --}}
                    <img src="https://images.pexels.com/photos/6207910/pexels-photo-6207910.jpeg" alt="About Maana"
                        class="about-image img-fluid">
                </div>
                <div class="col-lg-6">
                    <p class="small text-muted mb-2">Small Help Can Make Change</p>
                    <h2 class="fw-bold display-6 mb-3">About us</h2>
                    <p class="mb-4">
                        At Maana Initiative, we believe that education is the key to breaking the cycle of poverty.Your
                        support provides scholarships, educational materials, and mentorship opportunities to talented
                        students who otherwise couldn’t afford university.
                    </p>
                    <a href="{{ url('/about') }}" class="btn btn-primary btn-lg">See more about us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Focus Areas -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold text-primary mb-4" style="color: #0070ba;">Our Focus</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <img src="https://images.pexels.com/photos/289737/pexels-photo-289737.jpeg" alt="">
                            <h5 class="card-title fw-bold">Scholarships for University Students</h5>
                            <p class="card-text">
                                We provide tuition assistance and scholarships for brilliant students from disadvantaged
                                backgrounds.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg" alt="">
                            <h5 class="card-title fw-bold">Educational Resources Support</h5>
                            <p class="card-text">
                                We supply books, learning tools, and technology to help students thrive academically.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <img src="https://images.pexels.com/photos/3280130/pexels-photo-3280130.jpeg" alt="">
                            <h5 class="card-title fw-bold">Mentorship and Career Guidance</h5>
                            <p class="card-text">
                                We connect scholars with professionals to build skills, confidence, and a successful future.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
