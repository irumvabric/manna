<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Maana Initiative | Home')</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
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
    </style>

    <!-- Use asset() helper for Laravel public files -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}"><img
                    src="{{ asset('img/maana_logo.png') }}" alt="Maana Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @if (Request::is('/')) active @endif"
                            href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                    </li>
                </ul>
                <a href="{{ url('/get-involved') }}" class="btn btn-primary ms-lg-3">Donate Now</a>
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
                    <h5 class="fw-bold mb-3">About Maana</h5>
                    <p class="small">Maana Initiative is dedicated to empowering university students through education
                        support, mentorship, and community engagement.</p>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}"
                                class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ url('/about') }}" class="text-white text-decoration-none">About
                                Us</a></li>
                        <li class="mb-2"><a href="{{ url('/contact') }}"
                                class="text-white text-decoration-none">Contact</a></li>
                        <li><a href="{{ url('/get-involved') }}" class="text-white text-decoration-none">Donate</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt"></i> Bujumbura,Burundi</li>
                        <li class="mb-2"><i class="bi bi-envelope"></i>initiativemanna@gmail.com</li>
                        <li><i class="bi bi-telephone"></i>+257 76 89 40 70</li>
                    </ul>
                </div>

                <!-- Column 4: Social Media -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin fs-5"></i></a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-4 pt-3 border-top">
                <p class="mb-0 small">&copy; 2025 Maana Initiative. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
