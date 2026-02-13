@extends('layouts.admin')

@section('title', __('messages.blogger_dashboard'))
@section('page-title', __('messages.dashboard'))

@section('content')
<div class="d-flex flex-column gap-4">
    
    <!-- Header Section -->
    <div>
        <h4 class="fw-bold text-dark mb-1">{{ __('messages.blogger_dashboard') }}</h4>
        <p class="text-muted mb-0">{{ __('messages.create_manage_blogs') }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.my_blogs') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">--</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="file-text" class="text-primary" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-4">{{ __('messages.quick_actions') }}</h5>
            <div class="d-flex gap-3">
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                    <i data-lucide="plus-circle" class="me-2" style="width: 18px; height: 18px;"></i>
                    {{ __('messages.create_new_blog') }}
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">
                    <i data-lucide="list" class="me-2" style="width: 18px; height: 18px;"></i>
                    {{ __('messages.view_all_blogs') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
