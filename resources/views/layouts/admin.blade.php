<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Donation Management System')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root {
            --sidebar-width: 260px;
        }
        
        body {
            overflow-x: hidden;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            z-index: 1050;
            transition: transform 0.3s ease;
        }
        
        .sidebar.hide {
            transform: translateX(-100%);
        }
        
        .sidebar-header {
            height: 70px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
        }
        
        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sidebar-menu {
            padding: 1.5rem 1rem;
            overflow-y: auto;
            height: calc(100vh - 70px - 80px);
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin-bottom: 4px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
        }
        
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .menu-item.active {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        
        .menu-item i {
            width: 20px;
            height: 20px;
        }
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logout-btn {
            width: 100%;
            padding: 12px;
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 10px;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background-color: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.5);
            color: #ef4444;
        }
        
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 70px;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            z-index: 1040;
            transition: left 0.3s ease;
        }
        
        .topbar.full-width {
            left: 0;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: 70px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }
        
        .main-content.full-width {
            margin-left: 0;
        }
        
        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1045;
            display: none;
        }
        
        .overlay.show {
            display: block;
        }
        
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .topbar {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

@php
    /** @var \App\Models\User $currentUser */
    $currentPage = $currentPage ?? '';

    $donatorMenuItems = [
        ['id' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'layout-dashboard'],
        ['id' => 'make-donation', 'label' => 'Make a Donation', 'icon' => 'dollar-sign'],
        ['id' => 'history', 'label' => 'Donation History', 'icon' => 'history'],
        ['id' => 'notifications', 'label' => 'Notifications', 'icon' => 'bell'],
    ];

    $adminMenuItems = [
        ['id' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'layout-dashboard'],
        ['id' => 'admin.donators.index', 'label' => 'Donator Management', 'icon' => 'users'],
        ['id' => 'admin.donations.index', 'label' => 'Donations Management', 'icon' => 'heart-handshake'],
        ['id' => 'admin.reports.index', 'label' => 'Reports & Analytics', 'icon' => 'bar-chart-3'],
        ['id' => 'admin.settings', 'label' => 'Settings', 'icon' => 'settings'],
    ];

    $menuItems = $currentUser->role === 'admin' ? $adminMenuItems : $donatorMenuItems;
@endphp

<!-- Sidebar -->
<aside id="sidebar" class="sidebar">
    <div class="sidebar-header d-flex align-items-center justify-content-center">
        <a href="#" class="sidebar-brand">
            <div class="brand-icon">
                <i data-lucide="heart"></i>
            </div>
            <h5 class="mb-0 fw-bold">Manna</h5>
        </a>
    </div>

    <nav class="sidebar-menu">
        @foreach ($menuItems as $item)
            <a href="{{ route($item['id']) }}"
               class="menu-item {{ request()->routeIs($item['id']) ? 'active' : '' }}">
                <i data-lucide="{{ $item['icon'] }}"></i>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn logout-btn d-flex align-items-center justify-content-center gap-2">
                <i data-lucide="log-out" style="width: 18px; height: 18px;"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- Top Navigation Bar -->
<nav id="topbar" class="topbar">
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center">
            <div class="col">
                <button id="menuToggle" class="btn btn-light d-lg-none">
                    <i data-lucide="menu"></i>
                </button>
                <h5 class="mb-0 d-none d-md-inline-block ms-3">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-light position-relative">
                        <i data-lucide="bell"></i>
                        <span class="notification-badge"></span>
                    </button>
                    
                    <div class="d-none d-md-flex align-items-center gap-3 ps-3 border-start">
                        <div class="text-end">
                            <div class="fw-semibold small">{{ $currentUser->name }}</div>
                            <div class="text-muted" style="font-size: 12px;">{{ ucfirst($currentUser->role) }}</div>
                        </div>
                        <div class="user-avatar">
                            {{ substr($currentUser->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Overlay -->
<div id="overlay" class="overlay"></div>

<!-- Main Content -->
<main id="mainContent" class="main-content">
    @yield('content')
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    lucide.createIcons();

    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const topbar = document.getElementById('topbar');
    const mainContent = document.getElementById('mainContent');

    menuToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    });
</script>

</body>
</html>