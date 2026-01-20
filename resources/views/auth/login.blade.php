@extends('layouts.web')

@section('title', __('messages.login'))

@section('content')
<section class="py-5 bg-light" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary">{{ __('messages.welcome_back') }}</h3>
                            <p class="text-muted small">{{ __('messages.sign_in_prompt') }}</p>
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4 small" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label small text-muted fw-bold">{{ __('messages.email') }}</label>
                                <input id="email" type="email" class="form-control py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label small text-muted fw-bold">{{ __('messages.password') }}</label>
                                <input id="password" type="password" class="form-control py-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label small text-muted" for="remember_me">{{ __('messages.remember_me') }}</label>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary py-2 fw-bold text-uppercase small">
                                    {{ __('messages.login') }}
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-center mb-4">
                                    <a class="text-decoration-none small text-muted hover-primary" href="{{ route('password.request') }}">
                                        {{ __('messages.forgot_password') }}
                                    </a>
                                </div>
                            @endif

                            <div class="text-center">
                                <p class="small text-muted mb-2">{{ __('messages.no_account_prompt') }}</p>
                                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none text-uppercase small">
                                    {{ __('messages.register') }}
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
