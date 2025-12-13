@extends('layouts.admin')

@section('title', 'Donators Management')
@section('page-title', 'Donators')

@section('content')
<div class="d-flex flex-column gap-4">
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold text-dark mb-1">Donators Management</h4>
            <p class="text-muted mb-0">Manage and view all registered donators</p>
        </div>
        <div>
            <!-- Placeholder for "Add Donator" button if needed later -->
            <button class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
                <i data-lucide="plus" style="width: 18px; height: 18px;"></i>
                <span>Add Donator</span>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">
        <!-- Total Donators -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Total Donators</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $totalDonators }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="users" class="text-primary" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Donators -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Monthly Donators</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $monthlyDonators }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="calendar" class="text-info" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yearly Donators -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Yearly Donators</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ $yearlyDonators }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-purple bg-opacity-10 rounded-3" style="width: 40px; height: 40px; background-color: rgba(147, 51, 234, 0.1);">
                            <i data-lucide="calendar-check" class="text-purple" style="width: 20px; height: 20px; color: rgb(147, 51, 234);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Target Amount -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="text-muted small mb-1">Total Target Amount</div>
                            <div class="h4 mb-0 fw-bold text-dark">{{ number_format($totalTargetAmount, 2) }}</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-3" style="width: 40px; height: 40px;">
                            <i data-lucide="target" class="text-success" style="width: 20px; height: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.donators.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i data-lucide="search" style="width: 18px; height: 18px; color: #6c757d;"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search by name, email, phone..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="periodicity" class="form-select">
                        <option value="">All Periods</option>
                        <option value="1" {{ request('periodicity') == 1 ? 'selected' : '' }}>Monthly</option>
                        <option value="3" {{ request('periodicity') == 3 ? 'selected' : '' }}>Quarterly</option>
                        <option value="6" {{ request('periodicity') == 6 ? 'selected' : '' }}>Semiannually</option>
                        <option value="12" {{ request('periodicity') == 12 ? 'selected' : '' }}>Yearly</option>
                    </select>
                </div>
                <!-- Currency Filter (Optional) -->
                <div class="col-md-3">
                    <select name="currency" class="form-select">
                        <option value="">All Currencies</option>
                        <option value="BIF" {{ request('currency') == 'BIF' ? 'selected' : '' }}>BIF</option>
                        <option value="USD" {{ request('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                        <option value="EUR" {{ request('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">
                        Filter
                    </button>
                </div>
                @if(request()->anyFilled(['search', 'periodicity', 'currency']))
                <div class="col-12 mt-2">
                    <a href="{{ route('admin.donators.index') }}" class="text-decoration-none small text-muted">
                        <i data-lucide="x" style="width: 14px; height: 14px;"></i> Clear Filters
                    </a>
                </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Donators Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 text-muted small fw-semibold ps-4 py-3">Donator</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Contact</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Periodicity</th>
                            <th class="border-0 text-muted small fw-semibold py-3">Target Amount</th>
                            <th class="border-0 text-muted small fw-semibold py-3 text-end pe-4">Joined Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donators as $donator)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0 d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                                         style="width: 40px; height: 40px; background: #3b82f6; font-size: 16px;">
                                        {{ substr($donator->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium text-dark">{{ $donator->name }} {{ $donator->surname }}</div>
                                        <div class="small text-muted">ID: #{{ $donator->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <div class="small text-dark mb-1">
                                        <i data-lucide="mail" style="width: 14px; height: 14px; display: inline; margin-right: 4px;" class="text-muted"></i>
                                        {{ $donator->email }}
                                    </div>
                                    <div class="small text-muted">
                                        <i data-lucide="phone" style="width: 14px; height: 14px; display: inline; margin-right: 4px;"></i>
                                        {{ $donator->phone }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $periodMap = [
                                        1 => ['label' => 'Monthly', 'class' => 'bg-info text-info'],
                                        3 => ['label' => 'Quarterly', 'class' => 'bg-primary text-primary'],
                                        6 => ['label' => 'Semiannually', 'class' => 'bg-warning text-warning'],
                                        12 => ['label' => 'Yearly', 'class' => 'bg-purple text-purple', 'style' => 'color: rgb(147, 51, 234);']
                                    ];
                                    $p = $periodMap[$donator->periodicity] ?? ['label' => 'Unknown', 'class' => 'bg-secondary text-secondary'];
                                @endphp
                                <span class="badge {{ $p['class'] }} bg-opacity-10 px-3 py-2 rounded-pill fw-medium" 
                                      @if(isset($p['style'])) style="{{ $p['style'] }}" @endif>
                                    {{ $p['label'] }}
                                </span>
                            </td>
                            <td class="fw-medium text-dark">
                                {{ number_format($donator->target_amount, 2) }} <span class="text-muted small">{{ $donator->currency }}</span>
                            </td>
                            <td class="text-end pe-4 text-muted">
                                {{ $donator->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center text-muted">
                                    <i data-lucide="users" style="width: 48px; height: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
                                    <h6 class="fw-semibold mb-1">No donators found</h6>
                                    <p class="small mb-0">Try adjusting your filters or search terms.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($donators->hasPages())
            <div class="d-flex justify-content-center py-4 border-top">
                {{ $donators->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection