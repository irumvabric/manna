@extends('layouts.admin')

@section('title', 'Donations Management')
@section('page-title', 'Donations')

@section('content')
<div class="d-flex flex-column gap-4">
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold text-dark mb-1">Donations Management</h4>
            <p class="text-muted mb-0">Track and manage incoming donations</p>
        </div>
        <div>
            <!-- Button to manually record a donation usually needed in admin panel -->
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
                <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i>
                <span>Record Donation</span>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">
        <!-- Total Approved Amount -->
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

        <!-- Pending Revenue -->
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

        <!-- This Month -->
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

        <!-- Today's Count -->
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

    <!-- Filters & Search -->
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
                    <button type="submit" class="btn btn-dark w-100">
                        Filter
                    </button>
                </div>
                @if(request()->anyFilled(['search', 'status', 'payment_method', 'date_from']))
                <div class="col-12 mt-2">
                    <a href="{{ route('admin.donations.index') }}" class="text-decoration-none small text-muted">
                        <i data-lucide="x" style="width: 14px; height: 14px;"></i> Clear Filters
                    </a>
                </div>
                @endif
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
                                        <div class="small text-muted">
                                            {{ $donation->donator->email }}
                                        </div>
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
                                <span class="d-flex align-items-center gap-2 text-dark">
                                    @if($donation->payment_method == 'card')
                                        <i data-lucide="credit-card" style="width: 16px; height: 16px;" class="text-muted"></i>
                                    @elseif($donation->payment_method == 'mobile')
                                        <i data-lucide="smartphone" style="width: 16px; height: 16px;" class="text-muted"></i>
                                    @else
                                        <i data-lucide="banknote" style="width: 16px; height: 16px;" class="text-muted"></i>
                                    @endif
                                    <span class="text-capitalize">{{ $donation->payment_method }}</span>
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusClass = match($donation->status) {
                                        'approved' => 'bg-success text-success',
                                        'pending' => 'bg-warning text-warning',
                                        'rejected' => 'bg-danger text-danger',
                                        'late' => 'bg-secondary text-secondary',
                                        default => 'bg-light text-muted'
                                    };
                                    $statusIcon = match($donation->status) {
                                        'approved' => 'check',
                                        'pending' => 'clock',
                                        'rejected' => 'x-circle',
                                        'late' => 'alert-circle',
                                        default => 'help-circle'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} bg-opacity-10 px-3 py-2 rounded-pill fw-medium d-inline-flex align-items-center gap-1">
                                    <i data-lucide="{{ $statusIcon }}" style="width: 12px; height: 12px;"></i>
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                            <td class="text-muted">
                                {{ $donation->created_at->format('M d, Y') }}
                                <div class="small" style="font-size: 11px;">{{ $donation->created_at->format('H:i A') }}</div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border-0" type="button" data-bs-toggle="dropdown">
                                        <i data-lucide="more-vertical" style="width: 16px; height: 16px;"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                        <li><a class="dropdown-item d-flex align-items-center gap-2 small" href="#"><i data-lucide="eye" style="width: 14px; height: 14px;"></i> View Details</a></li>
                                        @if($donation->status === 'pending')
                                        <li><a class="dropdown-item d-flex align-items-center gap-2 small text-success" href="#"><i data-lucide="check" style="width: 14px; height: 14px;"></i> Approve</a></li>
                                        <li><a class="dropdown-item d-flex align-items-center gap-2 small text-danger" href="#"><i data-lucide="x" style="width: 14px; height: 14px;"></i> Reject</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i data-lucide="heart-off" style="width: 48px; height: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                                    <h6 class="fw-semibold mb-1">No donations found</h6>
                                    <p class="small mb-0">Try adjusting your filters or search criteria.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($donations->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
                {{ $donations->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection