@extends('layouts.web')

@section('title', __('messages.about'))

@section('content')

    <!-- About Section -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="fw-bold text-primary mb-4">{{ __('messages.who_we_are') }}</h2>
            <p class="lead mb-5 ">{{ __('messages.about_description') }}</p>
            <!-- Note: Using a direct URL for the image below, but if you download it and place it in your public folder, use asset() -->
            <img src="{{ asset('img/Second_Student.png') }}" alt="Étudiants en train d'apprendre"
                class="img-fluid rounded shadow-sm mb-5 w-25" {{-- <img src="{{ asset('img/web_image_4.jpg') }}" alt="Students learning" class="img-fluid rounded shadow-sm mb-5 w-50 x-25"> --}} </div>
    </section>

    <!-- Mission, Vision, Values -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h3 class="fw-bold text-primary mb-4">{{ __('messages.mission_vision_values') }}</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <i class=""></i>
                    <h5 class="fw-bold">{{ __('messages.mission') }}</h5>
                    <p>{{ __('messages.mission_desc') }}
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold">{{ __('messages.vision') }}</h5>
                    <p>{{ __('messages.vision_desc') }}</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold">{{ __('messages.values') }}</h5>
                    <p>{{ __('messages.values_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team members -- Team/ -->

    <section class="team-members py-5">
        <div class="container">
            <h3 class="fw-bold text-primary mb-4 text-center">{{ __('messages.our_team') }}</h3>
            <div class="row g-4">

                <!-- Benit Cadeau -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                        <img src="{{ asset('img/Team/Ngerageze Cadeau.jpg') }}" class="card-img-top w-100 object-fit-cover"
                            style="height: 320px;" alt="Benit Cadeau">
                        <div
                            class="card-body text-center bg-white m-2 rounded-3 shadow-sm position-absolute bottom-0 start-0 end-0 py-2 px-1">
                            <h6 class="fw-bold text-dark mb-0 fs-6">Bénit Cadeau Ngerageze</h6>
                            <small class="text-muted small">President & Co-Founder</small>
                        </div>
                    </div>
                </div>

                <!-- Ciella Ininahazwe -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                        <img src="{{ asset('img/Team/Ciella Ininahazwe.jpg') }}"
                            class="card-img-top w-100 object-fit-cover" style="height: 320px;" alt="Ciella Ininahazwe">
                        <div
                            class="card-body text-center bg-white m-2 rounded-3 shadow-sm position-absolute bottom-0 start-0 end-0 py-2 px-1">
                            <h6 class="fw-bold text-dark mb-0 fs-6">Ciella Ininahazwe</h6>
                            <small class="text-muted small">Vice President & Co-Founder</small>
                        </div>
                    </div>
                </div>

                <!-- Guy Tresor -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                        <img src="{{ asset('img/Team/KARIKERA Guy Trésor.jpeg') }}"
                            class="card-img-top w-100 object-fit-cover" style="height: 320px;" alt="Guy Tresor">
                        <div
                            class="card-body text-center bg-white m-2 rounded-3 shadow-sm position-absolute bottom-0 start-0 end-0 py-2 px-1">
                            <h6 class="fw-bold text-dark mb-0 fs-6">Guy Trésor Karikera</h6>
                            <small class="text-muted small">Social Media Manager</small>
                        </div>
                    </div>
                </div>

                <!-- Brice Berry -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                        <img src="{{ asset('img/Team/Irumva Brice Berry.jpg') }}"
                            class="card-img-top w-100 object-fit-cover" style="height: 320px;" alt="Brice Berry">
                        <div
                            class="card-body text-center bg-white m-2 rounded-3 shadow-sm position-absolute bottom-0 start-0 end-0 py-2 px-1">
                            <h6 class="fw-bold text-dark mb-0 fs-6">Brice Berry Irumva</h6>
                            <small class="text-muted small">IT Manager</small>
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
                    <p class="lead mb-4">
                        {{ __('messages.hero_subtitle') }}
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
