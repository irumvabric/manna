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
                    <img src="{{ asset('img/web_image_4.jpg') }}" alt="About Manna"
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
    <section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-2" style="color: #0070ba;">{{ __('messages.our_focus') }}</h2>
        <p class="text-muted mb-5">Empowering the next generation of leaders in Burundi</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    <div class="card-img-container">
                         <img src="{{ asset('img/web_image_5.jpg') }}" class="card-img-top" alt="Scholarships" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body p-4">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-graduation-cap text-primary"></i>
                        </div>
                        <h5 class="card-title fw-bold">{{ __('messages.scholarships') }}</h5>
                        <p class="card-text text-muted medium">
                            {{ __('messages.scholarships_desc') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    <div class="card-img-container">
                        <img src="{{ asset('https://images.pexels.com/photos/289737/pexels-photo-289737.jpeg') }}" class="card-img-top" alt="Educational Resources" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold">{{ __('messages.educational_resources') }}</h5>
                        <p class="card-text text-muted medium">
                            {{ __('messages.educational_resources_desc') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    <div class="card-img-container">
                        <img src="{{ asset('img/web_image_6.png') }}" class="card-img-top" alt="Mentorship" style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold">{{ __('messages.career_guidance') }}</h5>
                        <p class="card-text text-muted medium">
                            {{ __('messages.career_guidance_desc') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>

    .card-img-container {
        overflow: hidden;
    }
</style>

@endsection
