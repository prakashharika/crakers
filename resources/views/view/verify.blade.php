@extends('layouts.main')

@section('content')
<div class="login-container min-vh-100 d-flex justify-content-center align-items-center py-4">
    <div class="card shadow-lg p-4 p-md-5 border-0 rounded-4 animate__animated animate__fadeInDown login-card">
        <h3 class="mb-3 text-primary">Check Your Email 📩</h3>
        <p>We’ve sent a verification link to your email address. Please click the link to verify your account.</p>
        <p class="text-muted">Didn’t receive the email? <a href="{{ route('mail.verify') }}">Resend</a></p>
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
    . {
        background: rgba(255, 255, 255, 0.2) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: #fff !important;
        transition: all 0.3s ease;
    }
    
    .:focus {
        border-color: #fff !important;
        box-shadow: 0 0 15px rgba(255,255,255,0.4) !important;
        transform: translateY(-2px);
    }
    
    .::placeholder {
        color: rgba(255,255,255,0.7);
    }
    
    .>.form-control:focus~label,
    .>.form-control:not(:placeholder-shown)~label {
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
    ., .form-check, .d-grid {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    
    .:nth-child(1) { animation-delay: 0.2s; }
    .:nth-child(2) { animation-delay: 0.3s; }
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
@endsection
