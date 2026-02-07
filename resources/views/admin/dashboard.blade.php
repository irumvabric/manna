@extends('layouts.admin')

@section('title', __('messages.admin_dashboard'))
@section('page-title', __('messages.dashboard'))

@section('content')
<div class="d-flex flex-column gap-4">
    
    <!-- Header Section -->
    <div>
        <h4 class="fw-bold text-dark mb-1">{{ __('messages.admin_dashboard') }}</h4>
        <p class="text-muted mb-0">{{ __('messages.overview_activity') }}</p>
    </div>

    <!-- Alert for Pending -->
    @if($pendingApprovalCount > 0)
    <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center gap-3 mb-0" role="alert" style="background-color: #fffbeb; color: #b45309;">
        <i data-lucide="alert-circle" class="flex-shrink-0"></i>
        <div>
            <strong>{{ __('messages.pending_approvals') }}</strong>
            <div class="small">{{ __('messages.pending_approvals_msg', ['count' => $pendingApprovalCount]) }}</div>
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="row g-4">
        <!-- Total Received -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.total_received') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ session('currency_symbol', '$') }}{{ number_format($totalReceived, 2) }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="dollar-sign" class="text-success" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <div class="text-muted small">{{ __('messages.approved_donations') }}</div>
                </div>
            </div>
        </div>

        <!-- Pending Approval -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.pending_approvals') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $pendingApprovalCount }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="clock" class="text-warning" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <div class="text-muted small">{{ __('messages.awaiting_review') }}</div>
                </div>
            </div>
        </div>

        <!-- Late Donations -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.late_donations') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $lateDonationsCount }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="alert-octagon" class="text-danger" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <div class="text-muted small">{{ __('messages.overdue_payments') }}</div>
                </div>
            </div>
        </div>

        <!-- Active Donators -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">{{ __('messages.active_donators') }}</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $activeDonatorsCount }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="users" class="text-primary" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <div class="text-muted small">{{ __('messages.current_contributors') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4">
        <!-- Donations Per Period -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">{{ __('messages.donations_per_period') }}</h5>
                    <div style="height: 300px;">
                        <canvas id="donationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">{{ __('messages.status_distribution') }}</h5>
                    <div style="height: 300px; position: relative;">
                         <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Donations -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-4">{{ __('messages.recent_donations') }}</h5>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-3">{{ __('messages.donator') }}</th>
                            <th class="border-0 text-muted small fw-semibold">{{ __('messages.amount') }}</th>
                            <th class="border-0 text-muted small fw-semibold">{{ __('messages.period') }}</th>
                            <th class="border-0 text-muted small fw-semibold">{{ __('messages.status') }}</th>
                            <th class="border-0 text-muted small fw-semibold pe-3 text-end">{{ __('messages.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentDonations as $donation)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                                         style="width: 32px; height: 32px; background: #3b82f6; font-size: 14px;">
                                        {{ $donation->avatar }}
                                    </div>
                                    <div class="fw-medium text-dark">{{ $donation->donator_name }}</div>
                                </div>
                            </td>
                            <td class="fw-medium text-dark">${{ number_format($donation->amount) }}</td>
                            <td class="text-muted">{{ $donation->period }}</td>
                            <td>
                                @php
                                    $statusClass = match($donation->status) {
                                        'Approved' => 'bg-success text-success',
                                        'Pending' => 'bg-warning text-warning',
                                        'Late' => 'bg-danger text-danger',
                                        default => 'bg-secondary text-secondary'
                                    };
                                    $statusLabel = match($donation->status) {
                                        'Approved' => __('messages.approved'),
                                        'Pending' => __('messages.pending'),
                                        'Late' => __('messages.late'),
                                        default => $donation->status
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} bg-opacity-10 px-3 py-2 rounded-pill fw-medium" style="font-weight: 500;">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="text-end pe-3 text-muted">{{ $donation->date }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">{{ __('messages.no_recent_donations') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ChartJS CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Donations per Period Chart
        const ctxDonations = document.getElementById('donationsChart').getContext('2d');
        new Chart(ctxDonations, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: "{{ __('messages.donations') }}",
                    data: @json($monthlyData),
                    backgroundColor: '#3b82f6',
                    borderRadius: 4,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            color: '#e2e8f0'
                        },
                        ticks: { display: true }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

        // Status Distribution Chart
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: @json($statusDistribution['labels']),
                datasets: [{
                    data: @json($statusDistribution['data']),
                    backgroundColor: [
                        '#10b981', // Approved (Green)
                        '#f59e0b', // Pending (Yellow)
                        '#ef4444'  // Late (Red)
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 12 }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection