@extends('layouts.admin')

@section('title', 'Donations Management')
@section('page-title', 'Donations')

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
            <h4 class="fw-bold text-dark mb-1">Donations Management</h4>
            <p class="text-muted mb-0">Track and manage incoming donations</p>
        </div>
        <div>
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#recordDonationModal">
                <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i>
                <span>Record Donation</span>
            </button>
        </div>
    </div>

    <!-- ... (Stats Cards and Filters remain identical, adding back for file integrity) ... -->
    <!-- Stats Cards -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Total Approved</div>
                            <div class="h4 mb-0 fw-bold text-dark">${{ number_format($totalApprovedAmount, 2) }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="check-circle" class="text-success" style="width: 20px; height: 20px;"></i>
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
                            <div class="text-muted small mb-1">Pending Amount</div>
                            <div class="h4 mb-0 fw-bold text-dark">${{ number_format($pendingAmount, 2) }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="clock" class="text-warning" style="width: 20px; height: 20px;"></i>
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
                            <div class="text-muted small mb-1">This Month</div>
                            <div class="h4 mb-0 fw-bold text-dark">${{ number_format($thisMonthAmount, 2) }}</div>
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
                            <div class="text-muted small mb-1">Today's Donations</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $todayCount }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="trending-up" class="text-primary" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.donations.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i data-lucide="search" style="width: 18px; height: 18px; color: #6c757d;"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search donator..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Status: All</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="payment_method" class="form-select">
                        <option value="">Method: All</option>
                        <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="card" {{ request('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                        <option value="mobile" {{ request('payment_method') == 'mobile' ? 'selected' : '' }}>Mobile</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted">From</span>
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Donations Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">Donator</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Amount</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Method</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Status</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Date</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="ps-4 py-3">
                                @if($donation->donator)
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                                         style="width: 36px; height: 36px; background: #64748b; font-size: 14px;">
                                        {{ substr($donation->donator->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium text-dark">{{ $donation->donator->name }} {{ $donation->donator->surname }}</div>
                                        <div class="small text-muted">{{ $donation->donator->email }}</div>
                                    </div>
                                </div>
                                @else
                                    <span class="text-muted fst-italic">Unknown Donator</span>
                                @endif
                            </td>
                            <td class="fw-medium text-dark">
                                {{ number_format($donation->amount, 2) }} <span class="text-muted small text-uppercase">{{ $donation->currency }}</span>
                            </td>
                            <td>
                                <span class="text-capitalize">{{ $donation->payment_method }}</span>
                            </td>
                            <td>
                                @php
                                    $statusClass = match($donation->status) {
                                        'approved' => 'bg-success text-success',
                                        'pending' => 'bg-warning text-warning',
                                        'rejected', 'late' => 'bg-danger text-danger',
                                        default => 'bg-light text-muted'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} bg-opacity-10 px-3 py-2 rounded-pill fw-medium">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                            <td class="text-muted">
                                {{ $donation->created_at->format('M d, Y') }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-vertical" style="width: 16px; height: 16px;"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                        @if($donation->status === 'pending')
                                        <li>
                                            <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 small text-success">
                                                    <i data-lucide="check" style="width: 14px; height: 14px;"></i> Approve
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.donations.update', $donation->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 small text-danger">
                                                    <i data-lucide="x" style="width: 14px; height: 14px;"></i> Reject
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                        <li>
                                            <form action="{{ route('admin.donations.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 small text-danger">
                                                    <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">No donations found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($donations->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
                {{ $donations->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Record Donation Modal -->
<div class="modal fade" id="recordDonationModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.donations.store-manual') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Record New Donation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Donator</label>
                        <select name="donator_id" class="form-select" required>
                            <option value="">Choose a donator...</option>
                            @foreach($donatorsList as $donator)
                                <option value="{{ $donator->id }}">{{ $donator->name }} {{ $donator->surname }} ({{ $donator->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Currency</label>
                            <select name="currency" class="form-select" required>
                                <option value="BIF">BIF</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="cash">Cash</option>
                            <option value="card">Bank/Card</option>
                            <option value="mobile">Mobile Money</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="approved">Approved</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Record Donation</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection