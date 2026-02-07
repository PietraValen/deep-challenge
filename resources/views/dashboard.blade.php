@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm-soft border-0 rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="bg-primary bg-gradient text-white p-5">
                        <div class="d-flex align-items-center gap-4">
                            <div class="position-relative">
                                @if(Auth::user()->profile_image)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile"
                                        class="rounded-circle border border-4 border-white shadow-sm" width="100" height="100"
                                        style="object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center shadow-sm"
                                        style="width: 100px; height: 100px; font-size: 2.5rem; border: 4px solid rgba(255,255,255,0.2);">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h2 class="fw-bold mb-1">Welcome back, {{ Auth::user()->name }}!</h2>
                                <p class="mb-0 text-white-50">It's great to see you again. Here's what's happening with your
                                    account.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-light p-3 rounded-circle text-primary">
                            <i class="bi bi-person-lines-fill fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Profile Status</h5>
                    </div>
                    <p class="text-muted small">Your profile information serves as your digital identity. Keep it updated to
                        ensure accuracy.</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary w-100 rounded-3">Manage Profile</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-light p-3 rounded-circle text-success">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Security</h5>
                    </div>
                    <p class="text-muted small">Your account is secured with a password. make sure to update it regularly
                        for better safety.</p>
                    <button class="btn btn-outline-success w-100 rounded-3" disabled>Secure</button>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-light p-3 rounded-circle text-info">
                            <i class="bi bi-activity fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Activity</h5>
                    </div>
                    <p class="text-muted small">Check your recent login activity and session history to monitor your account
                        usage.</p>
                    <button class="btn btn-outline-info w-100 rounded-3" disabled>View Logs</button>
                </div>
            </div>
        </div>
    </div>
@endsection