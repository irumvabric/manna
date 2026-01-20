@extends('layouts.web')

@section('title', 'Register')

@section('content')
<section class="py-5 bg-light" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-5">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary">Create Account</h3>
                            <p class="text-muted small">Join us to get started</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label small text-muted fw-bold">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control py-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label small text-muted fw-bold">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label small text-muted fw-bold">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control py-2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label small text-muted fw-bold">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password" class="form-control py-2" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary py-2 fw-bold text-uppercase small">
                                    {{ __('Register') }}
                                </button>
                            </div>

                            <div class="text-center">
                                <a class="text-decoration-none small text-muted hover-primary" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
