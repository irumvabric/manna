@extends('layouts.admin')

@section('title', __('messages.reports_exports'))
@section('page-title', __('messages.reports'))

@section('content')
<div class="d-flex flex-column gap-4">
    
    <!-- Header Section -->
    <div>
        <h4 class="fw-bold text-dark mb-1">{{ __('messages.reports_exports') }}</h4>
        <p class="text-muted mb-0">{{ __('messages.filter_view_export') }}</p>
    </div>

    <!-- Filters Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-3 text-muted fw-medium">
                <i data-lucide="filter" style="width: 18px; height: 18px;"></i>
                <span>{{ __('messages.filter') }}</span>
            </div>
            
            <form action="{{ route('admin.reports.index') }}" method="GET">
                <div class="row g-3">
                    <!-- Period (Periodicity) -->
                    <div class="col-md-4">
                        <label class="form-label small text-muted">{{ __('messages.period') }}</label>
                        <select name="period" class="form-select bg-light border-0">
                            <option value="">{{ __('messages.all_periods') }}</option>
                            <option value="1" {{ request('period') == 1 ? 'selected' : '' }}>{{ __('messages.monthly') }}</option>
                            <option value="3" {{ request('period') == 3 ? 'selected' : '' }}>{{ __('messages.quarterly') }}</option>
                            <option value="6" {{ request('period') == 6 ? 'selected' : '' }}>{{ __('messages.semiannually') }}</option>
                            <option value="12" {{ request('period') == 12 ? 'selected' : '' }}>{{ __('messages.yearly') }}</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <label class="form-label small text-muted">{{ __('messages.status') }}</label>
                        <select name="status" class="form-select bg-light border-0">
                            <option value="">{{ __('messages.all_statuses') }}</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>{{ __('messages.approved') }}</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                            <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>{{ __('messages.late') }}</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>{{ __('messages.rejected') }}</option>
                        </select>
                    </div>

                    <!-- Donator Name -->
                    <div class="col-md-4">
                        <label class="form-label small text-muted">{{ __('messages.donator') }}</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control bg-light border-0" 
                                   placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('search') }}">
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
            <div class="d-flex flex-wrap gap-4 gap-md-5">
                <div>
                    <div class="text-muted small mb-1">{{ __('messages.total_records') }}</div>
                    <div class="h5 fw-bold text-dark mb-0">{{ $totalRecords }}</div>
                </div>
                @foreach($totalAmounts as $currency => $amount)
                <div>
                    <div class="text-muted small mb-1">{{ __('messages.total_amount') }} ({{ strtoupper($currency) }})</div>
                    <div class="h5 fw-bold text-dark mb-0">
                        {{ number_format($amount, 2) }} <span class="text-muted small text-uppercase">{{ $currency }}</span>
                    </div>
                </div>
                @endforeach
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
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">{{ __('messages.donator') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.email') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.amount') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3">{{ __('messages.period') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-center">{{ __('messages.status') }}</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">{{ __('messages.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="ps-4 py-3 fw-medium text-dark">
                                {{ $donation->donator->name ?? __('messages.unknown') }}
                            </td>
                            <td class="text-muted small">
                                {{ $donation->donator->email ?? '-' }}
                            </td>
                            <td class="fw-bold text-dark">
                                {{ number_format($donation->amount, 2) }} <span class="text-muted small text-uppercase">{{ $donation->currency ?? 'USD' }}</span>
                            </td>
                            <td class="text-muted small">
                                @php
                                    $periodMap = [
                                        1 => __('messages.monthly'),
                                        3 => __('messages.quarterly'),
                                        6 => __('messages.semiannually'),
                                        12 => __('messages.yearly')
                                    ];
                                    $period = $donation->donator->periodicity ?? 1;
                                @endphp
                                {{ $periodMap[$period] ?? __('messages.monthly') }}
                            </td>
                            <td class="text-center">
                                @php
                                    $statusConfig = match($donation->status) {
                                        'approved' => ['class' => 'text-success border-success', 'bg' => 'bg-success', 'label' => __('messages.approved')],
                                        'pending' => ['class' => 'text-warning border-warning', 'bg' => 'bg-warning', 'label' => __('messages.pending')],
                                        'late' => ['class' => 'text-danger border-danger', 'bg' => 'bg-danger', 'label' => __('messages.late')],
                                        'rejected' => ['class' => 'text-danger border-danger', 'bg' => 'bg-danger', 'label' => __('messages.rejected')],
                                        default => ['class' => 'text-secondary border-secondary', 'bg' => 'bg-secondary', 'label' => $donation->status]
                                    };
                                @endphp
                                <span class="badge {{ $statusConfig['bg'] }} bg-opacity-10 {{ $statusConfig['class'] }} border px-3 py-2 rounded-pill fw-medium header-status" 
                                      style="min-width: 80px; border-width: 1px !important; background-color: rgba(var(--bs-{{ str_replace('bg-', '', $statusConfig['bg']) }}-rgb), 0.1) !important;">
                                    {{ $statusConfig['label'] }}
                                </span>
                            </td>
                            <td class="text-end pe-4 text-muted small">
                                {{ $donation->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">{{ __('messages.no_records_matching') }}</td>
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