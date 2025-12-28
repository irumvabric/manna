@extends('layouts.admin')

@section('title', 'Beneficiaries Management')
@section('page-title', 'Beneficiaries')

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
            <h4 class="fw-bold text-dark mb-1">Beneficiaries Management</h4>
            <p class="text-muted mb-0">Track and manage scholarship recipients</p>
        </div>
        <div>
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addBeneficiaryModal">
                <i data-lucide="user-plus" style="width: 18px; height: 18px;"></i>
                <span>Add Beneficiary</span>
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
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by name, email, department, faculty..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">Filter</button>
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
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">Beneficiary</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Academic Info</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Total Amount</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Tuition</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">Actions</th>
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
                                            <h5 class="fw-bold">Edit Beneficiary</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $beneficiary->name }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $beneficiary->email }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Age</label>
                                                    <input type="number" name="age" class="form-control" value="{{ $beneficiary->age }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" name="phone" class="form-control" value="{{ $beneficiary->phone }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" name="address" class="form-control" value="{{ $beneficiary->address }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Faculty</label>
                                                    <input type="text" name="faculte" class="form-control" value="{{ $beneficiary->faculte }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Department</label>
                                                    <input type="text" name="departement" class="form-control" value="{{ $beneficiary->departement }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Amount Received</label>
                                                    <input type="number" step="0.01" name="amount_received" class="form-control" value="{{ $beneficiary->amount_received }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tuition Cost</label>
                                                    <input type="number" step="0.01" name="tuition" class="form-control" value="{{ $beneficiary->tuition }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
                                        <h5 class="fw-bold">Delete Beneficiary?</h5>
                                        <p class="text-muted small">This action will permanently remove this record.</p>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-light flex-grow-1" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.beneficiaries.destroy', $beneficiary->id) }}" method="POST" class="flex-grow-1">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">No beneficiaries found.</td>
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
                    <h5 class="fw-bold">Add New Beneficiary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" placeholder="Age">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Faculty</label>
                            <input type="text" name="faculte" class="form-control" placeholder="Faculty">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" name="departement" class="form-control" placeholder="Department">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Amount Received</label>
                            <input type="number" step="0.01" name="amount_received" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tuition Cost</label>
                            <input type="number" step="0.01" name="tuition" class="form-control" placeholder="0.00" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Beneficiary</button>
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
