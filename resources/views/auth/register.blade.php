@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary mb-2">Create Account</h3>
                        <p class="text-muted small">Join us and start your journey today</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label small text-muted fw-bold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-light rounded-start-3">
                                    <i class="bi bi-person text-muted"></i>
                                </span>
                                <input id="name" type="text"
                                    class="form-control border-start-0 ps-0 bg-light rounded-end-3 @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe">
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label small text-muted fw-bold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-light rounded-start-3">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                <input id="email" type="email"
                                    class="form-control border-start-0 ps-0 bg-light rounded-end-3 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required placeholder="name@example.com">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label small text-muted fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-light rounded-start-3">
                                    <i class="bi bi-lock text-muted"></i>
                                </span>
                                <input id="password" type="password"
                                    class="form-control border-start-0 ps-0 bg-light rounded-end-3 @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label small text-muted fw-bold">Confirm
                                Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-light rounded-start-3">
                                    <i class="bi bi-shield-lock text-muted"></i>
                                </span>
                                <input id="password-confirm" type="password"
                                    class="form-control border-start-0 ps-0 bg-light rounded-end-3"
                                    name="password_confirmation" required placeholder="••••••••">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit"
                                class="btn btn-primary py-2 rounded-3 fw-semibold shadow-sm text-uppercase"
                                style="letter-spacing: 0.5px;">
                                Register
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center small text-muted">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-bold">Log in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection