@extends('layouts.web')

@section('title', __('messages.hero_title'))

@section('content')

    <!-- Hero Section -->
    <section class="hero d-flex align-items-center text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">{{ __('messages.hero_title') }}</h1>
            <p class="lead mt-3 mb-4">
                {{ __('messages.hero_subtitle') }}
            </p>
            <a href="{{ url('/about') }}" style="color: #0070ba;"
                class="btn btn-light btn-lg text-primary fw-semibold">{{ __('messages.about') }}</a>
        </div>
    </section>

    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6 text-center text-lg-start">
                    {{-- <img src="{{ asset('img/bac.png') }}" alt="About Manna" class="about-image img-fluid"> --}}
                    <img src="https://images.pexels.com/photos/6207910/pexels-photo-6207910.jpeg" alt="About Manna"
                        class="about-image img-fluid">
                </div>
                <div class="col-lg-6">
                    <p class="small text-muted mb-2">{{ __('messages.small_help') }}</p>
                    <h2 class="fw-bold display-6 mb-3">{{ __('messages.about') }}</h2>
                    <p class="mb-4">
                        {{ __('messages.about_description') }}
                    </p>
                    <a href="{{ url('/about') }}" class="btn btn-primary btn-lg">{{ __('messages.see_more') }}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Focus Areas -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="fw-bold text-primary mb-4" style="color: #0070ba;">{{ __('messages.our_focus') }}</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <img src="https://images.pexels.com/photos/289737/pexels-photo-289737.jpeg" alt="">
                            <h5 class="card-title fw-bold">{{ __('messages.scholarships') }}</h5>
                            <p class="card-text">
                                {{ __('messages.scholarships_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <img src="https://images.pexels.com/photos/3184360/pexels-photo-3184360.jpeg" alt="">
                            <h5 class="card-title fw-bold">{{ __('messages.educational_resources') }}</h5>
                            <p class="card-text">
                                {{ __('messages.educational_resources_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <img src="https://images.pexels.com/photos/3280130/pexels-photo-3280130.jpeg" alt="">
                            <h5 class="card-title fw-bold">{{ __('messages.career_guidance') }}</h5>
                            <p class="card-text">
                                {{ __('messages.career_guidance_desc') }}
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
                    <h2 class="fw-bold">{{ __('messages.get_involved') }}</h2>
                    <p class="lead mb-0">
                        {{ __('messages.get_involved_desc') }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end content text-white">
                    <a href="{{ url('/contact') }}"
                        class="btn btn-primary btn-contact px-4">{{ __('messages.contact') }}</a>
                </div>
            </div>
        </div>
    </section>

@endsection
