<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Donation Management System')</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="min-h-screen bg-gray-50">

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
        ['id' => 'admin.donations.index', 'label' => 'Donations Management', 'icon' => 'file-text'],
        ['id' => 'admin.reports.index', 'label' => 'Reports & Exports', 'icon' => 'file-text'],
        ['id' => 'admin.settings', 'label' => 'System Settings', 'icon' => 'settings'],
    ];

    $menuItems = $currentUser->role === 'admin' ? $adminMenuItems : $donatorMenuItems;
@endphp

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 bottom-0 w-64 bg-white shadow-lg z-30 -translate-x-full lg:translate-x-0 transition-transform duration-300">
    
    <!-- Logo/Brand -->
    <div class="h-16 flex items-center px-6 border-b border-gray-200">
        <h1 class="text-xl font-bold text-gray-800">Donation System</h1>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-3">
        @foreach ($menuItems as $item)
            <a href="{{ route($item['id']) }}"
               class="flex items-center gap-3 px-4 py-3 mb-1 rounded-lg text-sm font-medium transition-all
               {{ request()->routeIs($item['id'])
                    ? 'bg-blue-600 text-white shadow-md'
                    : 'text-gray-700 hover:bg-gray-100' }}">
                
                <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- User Profile Section -->
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                {{ substr($currentUser->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-medium text-gray-900 truncate">{{ $currentUser->name }}</div>
                <div class="text-xs text-gray-500 capitalize">{{ $currentUser->role }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- Mobile Toggle Button -->
<button id="menuToggle" class="lg:hidden fixed top-4 left-4 z-40 p-2 bg-white rounded-lg shadow-md hover:bg-gray-100">
    <i data-lucide="menu" class="w-6 h-6"></i>
</button>

<!-- Overlay (Mobile) -->
<div id="overlay" class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden"></div>

<!-- Main Content -->
<main class="lg:pl-64 min-h-screen">
    <div class="p-4 md:p-6 lg:p-8">
        @yield('content')
    </div>
</main>

<script>
    lucide.createIcons();

    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    menuToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>

</body>
</html>