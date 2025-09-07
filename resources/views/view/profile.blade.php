@extends('layouts.main')

@section('content')

<div class="login-container min-vh-100 d-flex justify-content-center align-items-center py-4">
    <div class="card shadow-lg p-4 p-md-5 border-0 rounded-4 animate__animated animate__fadeInDown login-card" style="max-width: 600px; width: 100%;">
        <div class="text-center mb-4">
            <div class="logo-container mb-3 animate__animated animate__bounceIn">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle text-white" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
            </div>
            <h2 class="mb-2 fw-bold text-white fs-3 fs-md-2">Profile Settings</h2>
            <p class="text-light mb-0 opacity-75">Update your personal information</p>
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
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form method="POST" action="{{route('update.user.profile')}}" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf

            <div class="row">
         

                <!-- Name -->
                <div class="col-md-6 mb-3">
                    <div class="form">
                        <label for="name" class="fw-semibold text-light">Full Name</label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror " 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $user->name) }}" 
                            required
                            placeholder="Full Name"
                        >
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <div class="form">
                        <label for="email" class="fw-semibold text-light">Email Address</label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror " 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}" 
                            required
                            placeholder="Email Address"
                            disabled
                        >
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Phone -->
                <div class="col-md-6 mb-3">
                    <label for="phone" class="fw-semibold text-light">Phone Number</label>
                    <div class="form">
                        <input 
                            type="tel" 
                            class="form-control @error('phone') is-invalid @enderror " 
                            id="phone_number" 
                            name="phone_number" 
                            value="{{ old('phone', $user->phone_number) }}" 
                            placeholder="Phone Number"
                        >
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- City -->
                <div class="col-md-6 mb-3">
                    <label for="city" class="fw-semibold text-light">City</label>
                    <div class="form">
                        <input 
                            type="text" 
                            class="form-control @error('city') is-invalid @enderror " 
                            id="city" 
                            name="city" 
                            value="{{ old('city', $user->city) }}" 
                            placeholder="City"
                        >
                        @error('city')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <label for="address" class="fw-semibold text-light">Address</label>
                <div class="col-12 mb-3">
                    <div class="form">
                        <textarea 
                            class="form-control @error('address') is-invalid @enderror " 
                            id="address" 
                            name="address" 
                            placeholder="Address"
                            style="height: 100px;"
                        >{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-glow rounded-4 fw-bold py-3">
                    <span class="btn-text">Update Profile</span>
                    <span class="btn-spinner d-none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Updating...
                    </span>
                </button>
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
    input#email {
    background: #b1b1b1;
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
    .login-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    
    .login-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2 {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        color: white::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .btn-glow {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(238, 90, 36, 0.4);
    }
    
    .form-control:focus {
        color: white;
    }
    
    /* Ensure text is visible in form controls */
    .form-control {
        color: white !important;
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    // Show loading spinner
                    const btnText = form.querySelector('.btn-text');
                    const btnSpinner = form.querySelector('.btn-spinner');
                    
                    if (btnText && btnSpinner) {
                        btnText.classList.add('d-none');
                        btnSpinner.classList.remove('d-none');
                    }
                }
                
                form.classList.add('was-validated');
            }, false);
        });

        // Profile picture preview
        const profilePictureInput = document.getElementById('profile_picture');
        const profileImage = document.querySelector('img[alt="Profile"]');
        
        if (profilePictureInput && profileImage) {
            profilePictureInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection