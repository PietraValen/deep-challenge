@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary mb-2">Welcome Back</h3>
                        <p class="text-muted small">Enter your credentials to access your account</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label small text-muted fw-bold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text border-end-0 bg-light rounded-start-3">
                                    <i class="bi bi-envelope text-muted"></i>
                                </span>
                                <input id="email" type="email"
                                    class="form-control border-start-0 ps-0 bg-light rounded-end-3 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="name@example.com">
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
                                    name="password" required autocomplete="current-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">
                                    Remember me
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="small text-decoration-none text-primary fw-semibold"
                                    href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit"
                                class="btn btn-primary py-2 rounded-3 fw-semibold shadow-sm text-uppercase"
                                style="letter-spacing: 0.5px;">
                                Sign In
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center small text-muted">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-bold">Sign up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection