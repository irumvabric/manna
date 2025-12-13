@extends('layouts.admin')

@section('title', 'Reports & Exports')
@section('page-title', 'Reports')

@section('content')
<div class="d-flex flex-column gap-4">
    
    <!-- Header Section -->
    <div>
        <h4 class="fw-bold text-dark mb-1">Reports & Exports</h4>
        <p class="text-muted mb-0">Filter, view and export donation records</p>
    </div>

    <!-- Filters Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-3 text-muted fw-medium">
                <i data-lucide="filter" style="width: 18px; height: 18px;"></i>
                <span>Filters</span>
            </div>
            
            <form action="{{ route('admin.reports.index') }}" method="GET">
                <div class="row g-3">
                    <!-- Period (Periodicity) -->
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Period</label>
                        <select name="period" class="form-select bg-light border-0">
                            <option value="">All Periods</option>
                            <option value="1" {{ request('period') == 1 ? 'selected' : '' }}>Monthly</option>
                            <option value="3" {{ request('period') == 3 ? 'selected' : '' }}>Quarterly</option>
                            <option value="6" {{ request('period') == 6 ? 'selected' : '' }}>Semiannually</option>
                            <option value="12" {{ request('period') == 12 ? 'selected' : '' }}>Yearly</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Status</label>
                        <select name="status" class="form-select bg-light border-0">
                            <option value="">All Statuses</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <!-- Donator Name -->
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Donator Name</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control bg-light border-0" 
                                   placeholder="Search by name..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-light bg-light border-0 text-muted">
                                <i data-lucide="search" style="width: 18px; height: 18px;"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary & Actions -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div class="d-flex gap-5">
                <div>
                    <div class="text-muted small mb-1">Total Records</div>
                    <div class="h5 fw-bold text-dark mb-0">{{ $totalRecords }}</div>
                </div>
                <div>
                    <div class="text-muted small mb-1">Total Amount</div>
                    <div class="h5 fw-bold text-dark mb-0">${{ number_format($totalAmount, 2) }}</div>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <a href="{{ route('admin.reports.export', ['type' => 'excel'] + request()->all()) }}" class="btn btn-success text-white d-flex align-items-center gap-2 px-4 shadow-sm" style="background-color: #10b981; border: none;">
                    <i data-lucide="file-spreadsheet" style="width: 18px; height: 18px;"></i>
                    <span>Excel</span>
                </a>
                <a href="{{ route('admin.reports.export', ['type' => 'pdf'] + request()->all()) }}" class="btn btn-danger text-white d-flex align-items-center gap-2 px-4 shadow-sm" style="background-color: #ef4444; border: none;">
                    <i data-lucide="file-text" style="width: 18px; height: 18px;"></i>
                    <span>PDF</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">Donator</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Email</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Amount</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Period</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-center">Status</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="ps-4 py-3 fw-medium text-dark">
                                {{ $donation->donator->name ?? 'Unknown' }}
                            </td>
                            <td class="text-muted small">
                                {{ $donation->donator->email ?? '-' }}
                            </td>
                            <td class="fw-bold text-dark">
                                ${{ number_format($donation->amount) }}
                            </td>
                            <td class="text-muted small">
                                @php
                                    $periodMap = [1 => 'Monthly', 3 => 'Quarterly', 6 => 'Semiannually', 12 => 'Yearly'];
                                    $period = $donation->donator->periodicity ?? 1;
                                @endphp
                                {{ $periodMap[$period] ?? 'Monthly' }}
                            </td>
                            <td class="text-center">
                                @php
                                    $statusConfig = match($donation->status) {
                                        'approved' => ['class' => 'text-success border-success', 'bg' => 'bg-success'],
                                        'pending' => ['class' => 'text-warning border-warning', 'bg' => 'bg-warning'],
                                        'late' => ['class' => 'text-danger border-danger', 'bg' => 'bg-danger'],
                                        default => ['class' => 'text-secondary border-secondary', 'bg' => 'bg-secondary']
                                    };
                                @endphp
                                <span class="badge {{ $statusConfig['bg'] }} bg-opacity-10 {{ $statusConfig['class'] }} border px-3 py-2 rounded-pill fw-medium header-status" 
                                      style="min-width: 80px; border-width: 1px !important; background-color: rgba(var(--bs-{{ str_replace('bg-', '', $statusConfig['bg']) }}-rgb), 0.1) !important;">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                            <td class="text-end pe-4 text-muted small">
                                {{ $donation->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No records found matching your filters.</td>
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
@endsection