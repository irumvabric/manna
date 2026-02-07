@extends('layouts.admin')

@section('title', __('messages.user_management'))
@section('page-title', __('messages.user_management'))

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

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i data-lucide="alert-circle" style="width: 18px; height: 18px;"></i>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold text-dark mb-1">{{ __('messages.user_management') }}</h4>
            <p class="text-muted mb-0">{{ __('messages.manage_users_desc') }}</p>
        </div>
        <div>
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i data-lucide="plus" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.add_new_user') }}</span>
            </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">{{ __('messages.user') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.email') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.role') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.joined_date') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                                         style="width: 40px; height: 40px; background: #6366f1; font-size: 16px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium text-dark">{{ $user->name }}</div>
                                        <div class="small text-muted">ID: #{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small text-dark">{{ $user->email }}</div>
                            </td>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : ($user->role === 'blogger' ? 'bg-info' : 'bg-success') }} bg-opacity-10 {{ $user->role === 'admin' ? 'text-danger' : ($user->role === 'blogger' ? 'text-info' : 'text-success') }} px-3 py-2 rounded-pill fw-medium">
                                    {{ __('messages.' . $user->role) }}
                                </span>
                            </td>
                            <td class="text-muted">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-light-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-body text-center p-4">
                                        <div class="text-danger mb-3">
                                            <i data-lucide="alert-triangle" style="width: 48px; height: 48px;"></i>
                                        </div>
                                        <h5 class="fw-bold">{{ __('messages.delete_user_confirm') }}</h5>
                                        <p class="text-muted small">{{ __('messages.this_action_irreversible') }}</p>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-light flex-grow-1" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="flex-grow-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">{{ __('messages.delete', ['entity' => '']) }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">{{ __('messages.no_users_found') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($users->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">{{ __('messages.add_new_user') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.full_name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('messages.enter_name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.email') }}</label>
                        <input type="email" name="email" class="form-control" placeholder="{{ __('messages.enter_email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.role') }}</label>
                        <select name="role" class="form-select" required>
                            <option value="donator">{{ __('messages.donator') }}</option>
                            <option value="blogger">{{ __('messages.blogger') }}</option>
                            <option value="admin">{{ __('messages.admin') }}</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.password') }}</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('messages.create_user') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .btn-light-danger { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .btn-light-danger:hover { background-color: #ef4444; color: white; }
</style>
@endsection
