@extends('layouts.admin')

@section('title', __('messages.dashboard'))

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: calc(100vh - 200px);">
    <div class="text-center animate-fade-in">
        <div class="mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle p-4 mb-3" style="width: 100px; height: 100px;">
                <i data-lucide="hand-heart" style="width: 48px; height: 48px;"></i>
            </div>
        </div>
        
        <h1 class="display-4 fw-bold text-dark mb-3">
            {{ __('messages.welcome_back') }}, {{ auth()->user()->name }}!
        </h1>
        
        <p class="lead text-muted mb-5 mx-auto" style="max-width: 600px;">
            {{ __('messages.dashboard_welcome_message', ['app' => config('app.name', 'Manna')]) }}
        </p>
        
        <div class="d-flex gap-3 justify-content-center">
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.donations.index') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i data-lucide="heart-handshake" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.view_donations') }}</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill d-flex align-items-center gap-2">
                <i data-lucide="bar-chart-3" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.view_reports') }}</span>
            </a>
            @elseif(auth()->user()->role === 'blogger')
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i data-lucide="newspaper" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.blog_management') }}</span>
            </a>
            @else
            <a href="{{ route('admin.donations.mydonations') }}" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                <i data-lucide="heart-handshake" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.my_donations') }}</span>
            </a>
            @endif
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
</style>
@endsection