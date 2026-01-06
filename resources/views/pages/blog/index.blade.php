@extends('layouts.web')

@section('title', 'Our Blog | Manna Initiative')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 text-center bg-light">
        <div class="container">
            <h1 class="fw-bold text-primary mb-3">Our Blog</h1>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Stay updated with the latest news, stories, and insights from Manna Initiative and our community of scholars.
            </p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        @if($blog->image)
                            <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 220px; object-fit: cover;">
                        @else
                            <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 220px;">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2">{{ $blog->created_at->format('M d, Y') }}</div>
                            <h5 class="card-title fw-bold mb-3">
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-dark text-decoration-none hover-primary">
                                    {{ $blog->title }}
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-4">
                                {{ Str::limit(strip_tags($blog->description), 120) }}
                            </p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">Read More</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted mb-3"><i class="bi bi-journal-x" style="font-size: 3rem;"></i></div>
                    <h4>No blog posts found</h4>
                    <p>Check back later for more updates.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>

    <style>
        .hover-primary:hover { color: #0070ba !important; }
        .card { transition: transform 0.3s ease; }
        .card:hover { transform: translateY(-5px); }
    </style>
@endsection
