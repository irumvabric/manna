@extends('layouts.admin')

@section('title', 'Expenses: ' . $beneficiary->name)
@section('page-title', 'Beneficiary Expenses')

@section('content')
<div class="d-flex flex-column gap-4">
    <!-- Breadcrumb & Header -->
    <div class="d-flex flex-column gap-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.beneficiaries.index') }}" class="text-decoration-none">Beneficiaries</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $beneficiary->name }}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-dark mb-1">Expenses for {{ $beneficiary->name }}</h4>
                <p class="text-muted mb-0">Current Balance: <span class="fw-bold text-primary">{{ number_format($beneficiary->amount_received, 2) }} BIF</span></p>
            </div>
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i>
                <span>Record Expense</span>
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i data-lucide="check-circle" style="width: 18px; height: 18px;"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Expenses Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">Date</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Type</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Description</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Amount</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="text-dark">{{ \Carbon\Carbon::parse($expense->expense_date)->format('M d, Y') }}</div>
                            </td>
                            <td>
                                <span class="badge rounded-pill 
                                    @if($expense->type == 'stage') bg-info-subtle text-info
                                    @elseif($expense->type == 'deplacement') bg-warning-subtle text-warning
                                    @elseif($expense->type == 'inscription') bg-primary-subtle text-primary
                                    @elseif($expense->type == 'materiel') bg-success-subtle text-success
                                    @else bg-secondary-subtle text-secondary @endif px-3">
                                    {{ ucfirst($expense->type) }}
                                </span>
                            </td>
                            <td>
                                <div class="text-muted small text-truncate" style="max-width: 250px;">{{ $expense->description ?? 'No description' }}</div>
                            </td>
                            <td class="fw-bold text-danger">
                                -{{ number_format($expense->amount, 2) }} <small class="text-muted">BIF</small>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    @if($expense->attachment)
                                        <a href="{{ asset('storage/' . $expense->attachment) }}" target="_blank" class="btn btn-sm btn-light-info border-0" title="View Proof">
                                            <i data-lucide="file-text" style="width: 16px; height: 16px;"></i>
                                        </a>
                                    @endif
                                    <button class="btn btn-sm btn-light-primary border-0" data-bs-toggle="modal" data-bs-target="#editExpenseModal{{ $expense->id }}">
                                        <i data-lucide="edit-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteExpenseModal{{ $expense->id }}">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Expense Modal -->
                        <div class="modal fade" id="editExpenseModal{{ $expense->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.expenses.update', $expense->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="fw-bold">Edit Expense</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Type</label>
                                                <select name="type" class="form-select" required>
                                                    <option value="stage" {{ $expense->type == 'stage' ? 'selected' : '' }}>Stage</option>
                                                    <option value="deplacement" {{ $expense->type == 'deplacement' ? 'selected' : '' }}>Déplacement</option>
                                                    <option value="inscription" {{ $expense->type == 'inscription' ? 'selected' : '' }}>Inscription</option>
                                                    <option value="materiel" {{ $expense->type == 'materiel' ? 'selected' : '' }}>Matériel</option>
                                                    <option value="divers" {{ $expense->type == 'divers' ? 'selected' : '' }}>Divers</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Amount (BIF)</label>
                                                <input type="number" step="0.01" name="amount" class="form-control" value="{{ $expense->amount }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Date</label>
                                                <input type="date" name="expense_date" class="form-control" value="{{ $expense->expense_date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control" rows="2">{{ $expense->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Update Proof/Receipt (Optional)</label>
                                                <input type="file" name="attachment" class="form-control" accept=".pdf,image/*">
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

                        <!-- Delete Expense Modal -->
                        <div class="modal fade" id="deleteExpenseModal{{ $expense->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-body text-center p-4">
                                        <div class="text-danger mb-3"><i data-lucide="alert-triangle" style="width: 48px; height: 48px;"></i></div>
                                        <h5 class="fw-bold">Delete Expense?</h5>
                                        <p class="text-muted small">This will restore {{ number_format($expense->amount, 2) }} BIF to the beneficiary's balance.</p>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-light flex-grow-1" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST" class="flex-grow-1">
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
                            <td colspan="5" class="text-center py-5 text-muted">No expenses recorded for this beneficiary.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($expenses->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
                {{ $expenses->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.beneficiaries.expenses.store', $beneficiary->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Record New Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="stage">Stage</option>
                            <option value="deplacement">Déplacement</option>
                            <option value="inscription" selected>Inscription</option>
                            <option value="materiel">Matériel</option>
                            <option value="divers">Divers</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount (BIF)</label>
                        <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="expense_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Briefly describe the expense..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Proof/Receipt (Optional)</label>
                        <input type="file" name="attachment" class="form-control" accept=".pdf,image/*">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary shadow-sm px-4">Save Expense</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .bg-info-subtle { background-color: rgba(6, 182, 212, 0.1); }
    .bg-warning-subtle { background-color: rgba(245, 158, 11, 0.1); }
    .bg-primary-subtle { background-color: rgba(59, 130, 246, 0.1); }
    .bg-success-subtle { background-color: rgba(34, 197, 94, 0.1); }
    .bg-secondary-subtle { background-color: rgba(107, 114, 128, 0.1); }
    
    .btn-light-info { background-color: rgba(6, 182, 212, 0.1); color: #0891b2; }
    .btn-light-info:hover { background-color: #0891b2; color: white; }
    .btn-light-primary { background-color: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .btn-light-primary:hover { background-color: #3b82f6; color: white; }
    .btn-light-danger { background-color: rgba(239, 68, 68, 0.1); color: #ef4444; }
    .btn-light-danger:hover { background-color: #ef4444; color: white; }
</style>
@endsection
