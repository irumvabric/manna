@extends('layouts.admin')

@section('title', __('messages.donator_dashboard'))
@section('page-title', __('messages.dashboard'))

@section('content')
<div class="d-flex flex-column gap-4">
    
    <!-- Header Section -->
    <div>
        <h4 class="fw-bold text-dark mb-1">{{ __('messages.donator_dashboard') }}</h4>
        <p class="text-muted mb-0">{{ __('messages.welcome_back') }}, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">
        <!-- Total Donated -->
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.total_donated') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $currencySymbol }}{{ number_format($totalDonated, 2) }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="heart" class="text-success" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Donations -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-bold mb-0">{{ __('messages.my_recent_donations') }}</h5>
                <a href="{{ route('admin.donations.mydonations') }}" class="btn btn-sm btn-link text-primary fw-medium">{{ __('messages.view_all') }}</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-3">{{ __('messages.amount') }}</th>
                            <th class="border-0 text-muted small fw-semibold">{{ __('messages.status') }}</th>
                            <th class="border-0 text-muted small fw-semibold text-end pe-3">{{ __('messages.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr>
                            <td class="ps-3 fw-medium text-dark">{{ $currencySymbol }}{{ number_format($donation->amount, 2) }}</td>
                            <td>
                                @php
                                    $statusClass = match($donation->status) {
                                        'Approved' => 'bg-success text-success',
                                        'Pending' => 'bg-warning text-warning',
                                        'Late' => 'bg-danger text-danger',
                                        default => 'bg-secondary text-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} bg-opacity-10 px-3 py-2 rounded-pill fw-medium">
                                    {{ __('messages.' . strtolower($donation->status)) }}
                                </span>
                            </td>
                            <td class="text-end pe-3 text-muted">{{ $donation->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">{{ __('messages.no_donations_yet') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
