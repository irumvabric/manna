@extends('layouts.admin')

@section('title', __('messages.manage_view', ['entity' => __('messages.donators')]))
@section('page-title', __('messages.donators'))

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
            <h4 class="fw-bold text-dark mb-1">{{ __('messages.manage_view', ['entity' => __('messages.donators')]) }}</h4>
            <p class="text-muted mb-0">{{ __('messages.manage_view', ['entity' => __('messages.donators')]) }}</p>
        </div>
        <div>
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addDonatorModal">
                <i data-lucide="plus" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.add_new', ['entity' => __('messages.donator')]) }}</span>
            </button>
        </div>
    </div>

    <!-- ... (Stats Cards and Filters remain the same, adding them back in the replacement block to ensure file integrity) ... -->
    <!-- Stats Cards -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.total', ['entity' => __('messages.donators')]) }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $totalDonators }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="users" class="text-primary" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.monthly') }} {{ __('messages.donators') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $monthlyDonators }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="calendar" class="text-info" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.yearly') }} {{ __('messages.donators') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $yearlyDonators }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-3" style="width: 40px; height: 40px; background-color: rgba(147, 51, 234, 0.1);">
                            <i data-lucide="calendar-check" class="text-purple" style="width: 20px; height: 20px; color: rgb(147, 51, 234);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.total_target_amount') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ number_format($totalTargetAmount, 2) }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="target" class="text-success" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.donators.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i data-lucide="search" style="width: 18px; height: 18px; color: #6c757d;"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="periodicity" class="form-select">
                        <option value="">{{ __('messages.all_periods') }}</option>
                        @foreach(App\Models\Donator::getPeriodicityOptions() as $value => $label)
                            <option value="{{ $value }}" {{ request('periodicity') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="currency" class="form-select">
                        <option value="">{{ __('messages.all_currencies') }}</option>
                        <option value="BIF" {{ request('currency') == 'BIF' ? 'selected' : '' }}>BIF</option>
                        <option value="USD" {{ request('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="EUR" {{ request('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">{{ __('messages.filter') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Donators Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">{{ __('messages.donator') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.contact') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.frequency') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.donation_amount') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.joined_date') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donators as $donator)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                                         style="width: 40px; height: 40px; background: #3b82f6; font-size: 16px;">
                                        {{ substr($donator->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium text-dark">{{ $donator->name }} {{ $donator->surname }}</div>
                                        <div class="small text-muted">ID: #{{ $donator->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="small text-dark mb-1">{{ $donator->email }}</div>
                                    <div class="small text-muted">{{ $donator->phone }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium">
                                    {{ $donator->periodicity_label }}
                                </span>
                            </td>
                            <td class="fw-medium text-dark">
                                {{ number_format($donator->target_amount, 2) }} <span class="text-muted small">{{ $donator->currency }}</span>
                            </td>
                            <td class="text-muted">
                                {{ $donator->created_at->format('M d, Y') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-light-primary border-0" data-bs-toggle="modal" data-bs-target="#editDonatorModal{{ $donator->id }}">
                                        <i data-lucide="edit-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteDonatorModal{{ $donator->id }}">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editDonatorModal{{ $donator->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.donators.update', $donator->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="fw-bold">{{ __('messages.edit', ['entity' => __('messages.donator')]) }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('messages.full_name') }}</label>
                                                <input type="text" name="name" class="form-control" value="{{ $donator->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('messages.email') }}</label>
                                                <input type="email" name="email" class="form-control" value="{{ $donator->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('messages.phone_number') }}</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $donator->phone }}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.target_amount') }}</label>
                                                    <input type="number" step="0.01" name="target_amount" class="form-control" value="{{ $donator->target_amount }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.currency') }}</label>
                                                    <select name="currency" class="form-select" required>
                                                        <option value="BIF" {{ $donator->currency == 'BIF' ? 'selected' : '' }}>BIF</option>
                                                        <option value="USD" {{ $donator->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                                        <option value="EUR" {{ $donator->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('messages.frequency') }}</label>
                                                <select name="periodicity" class="form-select" required>
                                                    @foreach(App\Models\Donator::getPeriodicityOptions() as $value => $label)
                                                        <option value="{{ $value }}" {{ $donator->periodicity == $value ? 'selected' : '' }}>{{ $label }}</option>
                                                    @endforeach
                                                </select>
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
                        <div class="modal fade" id="deleteDonatorModal{{ $donator->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-body text-center p-4">
                                        <div class="text-danger mb-3">
                                            <i data-lucide="alert-triangle" style="width: 48px; height: 48px;"></i>
                                        </div>
                                        <h5 class="fw-bold">{{ __('messages.confirm_delete_title', ['entity' => __('messages.donator')]) }}</h5>
                                        <p class="text-muted small">{{ __('messages.delete_confirm') }}</p>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-light flex-grow-1" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                            <form action="{{ route('admin.donators.destroy', $donator->id) }}" method="POST" class="flex-grow-1">
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
                            <td colspan="6" class="text-center py-5">{{ __('messages.no_records_found', ['entity' => __('messages.donators')]) }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($donators->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
                {{ $donators->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Donator Modal -->
<div class="modal fade" id="addDonatorModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.donators.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">{{ __('messages.add_new', ['entity' => __('messages.donator')]) }}</h5>
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
                        <label class="form-label">{{ __('messages.phone_number') }}</label>
                        <input type="text" name="phone" class="form-control" placeholder="+257 ...">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.target_amount') }}</label>
                            <input type="number" step="0.01" name="target_amount" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.currency') }}</label>
                            <select name="currency" class="form-select" required>
                                <option value="BIF">BIF</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.frequency') }}</label>
                        <select name="periodicity" class="form-select" required>
                            @foreach(App\Models\Donator::getPeriodicityOptions() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
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