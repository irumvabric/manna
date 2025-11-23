<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration - CLSKY')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('img/icon.jpg') }}" alt="Logo">
                    <h3>CL SKY Admin</h3>
                </div>
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.services.index') }}"
                            class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.annonces.index') }}"
                            class="{{ request()->routeIs('admin.annonces.*') ? 'active' : '' }}">
                            <i class="fas fa-bullhorn"></i>
                            <span>Annonces</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.membres.index') }}"
                            class="{{ request()->routeIs('admin.membres.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span>Équipe</span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('home') }}" target="_blank">
                            <i class="fas fa-globe"></i>
                            <span>Voir le site</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <header class="topbar">
                <button class="menu-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="topbar-right">
                    <div class="user-menu">
                        <img src="{{ asset('img/icon.jpg') }}" alt="User" class="user-avatar">
                        <span>Admin</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="content">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="admin-footer">
                <p>&copy; 2025 CL SKY. Tous droits réservés.</p>
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>
