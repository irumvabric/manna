@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="d-flex flex-column gap-4">
    
    <!-- Header Section -->
    <div>
        <h4 class="fw-bold text-dark mb-1">Admin Dashboard</h4>
        <p class="text-muted mb-0">Overview of donation system performance and activity</p>
    </div>

    <!-- Alert for Pending -->
    @if($pendingApprovalCount > 0)
    <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center gap-3 mb-0" role="alert" style="background-color: #fffbeb; color: #b45309;">
        <i data-lucide="alert-circle" class="flex-shrink-0"></i>
        <div>
            <strong>Pending Approvals</strong>
            <div class="small">You have {{ $pendingApprovalCount }} donation(s) awaiting approval. Please review them in the Donation Management section.</div>
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
                            <div class="text-muted small mb-1">Total Received</div>
                            <div class="h4 mb-0 fw-bold text-dark">${{ number_format($totalReceived, 2) }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="dollar-sign" class="text-success" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <div class="text-muted small">Approved donations</div>
                </div>
            </div>
        </div>

        <!-- Pending Approval -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Pending Approval</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $pendingApprovalCount }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="clock" class="text-warning" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <div class="text-muted small">Awaiting review</div>
                </div>
            </div>
        </div>

        <!-- Late Donations -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Late Donations</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $lateDonationsCount }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="alert-octagon" class="text-danger" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <div class="text-muted small">Overdue payments</div>
                </div>
            </div>
        </div>

        <!-- Active Donators -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Active Donators</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $activeDonatorsCount }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="users" class="text-primary" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                    <div class="text-muted small">Current contributors</div>
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
                    <h5 class="card-title fw-bold mb-4">Donations per Period</h5>
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
                    <h5 class="card-title fw-bold mb-4">Donation Status Distribution</h5>
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
            <h5 class="card-title fw-bold mb-4">Recent Donations</h5>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-3">Donator</th>
                            <th class="border-0 text-muted small fw-semibold">Amount</th>
                            <th class="border-0 text-muted small fw-semibold">Period</th>
                            <th class="border-0 text-muted small fw-semibold">Status</th>
                            <th class="border-0 text-muted small fw-semibold pe-3 text-end">Date</th>
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
                                @endphp
                                <span class="badge {{ $statusClass }} bg-opacity-10 px-3 py-2 rounded-pill fw-medium" style="font-weight: 500;">
                                    {{ $donation->status }}
                                </span>
                            </td>
                            <td class="text-end pe-3 text-muted">{{ $donation->date }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No recent donations found.</td>
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
                    label: 'Donations',
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