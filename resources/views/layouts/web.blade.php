<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Manna Initiative | Home')</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        .hero {
            background: url("{{ asset('img/hero-bg.jpg') }}") center center/cover no-repeat;
            height: 100vh;
        }

        .about-image {
            height: 400px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .text-lg-start {
            text-align: center !important;
        }

        .card-body {
            border-radius: 80px;
        }

        .card-body img {
            width: 100%;
            height: 200px;
            margin-bottom: 15px;
            object-fit: contain;
            border-radius: 2%;
        }

        /* Floating Donate Button */
        .btn-floating-donate {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 112, 186, 0.4);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-floating-donate:hover {
            transform: scale(1.1);
        }

        .btn-floating-donate i {
            font-size: 24px;
        }

        @media (max-width: 576px) {
            .btn-floating-donate {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
            }
            .btn-floating-donate i {
                font-size: 20px;
            }
        }
    </style>

    <!-- Use asset() helper for Laravel public files -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}"><img
                    src="{{ asset('img/maana_logo.png') }}" alt="Manna Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('/')) active @endif"
                            href="{{ url('/') }}">{{ __('messages.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('/about')) active @endif"
                            href="{{ url('/about') }}">{{ __('messages.about') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('blog*')) active @endif"
                            href="{{ route('blog.index') }}">{{ __('messages.blog') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('/contact')) active @endif"
                            href="{{ url('/contact') }}">{{ __('messages.contact') }}</a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link @if (Request::is('login')) active @endif"
                                href="{{ route('login') }}">{{ __('messages.login') }}</a>
                        </li>
                    @endguest
                    
                    @auth
                        @if (Auth::user()->role === 'donator')
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-primary @if (Request::is('admin/mydonations')) active @endif"
                                    href="{{ route('admin.donations.mydonations') }}">
                                    <i class="bi bi-person-circle"></i> {{ __('messages.my_donations') }}
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link fw-bold @if (Request::is('dashboard')) active @endif"
                                href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        @endif
                @endauth
                </ul>
                <div class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-translate"></i> {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang.switch', 'fr') }}">Français</a></li>
                    </ul>
                </div>
                <a href="{{ url('/get-involved') }}" class="btn btn-primary ms-lg-3">{{ __('messages.donate') }}</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main>
        @yield('content')
    </main>


    <!-- Footer -->
    <footer class="text-white py-5" style="background-color: #0070ba;">
        <div class="container">
            <div class="row">
                <!-- Column 1: About -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <img src="{{ asset('img/LOGO.png') }}" alt="Footer Logo" class="border-2">
                    <h5 class="fw-bold mb-3">{{ __('messages.about_manna') }}</h5>
                    <p class="small">{{ __('messages.footer_about_desc') }}</p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">{{ __('messages.quick_links') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}"
                                class="text-white text-decoration-none">{{ __('messages.home') }}</a></li>
                        <li class="mb-2"><a href="{{ url('/about') }}"
                                class="text-white text-decoration-none">{{ __('messages.about_us') }}</a></li>
                        <li class="mb-2"><a href="{{ url('/contact') }}"
                                class="text-white text-decoration-none">{{ __('messages.contact') }}</a></li>
                        <li class="mb-2"><a href="{{ url('/get-involved') }}"
                                class="text-white text-decoration-none">{{ __('messages.donate') }}</a>
                        </li>
                        <li class="mb-2"><a href="{{ url('/login') }}"
                                class="text-white text-decoration-none">{{ __('messages.login') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">{{ __('messages.contact_us') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt"></i> {{ __('messages.location') }}</li>
                        <li class="mb-2"><i class="bi bi-envelope"></i>initiativemanna@gmail.com</li>
                        <li><i class="bi bi-telephone"></i>+257 76 89 40 70/+1 (872) 810-5471</li>
                    </ul>
                </div>

                <!-- Column 4: Social Media -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">{{ __('messages.follow_us') }}</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-4 pt-3 border-top">
                <p class="mb-0 small">{{ __('messages.copyright') }}</p>
            </div>
        </div>
    </footer>

    <!-- Floating Donate Button -->
    <a href="{{ url('/get-involved') }}" class="btn btn-primary btn-floating-donate d-lg-none" title="{{ __('messages.donate') }}">
        <i class="bi bi-heart-fill"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
