@extends('layouts.web')

@section('title', 'About Us')

@section('content')

    <!-- About Section -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="fw-bold text-primary mb-4">Who We Are</h2>
            <p class="lead mb-5 ">Maana Initiative is a non-profit organization dedicated to helping university scholars from
                underprivileged families access quality education and mentorship opportunities.</p>
            <!-- Note: Using a direct URL for the image below, but if you download it and place it in your public folder, use asset() -->
            <img src="https://images.pexels.com/photos/901962/pexels-photo-901962.jpeg" alt="Students learning"
                class="img-fluid rounded shadow-sm mb-5 w-50 x-25">
        </div>
    </section>

    <!-- Mission, Vision, Values -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h3 class="fw-bold text-primary mb-4">Our Mission, Vision & Values</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <i class=""></i>
                    <h5 class="fw-bold">Mission</h5>
                    <p>To support and empower young scholars by providing financial assistance and mentorship opportunities.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold">Vision</h5>
                    <p>To see every talented student, regardless of background, achieve their full potential.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold">Values</h5>
                    <p>Equity, Empowerment, Integrity, and Community Development.</p>
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
                    <p class="lead mb-4">
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
