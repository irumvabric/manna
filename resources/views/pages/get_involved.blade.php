@extends('layouts.web')

@section('title', 'Donate — Manna Initiative')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Donation Form</h4>
                        <form action="{{ url('/donate_form') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Full name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    required>
                            </div>

                            {{-- <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                            </div> --}}

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Donation Amount</label>
                                <input type="number" step="0.01" name="target_amount" value="{{ old('target_amount') }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Frequency</label>
                                <select name="periodicity" class="form-select">
                                    <option value="one_time">One-time</option>
                                    <option value="yearly" {{ old('periodicity') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    <option value="semester" {{ old('periodicity') == 'semester' ? 'selected' : '' }}>
                                        Semester</option>
                                    <option value="monthly" {{ old('periodicity') == 'monthly' ? 'selected' : '' }}>
                                        Monthly</option>
                                </select>
                            </div>

                            {{-- <div class="mb-3">
                                <label class="form-label">Comments</label>
                                <textarea name="comments" class="form-control" rows="4">{{ old('comments') }}</textarea>
                            </div> --}}

                            <div class="mb-3">
                                <label class="form-label">Currency</label>
                                <select name="currency" class="form-select">
                                    <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                    <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                    <option value="BIF" {{ old('currency') == 'BIF' ? 'selected' : '' }}>BIF</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary">Submit Donation</button>
                                <a href="{{ asset('docs/donation_form.pdf') }}" class="btn btn-outline-secondary"
                                    download>Download PDF form</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
