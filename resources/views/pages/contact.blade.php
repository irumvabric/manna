@extends('layouts.web')

@section('title', __('messages.contact'))

@section('content')

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold text-primary mb-4">{{ __('messages.contact_us_title') }}</h2>
                    <p>{{ __('messages.contact_desc') }}</p>
                    <ul class="list-unstyled mt-4">
                        <li><strong>{{ __('messages.email') }}:</strong> initiativemanna@gmail.com</li>
                        <li><strong>{{ __('messages.phone') }}:</strong> +257 76 89 40 70/+1 (872) 810-5471</li>
                        <li><strong>{{ __('messages.location') }}:</strong> Bujumbura, Burundi</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success">{{ __('messages.success_message') }}</div>
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
                    <!-- The form action typically points to a Laravel route for handling submissions -->
                    <form class="shadow p-4 bg-white rounded" method="POST" action="{{ route('contact.submit') }}">
                        @csrf <!-- CSRF protection token required for Laravel forms -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.name') }}</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('messages.name') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email') }}</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="you@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">{{ __('messages.message') }}</label>
                            <textarea id="message" name="message" class="form-control" rows="4" placeholder="{{ __('messages.message') }}" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">{{ __('messages.send_message') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
