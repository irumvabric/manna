@extends('layouts.guest')

@section('title', 'Contact Us')

@section('content')

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold text-primary mb-4">Contact Us</h2>
                    <p>We’d love to hear from you! Whether you want to partner, volunteer, or donate, reach out and we’ll
                        respond as soon as possible.</p>
                    <ul class="list-unstyled mt-4">
                        <li><strong>Email:</strong> initiativemanna@gmail.com</li>
                        <li><strong>Phone:</strong> +257 76 89 40 70</li>
                        <li><strong>Location:</strong> Bujumbura, Burundi</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <!-- The form action typically points to a Laravel route for handling submissions -->
                    <form class="shadow p-4 bg-white rounded" method="POST">
                        {{-- <form class="shadow p-4 bg-white rounded" method="POST" action="{{ route('contact.submit') }}"> --}}
                        @csrf <!-- CSRF protection token required for Laravel forms -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Your name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="you@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="4" placeholder="Your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
