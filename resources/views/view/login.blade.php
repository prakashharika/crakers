@extends('layouts.main')

@section('content')

<div class="login-container min-vh-100 d-flex justify-content-center align-items-center py-4">
    
    {{-- Glassmorphic Card --}}
    <div class="card shadow-lg p-4 p-md-5 border-0 rounded-4 animate__animated animate__fadeInDown login-card">
        
        {{-- Logo/Header Section --}}
        
        <div class="text-center mb-4">
            <div class="logo-container mb-3 animate__animated animate__bounceIn">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-shield-lock text-white" viewBox="0 0 16 16">
                    <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                    <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"/>
                </svg>
            </div>
            <h2 class="mb-2 fw-bold text-white fs-3 fs-md-2">Welcome Back</h2>
            <p class="text-light mb-0 opacity-75">Login to continue to your dashboard</p>
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
        
        <form method="POST" action="{{ route('user.login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror rounded-pill shadow-sm" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror rounded-pill shadow-sm" 
                    id="password" 
                    name="password" 
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary rounded-pill shadow-sm fw-bold  animate__pulse animate__infinite">Login</button>
            </div>

            {{-- Links --}}
            <div class="text-center mt-3">
                <a href="{{ route('user.password.request') }}" class="text-decoration-none">Forgot Password?</a><br>
                <a href="{{ route('user.register') }}" class="text-decoration-none">Create an Account</a>
            </div>
        </form>
</div>
</div>

{{-- Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

{{-- Custom Styling --}}
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4e54c8, #8f94fb);
        --btn-gradient: linear-gradient(135deg, #6a11cb, #2575fc);
        --glass-bg: rgba(255, 255, 255, 0.08);
        --glass-border: rgba(255, 255, 255, 0.2);
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        overflow-x: hidden;
    }

    .login-container {
        background: var(--primary-gradient);
        position: relative;
        min-height: 100vh;
    }
    
    .login-container::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,218.7C672,224,768,160,864,138.7C960,117,1056,139,1152,149.3C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: center;
        animation: waveAnimation 15s linear infinite;
    }

    /* Glass effect card */
    .login-card {
        max-width: 440px;
        width: 100%;
        background: var(--glass-bg);
        backdrop-filter: blur(15px);
        border: 1px solid var(--glass-border);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        z-index: 1;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    }

    /* Logo animation */
    .logo-container {
        transition: transform 0.3s ease;
    }
    
    .logo-container:hover {
        transform: scale(1.1) rotate(5deg);
    }

    /* Glass inputs */
    .input-glass {
        background: rgba(255, 255, 255, 0.2) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: #fff !important;
        transition: all 0.3s ease;
    }
    
    .input-glass:focus {
        border-color: #fff !important;
        box-shadow: 0 0 15px rgba(255,255,255,0.4) !important;
        transform: translateY(-2px);
    }
    
    .input-glass::placeholder {
        color: rgba(255,255,255,0.7);
    }
    
    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label {
        color: #fff;
        opacity: 0.9;
    }

    /* Glowing Button */
    .btn-glow {
        background: var(--btn-gradient);
        color: #fff;
        padding: 12px;
        font-size: 1.1rem;
        border: none;
        box-shadow: 0 0 20px rgba(106,17,203,0.6);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .btn-glow::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }
    
    .btn-glow:hover {
        box-shadow: 0 0 30px rgba(37,117,252,0.8);
        transform: translateY(-3px);
    }
    
    .btn-glow:hover::before {
        left: 100%;
    }

    /* Form elements animation */
    .form-floating, .form-check, .d-grid {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    
    .form-floating:nth-child(1) { animation-delay: 0.2s; }
    .form-floating:nth-child(2) { animation-delay: 0.3s; }
    .form-check { animation-delay: 0.4s; }
    .d-grid { animation-delay: 0.5s; }
    .text-center { animation-delay: 0.6s; }

    /* Links */
    .link-light {
        transition: all 0.3s ease;
    }
    
    .link-light:hover {
        opacity: 1 !important;
        transform: translateY(-2px);
    }

    /* Checkbox styling */
    .form-check-input {
        background-color: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .form-check-input:checked {
        background-color: #6a11cb;
        border-color: #6a11cb;
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-card {
            margin: 0 20px;
            padding: 2rem;
        }
        
        .login-container::before {
            background-size: 180%;
            background-position: bottom;
        }
    }
    
    @media (max-width: 576px) {
        .login-card {
            margin: 0 15px;
            padding: 1.5rem;
        }
        
        h2 {
            font-size: 1.8rem !important;
        }
    }

    /* Animations */
    @keyframes waveAnimation {
        0% {
            background-position-x: 0%;
        }
        100% {
            background-position-x: 100%;
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

{{-- Form Validation & Animation Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    // Show loading state on valid form submission
                    event.preventDefault(); // Remove this line in production
                    const btn = form.querySelector('.btn-glow');
                    const btnText = btn.querySelector('.btn-text');
                    const btnSpinner = btn.querySelector('.btn-spinner');
                    
                    btnText.classList.add('d-none');
                    btnSpinner.classList.remove('d-none');
                    btn.disabled = true;
                    
                    // Simulate loading for demo (remove in production)
                    setTimeout(() => {
                        form.submit();
                    }, 1500);
                }
                
                form.classList.add('was-validated');
            }, false);
        });
        
        // Input focus animations
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    });
</script>

@endsection