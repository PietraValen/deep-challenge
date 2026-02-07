@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <!-- Profile Information Section -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold text-primary mb-0">Profile Information</h5>
                    <p class="text-muted small">Update your account's profile information and email address.</p>
                </div>
                <div class="card-body p-4">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-2" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Avatar Upload & Preview -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <label for="profile_image" class="cursor-pointer" style="cursor: pointer;"
                                    title="Click to upload new avatar">
                                    <img id="avatar-preview"
                                        src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                        alt="Profile Avatar" class="rounded-circle border border-3 border-light shadow-sm"
                                        style="width: 120px; height: 120px; object-fit: cover;">

                                    <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1 d-flex align-items-center justify-content-center shadow-sm"
                                        style="width: 32px; height: 32px;">
                                        <i class="bi bi-camera-fill small"></i>
                                    </div>
                                </label>
                                <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/*"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="small text-muted mt-2">Click image to change</div>
                            @error('profile_image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label small fw-bold text-muted">Name</label>
                            <input type="text"
                                class="form-control bg-light border-0 rounded-3 @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus
                                autocomplete="name">
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-muted">Email</label>
                            <input type="email"
                                class="form-control bg-light border-0 rounded-3 @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}" required
                                autocomplete="username">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-muted">
                                        {{ __('Your email address is unverified.') }}
                                        <button form="send-verification"
                                            class="btn btn-link p-0 m-0 align-baseline small fw-bold text-primary text-decoration-none">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 text-success small fw-bold">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary rounded-3 shadow-sm fw-semibold">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Password Section -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold text-primary mb-0">Update Password</h5>
                    <p class="text-muted small">Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="{{ route('password.update') }}" class="mt-2">
                        @csrf
                        @method('put')

                        <!-- Current Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label small fw-bold text-muted">Current
                                Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light rounded-start-3 ms-1 ps-3">
                                    <i class="bi bi-key text-muted"></i>
                                </span>
                                <input type="password"
                                    class="form-control bg-light border-0 rounded-end-3 @error('current_password', 'updatePassword') is-invalid @enderror"
                                    id="current_password" name="current_password" autocomplete="current-password">
                            </div>
                            @error('current_password', 'updatePassword')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold text-muted">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light rounded-start-3 ms-1 ps-3">
                                    <i class="bi bi-lock text-muted"></i>
                                </span>
                                <input type="password"
                                    class="form-control bg-light border-0 rounded-end-3 @error('password', 'updatePassword') is-invalid @enderror"
                                    id="password" name="password" autocomplete="new-password">
                            </div>
                            @error('password', 'updatePassword')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label small fw-bold text-muted">Confirm
                                Password</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light rounded-start-3 ms-1 ps-3">
                                    <i class="bi bi-shield-check text-muted"></i>
                                </span>
                                <input type="password"
                                    class="form-control bg-light border-0 rounded-end-3 @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                            </div>
                            @error('password_confirmation', 'updatePassword')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-dark rounded-3 shadow-sm fw-semibold">Update
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function () {
                    var output = document.getElementById('avatar-preview');
                    output.src = reader.result;
                };
                if (event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            }
        </script>
    @endpush
@endsection