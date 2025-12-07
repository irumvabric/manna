<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Administration - Manna')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    @stack('styles')

    <style>
        /* Sidebar links */
        .admin-sidebar .nav-link {
            color: #333;
            transition: 0.2s;
            font-size: 0.95rem;
        }

        .admin-sidebar .nav-link:hover {
            background: #f1f1f1;
        }

        .admin-sidebar .nav-link.active {
            background: #0d6efd !important;
            color: #fff !important;
        }

        .admin-avatar {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Sidebar -->
    <div class="offcanvas-lg offcanvas-start bg-white admin-sidebar" tabindex="-1" id="adminSidebar">
        <div class="offcanvas-header border-bottom">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('img/icon.jpg') }}" alt="Logo"
                    style="width:40px;height:40px;border-radius:6px;object-fit:cover">
                <div>
                    <h5 class="mb-0">CL SKY Admin</h5>
                    <small class="text-muted">Administration</small>
                </div>
            </div>
            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body p-0">
            <nav class="nav flex-column fw-semibold">

                <a class="nav-link px-3 py-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-tachometer-alt me-2"></i> Dashboard
                </a>

                <a class="nav-link px-3 py-2 {{ request()->routeIs('admin.donators.*') ? 'active' : '' }}"
                    href="{{ route('admin.donators.index') }}">
                    <i class="fa fa-users me-2"></i> Donateurs
                </a>

                <a class="nav-link px-3 py-2 {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}"
                    href="{{ route('admin.donations.index') }}">
                    <i class="fa fa-hand-holding-heart me-2"></i> Donations
                </a>

                <hr class="my-2">

                <a class="nav-link px-3 py-2" href="{{ route('home') }}" target="_blank">
                    <i class="fa fa-globe me-2"></i> Voir le site
                </a>

                <form action="{{ route('home') }}" method="POST" class="px-3 mt-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100">
                        <i class="fa fa-sign-out-alt me-2"></i> Déconnexion
                    </button>
                </form>

            </nav>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="d-flex flex-column min-vh-100">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg bg-white border-bottom">
            <div class="container-fluid">
                <button class="btn btn-outline-primary d-lg-none me-2" data-bs-toggle="offcanvas"
                    data-bs-target="#adminSidebar">
                    <i class="fa fa-bars"></i>
                </button>

                <a class="navbar-brand d-none d-lg-inline" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('img/icon.jpg') }}" alt="logo"
                        style="width:34px;height:34px;border-radius:6px;object-fit:cover">
                    <span class="ms-2 fw-semibold">CL SKY Admin</span>
                </a>

                <div class="ms-auto">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('img/icon.jpg') }}" alt="User" class="admin-avatar">
                        <span class="ms-2 d-none d-md-inline">Admin</span>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid flex-grow-1 py-4">

            <div class="col-12 col-lg-10 offset-lg-2">

                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </div>
        </div>

        <footer class="bg-white border-top py-3">
            <div class="text-center text-muted small">&copy; 2025 CL SKY. Tous droits réservés.</div>
        </footer>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ====== EXTRA JS ADDED ====== -->
    <script>
        // Auto-dismiss alerts
        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(el => {
                    el.classList.add('fade');
                    el.classList.add('show');
                    el.style.transition = "opacity 0.5s";
                    el.style.opacity = "0";
                    setTimeout(() => el.remove(), 500);
                });
            }, 3000);
        });

        // Highlight correct nav link (fallback if routeIs fails)
        document.querySelectorAll('.admin-sidebar .nav-link').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
