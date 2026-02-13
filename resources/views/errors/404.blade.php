@extends('layouts.web')

@section('title', '404 - Page Not Found')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="text-center">
        <!-- Illustration/Icon -->
        <div class="mb-5 position-relative d-inline-block">
            <div class="position-absolute top-50 start-50 translate-middle bg-primary bg-opacity-10 rounded-circle" style="width: 200px; height: 200px; z-index: -1;"></div>
            <i data-lucide="map-pin-off" class="text-primary opacity-25" style="width: 120px; height: 120px;"></i>
            <div class="h1 fw-black text-primary display-1 mb-0 mt-n4" style="font-size: 8rem; letter-spacing: -5px; line-height: 1;">404</div>
        </div>

        <!-- Text Content -->
        <h2 class="fw-bold text-dark mb-3">Oops! You've strayed too far.</h2>
        <p class="text-muted fs-5 mb-5 mx-auto" style="max-width: 500px;">
            The page you are looking for doesn't exist or has been moved. 
            Don't worry, even the best explorers get lost sometimes.
        </p>

        <!-- Action Buttons -->
        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center">
                <i data-lucide="home" class="me-2" style="width: 20px; height: 20px;"></i>
                Back to Safety
            </a>
            <a href="{{ url('/contact') }}" class="btn btn-outline-secondary btn-lg px-4 py-3 rounded-pill fw-bold d-flex align-items-center justify-content-center">
                <i data-lucide="help-circle" class="me-2" style="width: 20px; height: 20px;"></i>
                Need Help?
            </a>
        </div>
    </div>
</div>

<style>
    .fw-black { font-weight: 900; }
    .mt-n4 { margin-top: -1.5rem; }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    
    [data-lucide="map-pin-off"] {
        animation: float 6s ease-in-out infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection
