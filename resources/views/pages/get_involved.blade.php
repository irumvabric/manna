@extends('layouts.web')

@section('title', 'Get Involved — Manna Initiative')

@section('content')
    
    <!-- Donation Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
                        <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                            <h3 class="fw-bold text-dark mb-0">Make a Donation</h3>
                            <p class="text-muted small">Choose how you want to support</p>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <form action="{{ url('/donate_form') }}" method="POST" id="donationForm">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-person"></i></span>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control bg-light border-0" placeholder="John Doe" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-envelope"></i></span>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control bg-light border-0" placeholder="john@example.com" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0"><i class="bi bi-telephone"></i></span>
                                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control bg-light border-0" placeholder="+257 ...">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold">Currency</label>
                                        <select name="currency" class="form-select bg-light border-0">
                                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                            <option value="BIF" {{ old('currency') == 'BIF' ? 'selected' : '' }}>BIF (FBu)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Donation Amount</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-primary text-white border-0" id="currencySymbol">$</span>
                                        <input type="number" step="0.01" name="target_amount" id="donationAmount" value="{{ old('target_amount', 50) }}" class="form-control border-primary border-2 text-primary fw-bold" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Frequency</label>
                                    <div class="row g-2">
                                        <div class="col-6 col-sm-3">
                                            <input type="radio" class="btn-check" name="periodicity" id="freq_once" value="one_time" checked>
                                            <label class="btn btn-outline-secondary w-100 py-2 border-0 bg-light" for="freq_once">One-time</label>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <input type="radio" class="btn-check" name="periodicity" id="freq_monthly" value="monthly">
                                            <label class="btn btn-outline-secondary w-100 py-2 border-0 bg-light" for="freq_monthly">Monthly</label>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <input type="radio" class="btn-check" name="periodicity" id="freq_semester" value="semester">
                                            <label class="btn btn-outline-secondary w-100 py-2 border-0 bg-light" for="freq_semester">Semester</label>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <input type="radio" class="btn-check" name="periodicity" id="freq_yearly" value="yearly">
                                            <label class="btn btn-outline-secondary w-100 py-2 border-0 bg-light" for="freq_yearly">Yearly</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-3 pt-3">
                                    <button type="submit" class="btn btn-primary btn-lg fw-bold py-3 shadow-sm rounded-pill">Complete Donation</button>
                                    <div class="text-center">
                                         <a href="{{ asset('docs/donation_form.pdf') }}" class="text-muted small text-decoration-none" download>
                                            <i class="bi bi-file-earmark-pdf me-1"></i> Or download and fill the PDF form
                                         </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Volunteer Section -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container py-4">
            <h2 class="fw-bold mb-3">Other Ways to Help</h2>
            <p class="lead mb-4 mx-auto" style="max-width: 600px; opacity: 0.8;">
                Can't give financially? You can still make a difference by sharing your time, skills, or spreading the word about Manna Initiative.
            </p>
            <div class="row g-4 justify-content-center mt-2">
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-people me-2"></i>Mentorship</h5>
                    <p class="small opacity-75">Guide a student in their professional or academic journey.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-share me-2"></i>Advocacy</h5>
                    <p class="small opacity-75">Tell your friends and community about our mission.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-megaphone me-2"></i>Volunteering</h5>
                    <p class="small opacity-75">Help us organize events and community outreach.</p>
                </div>
            </div>
            <a href="{{ url('/contact') }}" class="btn btn-outline-light px-5 py-2 mt-5 rounded-pill">Contact Us to Volunteer</a>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountBtns = document.querySelectorAll('.amount-btn');
            const amountInput = document.getElementById('donationAmount');
            const currencySelect = document.querySelector('select[name="currency"]');
            const currencySymbol = document.getElementById('currencySymbol');

            // Amount button handling
            amountBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    amountBtns.forEach(b => b.classList.remove('active', 'btn-primary'));
                    amountBtns.forEach(b => b.classList.add('btn-outline-primary'));
                    
                    this.classList.remove('btn-outline-primary');
                    this.classList.add('active', 'btn-primary');
                    
                    amountInput.value = this.dataset.amount;
                });
            });

            // Currency symbol sync
            const symbols = { 'USD': '$', 'EUR': '€', 'BIF': 'FBu' };
            currencySelect.addEventListener('change', function() {
                currencySymbol.textContent = symbols[this.value] || '$';
            });

            // Input handling to sync buttons
            amountInput.addEventListener('input', function() {
                amountBtns.forEach(b => b.classList.remove('active', 'btn-primary'));
                amountBtns.forEach(b => b.classList.add('btn-outline-primary'));
            });
        });
    </script>
    
    <style>
        .amount-btn { min-width: 70px; border-radius: 12px; font-weight: 600; padding: 10px 20px; border: 2px solid #0070ba; color: #0070ba; }
        .amount-btn:hover { background-color: #0070ba; color: white; }
        .amount-btn.active { background-color: #0070ba; color: white; border-color: #0070ba; }
        .btn-check:checked + label { background-color: #0070ba !important; color: white !important; font-weight: 600; }
        .form-control:focus, .form-select:focus { box-shadow: none; border-color: #0070ba; }
        .input-group-text { border: none; }
    </style>
@endsection
