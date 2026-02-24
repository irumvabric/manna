@extends('layouts.web')

@section('title', __('messages.get_involved') . ' — Manna Initiative')

@section('content')
    
    <!-- Get Involved / Donation Section -->
    <section class="py-5">
        <div class="container overflow-hidden" style="max-height: 85vh;">
            <div class="container px-3" style="max-height: 80vh; overflow-y: auto; overflow-x: hidden;">
                <div class="row g-4 align-items-center">
                    <!-- Left Column: Info (Like Contact Page) -->
                    <div class="col-md-6">
                        <h2 class="fw-bold text-primary mb-4">{{ __('messages.make_donation') }}</h2>
                        <p class="lead text-muted">{{ __('messages.choose_how_to_support') }}</p>
                        <p>{{ __('messages.donation_impact_description', ['default' => 'Your contribution directly supports our mission to empower lives and build sustainable futures for those in need.']) }}</p>
                        
                        <div class="mt-4">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="bi bi-check2-circle text-primary me-2"></i>
                                    <strong>{{ __('messages.transparency') }}</strong>: {{ __('messages.transparency_desc', ['default' => '100% of your donation goes to the cause.']) }}
                                </li>
                                <!-- <li class="mb-3">
                                    <i class="bi bi-shield-check text-primary me-2"></i>
                                    <strong>{{ __('messages.security') }}</strong>: {{ __('messages.security_desc', ['default' => 'Secure encrypted payment processing.']) }}
                                </li> -->
                            </ul>
                        </div>

                        <div class="mt-4 pt-2">
                            <a href="{{ asset('docs/donation_form.pdf') }}" class="btn btn-outline-primary rounded-pill px-4" download>
                                <i class="bi bi-file-earmark-pdf me-1"></i> {{ __('messages.download_pdf_form') }}
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Form (Styled Like Contact Page) -->
                    <div class="col-md-6">
                        @if (session('success'))
                            <div class="alert alert-success border-0 shadow-sm mb-3">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm mb-3">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('/donate_form') }}" method="POST" id="donationForm" class="shadow p-4 bg-white rounded border-top border-primary border-4">
                            @csrf
                            
                            <!-- Personal Info Row -->
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">{{ __('messages.full_name') }}</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="{{ __('messages.name_placeholder') }}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">{{ __('messages.email') }}</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="{{ __('messages.email_placeholder') }}" required>
                                </div>
                            </div>

                            <!-- Phone & Currency Row -->
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">{{ __('messages.phone') }}</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+257 ...">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-bold">{{ __('messages.currency') }}</label>
                                    <select name="currency" class="form-select bg-light border-0">
                                        <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                        <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                        <option value="BIF" {{ old('currency') == 'BIF' ? 'selected' : '' }}>BIF (FBu)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Amount Row -->
                            <div class="mb-3">
                                <label class="form-label small fw-bold">{{ __('messages.donation_amount') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary text-white border-0 py-2 small" id="currencySymbol">BIF</span>
                                    <input type="number" step="0.01" name="target_amount" id="donationAmount" value="{{ old('target_amount', 50) }}" class="form-control border-primary border-2 text-primary fw-bold" required>
                                </div>
                            </div>
<!-- Frequency Row -->
<div class="mb-4">
    <label class="form-label small fw-bold">
        {{ __('messages.frequency') }}
    </label>

    <div class="row g-2">

        <div class="col-6">
            <input type="radio"
                   class="btn-check"
                   name="periodicity"
                   id="freq_once"
                   value="0"
                   {{ old('periodicity', 0) == 0 ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary w-100 py-2 border-0 bg-light small"
                   for="freq_once">
                {{ __('messages.one_time') }}
            </label>
        </div>

        <div class="col-6">
            <input type="radio"
                   class="btn-check"
                   name="periodicity"
                   id="freq_monthly"
                   value="1"
                   {{ old('periodicity') == 1 ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary w-100 py-2 border-0 bg-light small"
                   for="freq_monthly">
                {{ __('messages.monthly') }}
            </label>
        </div>

        <div class="col-6">
            <input type="radio"
                   class="btn-check"
                   name="periodicity"
                   id="freq_semester"
                   value="6"
                   {{ old('periodicity') == 6 ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary w-100 py-2 border-0 bg-light small"
                   for="freq_semester">
                {{ __('messages.semester') }}
            </label>
        </div>

        <div class="col-6">
            <input type="radio"
                   class="btn-check"
                   name="periodicity"
                   id="freq_yearly"
                   value="12"
                   {{ old('periodicity') == 12 ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary w-100 py-2 border-0 bg-light small"
                   for="freq_yearly">
                {{ __('messages.yearly') }}
            </label>
        </div>

    </div>
</div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold py-3 shadow-sm">{{ __('messages.complete_donation') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('donationAmount');
            const currencySelect = document.querySelector('select[name="currency"]');
            const currencySymbol = document.getElementById('currencySymbol');

            // Currency symbol sync
            const symbols = { 'USD': '$', 'EUR': '€', 'BIF': 'FBu' };
            currencySelect.addEventListener('change', function() {
                currencySymbol.textContent = symbols[this.value] || '$';
            });
        });
    </script>
    
    <style>
        .scrollable-container::-webkit-scrollbar { width: 5px; }
        .scrollable-container::-webkit-scrollbar-track { background: #f8f9fa; }
        .scrollable-container::-webkit-scrollbar-thumb { background: #0070ba; border-radius: 10px; }
        
        .btn-check:checked + label { background-color: #0070ba !important; color: white !important; font-weight: 600; }
        .form-control:focus, .form-select:focus { box-shadow: 0 0 0 0.25rem rgba(0, 112, 186, 0.15); border-color: #0070ba; }
        
        .input-group-text { border-top-left-radius: 8px; border-bottom-left-radius: 8px; font-weight: 700; }
        .form-control, .form-select { border-radius: 8px; padding: 0.6rem 1rem; }
        
        @media (max-height: 700px) {
            .scrollable-container { max-height: 75vh !important; }
        }
    </style>
@endsection
