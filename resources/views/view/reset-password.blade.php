@extends('layouts.main')

@section('content')
<div class="login-container min-vh-100 d-flex justify-content-center align-items-center py-4">
    <div class="card shadow-lg p-4 p-md-5 border-0 rounded-4 animate__animated animate__fadeInDown login-card">
        <div class="text-center mb-4">
            <div class="logo-container mb-3 animate__animated animate__bounceIn">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-shield-lock text-white" viewBox="0 0 16 16">
                    <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                    <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"/>
                </svg>
            </div>
            <h2 class="mb-2 fw-bold text-white fs-3 fs-md-2">Reset Password</h2>
            <p class="text-light mb-0 opacity-75">Enter your new password</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form method="POST" action="{{ route('user.password.update') }}" class="needs-validation" novalidate>
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3 form-floating">
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror rounded-4 shadow-sm input-glass" 
                    id="email" 
                    name="email" 
                    value="{{ $email ?? old('email') }}" 
                    required 
                    autofocus
                    placeholder="name@example.com"
                >
                <label for="email" class="fw-semibold text-light">Email address</label>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-floating">
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror rounded-4 shadow-sm input-glass" 
                    id="password" 
                    name="password" 
                    required
                    placeholder="New Password"
                >
                <label for="password" class="fw-semibold text-light">New Password</label>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 form-floating">
                <input 
                    type="password" 
                    class="form-control rounded-4 shadow-sm input-glass" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required
                    placeholder="Confirm New Password"
                >
                <label for="password_confirmation" class="fw-semibold text-light">Confirm New Password</label>
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-glow rounded-4 fw-bold py-3">
                    <span class="btn-text">Reset Password</span>
                    <span class="btn-spinner d-none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Resetting...
                    </span>
                </button>
            </div>

            <div class="text-center">
                <a href="{{ route('user.login') }}" class="link-light text-decoration-underline opacity-75">Back to Login</a>
            </div>
        </form>
    </div>
</div>

<style>
    /* Use the same CSS styles as the login page */
</style>

<script>
    // Use the same JavaScript as the login page
</script>
@endsection