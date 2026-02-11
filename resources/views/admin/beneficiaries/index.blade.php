@extends('layouts.admin')

@section('title', __('messages.beneficiary_management'))
@section('page-title', __('messages.beneficiary_management'))

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
            <h4 class="fw-bold text-dark mb-1">{{ __('messages.beneficiary_management') }}</h4>
            <p class="text-muted mb-0">{{ __('messages.track_manage_beneficiaries') }}</p>
        </div>
        <div>
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addBeneficiaryModal">
                <i data-lucide="user-plus" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.add_beneficiary') }}</span>
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.beneficiaries.index') }}" method="GET" class="row g-3">
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

    <!-- Beneficiaries Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">{{ __('messages.user') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.academic_info') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.amount_received') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.tuition_cost') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beneficiaries as $beneficiary)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                                         style="width: 40px; height: 40px; background: #8b5cf6; font-size: 16px;">
                                        {{ substr($beneficiary->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium text-dark">{{ $beneficiary->name }}</div>
                                        <div class="small text-muted">{{ $beneficiary->email ?? 'No email' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small text-dark">{{ $beneficiary->faculte }}</div>
                                <div class="small text-muted">{{ $beneficiary->departement }}</div>
                            </td>
                            <td class="fw-medium text-dark">
                                {{ number_format($beneficiary->amount_received, 2) }} <small class="text-muted">BIF</small>
                            </td>
                            <td class="fw-medium text-dark">
                                {{ number_format($beneficiary->tuition, 2) }} <small class="text-muted">BIF</small>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.beneficiaries.expenses.index', $beneficiary->id) }}" class="btn btn-sm btn-light-info border-0" title="Expenses">
                                        <i data-lucide="receipt" style="width: 16px; height: 16px;"></i>
                                    </a>
                                    <button class="btn btn-sm btn-light-primary border-0" data-bs-toggle="modal" data-bs-target="#editBeneficiaryModal{{ $beneficiary->id }}">
                                        <i data-lucide="edit-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteBeneficiaryModal{{ $beneficiary->id }}">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editBeneficiaryModal{{ $beneficiary->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('admin.beneficiaries.update', $beneficiary->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="fw-bold">{{ __('messages.edit_beneficiary') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.full_name') }}</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $beneficiary->name }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.email') }}</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $beneficiary->email }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">{{ __('messages.age') }}</label>
                                                    <input type="number" name="age" class="form-control" value="{{ $beneficiary->age }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">{{ __('messages.phone_number') }}</label>
                                                    <input type="text" name="phone" class="form-control" value="{{ $beneficiary->phone }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">{{ __('messages.address') }}</label>
                                                    <input type="text" name="address" class="form-control" value="{{ $beneficiary->address }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.faculty') }}</label>
                                                    <input type="text" name="faculte" class="form-control" value="{{ $beneficiary->faculte }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.department') }}</label>
                                                    <input type="text" name="departement" class="form-control" value="{{ $beneficiary->departement }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.amount_received') }}</label>
                                                    <input type="number" step="0.01" name="amount_received" class="form-control" value="{{ $beneficiary->amount_received }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">{{ __('messages.tuition_cost') }}</label>
                                                    <input type="number" step="0.01" name="tuition" class="form-control" value="{{ $beneficiary->tuition }}" required>
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
                        <div class="modal fade" id="deleteBeneficiaryModal{{ $beneficiary->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-body text-center p-4">
                                        <div class="text-danger mb-3"><i data-lucide="alert-triangle" style="width: 48px; height: 48px;"></i></div>
                                        <h5 class="fw-bold">{{ __('messages.delete_beneficiary_confirm') }}</h5>
                                        <p class="text-muted small">{{ __('messages.delete_beneficiary_desc') }}</p>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-light flex-grow-1" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                            <form action="{{ route('admin.beneficiaries.destroy', $beneficiary->id) }}" method="POST" class="flex-grow-1">
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
                            <td colspan="5" class="text-center py-5 text-muted">{{ __('messages.no_beneficiaries_found') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($beneficiaries->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
                {{ $beneficiaries->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Beneficiary Modal -->
<div class="modal fade" id="addBeneficiaryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.beneficiaries.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">{{ __('messages.add_beneficiary') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.full_name') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('messages.enter_name') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.email') }}</label>
                            <input type="email" name="email" class="form-control" placeholder="{{ __('messages.enter_email') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">{{ __('messages.age') }}</label>
                            <input type="number" name="age" class="form-control" placeholder="{{ __('messages.age') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">{{ __('messages.phone_number') }}</label>
                            <input type="text" name="phone" class="form-control" placeholder="{{ __('messages.phone_number') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">{{ __('messages.address') }}</label>
                            <input type="text" name="address" class="form-control" placeholder="{{ __('messages.address') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.faculty') }}</label>
                            <input type="text" name="faculte" class="form-control" placeholder="{{ __('messages.faculty') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.department') }}</label>
                            <input type="text" name="departement" class="form-control" placeholder="{{ __('messages.department') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.amount_received') }}</label>
                            <input type="number" step="0.01" name="amount_received" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.tuition_cost') }}</label>
                            <input type="number" step="0.01" name="tuition" class="form-control" placeholder="0.00" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('messages.add_beneficiary') }}</button>
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
    .btn-light-info { background-color: rgba(6, 182, 212, 0.1); color: #0891b2; }
    .btn-light-info:hover { background-color: #0891b2; color: white; }
</style>
@endsection
