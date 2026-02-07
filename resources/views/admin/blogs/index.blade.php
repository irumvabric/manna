@extends('layouts.admin')

@section('title', __('messages.blog_management'))
@section('page-title', __('messages.blog_management'))

@section('content')
<div class="d-flex flex-column gap-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i data-lucide="check-circle" style="width: 18px; height: 18px;"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold text-dark mb-1">{{ __('messages.blog_management') }}</h4>
            <p class="text-muted mb-0">{{ __('messages.create_manage_blogs') }}</p>
        </div>
        <div>
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                <i data-lucide="plus" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.add_new', ['entity' => '']) }}</span>
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.blogs.index') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i data-lucide="search" style="width: 18px; height: 18px; color: #6c757d;"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">{{ __('messages.filter') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Blogs Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">{{ __('messages.image') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.title_slug') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.status') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.date') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                        <tr>
                            <td class="ps-4 py-3">
                                @if($blog->image)
                                    <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="rounded shadow-sm" style="width: 60px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                        <i data-lucide="image" class="text-muted" style="width: 20px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-medium text-dark">{{ $blog->title }}</div>
                                <div class="small text-muted">{{ $blog->slug }}</div>
                            </td>
                            <td>
                                @if($blog->status)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-medium">{{ __('messages.published') }}</span>
                                @else
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-medium">{{ __('messages.draft') }}</span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ $blog->created_at->format('M d, Y') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-light-primary border-0" data-bs-toggle="modal" data-bs-target="#editBlogModal{{ $blog->id }}">
                                        <i data-lucide="edit-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteBlogModal{{ $blog->id }}">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editBlogModal{{ $blog->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="fw-bold">{{ __('messages.edit_blog') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('messages.title') }}</label>
                                                <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('messages.message') }}</label>
                                                <textarea name="description" class="form-control" rows="8" required>{{ $blog->description }}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.update_image') }}</label>
                                                    <input type="file" name="image" class="form-control">
                                                    @if($blog->image)
                                                        <div class="mt-2">
                                                            <small class="text-muted">{{ __('messages.current_image') }}:</small><br>
                                                            <img src="{{ Storage::url($blog->image) }}" class="rounded mt-1" style="width: 100px;">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.status') }}</label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="0" {{ !$blog->status ? 'selected' : '' }}>{{ __('messages.draft') }}</option>
                                                        <option value="1" {{ $blog->status ? 'selected' : '' }}>{{ __('messages.published') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                            <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteBlogModal{{ $blog->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-body text-center p-4">
                                        <div class="text-danger mb-3"><i data-lucide="alert-triangle" style="width: 48px; height: 48px;"></i></div>
                                        <h5 class="fw-bold">{{ __('messages.delete_blog_confirm') }}</h5>
                                        <p class="text-muted small">{{ __('messages.delete_blog_desc') }}</p>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-light flex-grow-1" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="flex-grow-1">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">{{ __('messages.delete', ['entity' => '']) }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No blog posts found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($blogs->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
                {{ $blogs->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Blog Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">{{ __('messages.create_blog') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.blog_title') }}</label>
                        <input type="text" name="title" class="form-control" placeholder="{{ __('messages.blog_title_placeholder') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.message') }}</label>
                        <textarea name="description" class="form-control" rows="8" placeholder="{{ __('messages.blog_content_placeholder') }}" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.featured_image') }}</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.status') }}</label>
                            <select name="status" class="form-select" required>
                                <option value="0">{{ __('messages.draft') }}</option>
                                <option value="1">{{ __('messages.published') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('messages.add_new', ['entity' => '']) }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .btn-light-primary { background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .btn-light-primary:hover { background-color: #3b82f6; color: white; }
    .btn-light-danger { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .btn-light-danger:hover { background-color: #ef4444; color: white; }
</style>
@endsection
