@extends('layouts.web')

@section('title', $blog->title . ' | Manna Initiative')

@section('content')
    <!-- Blog Header -->
    <section class="py-5 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-decoration-none">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 30) }}</li>
                </ol>
            </nav>
            <h1 class="fw-bold text-dark mb-3">{{ $blog->title }}</h1>
            <div class="d-flex align-items-center gap-3 text-muted">
                <div class="d-flex align-items-center gap-1">
                    <i class="bi bi-calendar3"></i>
                    <span>{{ $blog->created_at->format('M d, Y') }}</span>
                </div>
                <span>•</span>
                <div class="d-flex align-items-center gap-1">
                    <i class="bi bi-person"></i>
                    <span>Admin</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    @if($blog->image)
                        <img src="{{ Storage::url($blog->image) }}" class="img-fluid rounded shadow-sm mb-5 w-100" alt="{{ $blog->title }}" style="max-height: 500px; object-fit: cover;">
                    @endif
                    
                    <div class="blog-content mb-5" style="font-size: 1.1rem; line-height: 1.8; color: #374151;">
                        {!! nl2br(e($blog->description)) !!}
                    </div>

                    <!-- Share section -->
                    <div class="border-top pt-4 mb-5">
                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold">Share this post:</span>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-twitter-x"></i></a>
                                <a href="#" class="btn btn-outline-secondary btn-sm rounded-circle" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px; z-index: 10;">
                        <!-- Recent Posts -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-4">Recent Posts</h5>
                                @foreach($recentBlogs as $recent)
                                <div class="d-flex gap-3 mb-4">
                                    <div class="flex-shrink-0">
                                        @if($recent->image)
                                            <img src="{{ Storage::url($recent->image) }}" class="rounded" style="width: 70px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 70px; height: 50px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold" style="font-size: 0.95rem;">
                                            <a href="{{ route('blog.show', $recent->slug) }}" class="text-dark text-decoration-none hover-primary">
                                                {{ Str::limit($recent->title, 50) }}
                                            </a>
                                        </h6>
                                        <div class="small text-muted">{{ $recent->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CTA Card -->
                        <div class="card border-0 shadow-sm bg-primary text-white">
                            <div class="card-body p-4 text-center">
                                <h5 class="fw-bold mb-3">Support Our Scholars</h5>
                                <p class="small mb-4">Your donation can help a student achieve their dreams. Contribute today.</p>
                                <a href="{{ url('/get-involved') }}" class="btn btn-light w-100 fw-bold">Donate Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .hover-primary:hover { color: #0070ba !important; }
        .blog-content p { margin-bottom: 1.5rem; }
    </style>
@endsection
