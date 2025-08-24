<x-guest-layout>
    <style>


        .otp-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .otp-description {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 30px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 20px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
        }

        .submit-button {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .submit-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .resend-link {
            display: block;
            margin-top: 15px;
            font-size: 0.9rem;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .resend-link:hover {
            color: #0056b3;
        }
    </style>

    <div class="otp-container">
        <div class="otp-box">
            <h1 class="otp-title">Verify OTP</h1>
            <p class="otp-description">Enter the OTP sent to your email to verify your identity.</p>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('otp.verify') }}" method="POST">
                @csrf
                <input 
                    type="text" 
                    name="otp" 
                    class="form-control" 
                    placeholder="Enter OTP" 
                    maxlength="6"
                    value="" 
                    required
                >
                <div class="row d-flex justify-content-center text-center">
                <button type="submit" class="submit-button">Verify</button>
                </div>
            </form>
            <div class="row d-flex justify-content-center text-center">
            <a href="{{ route('otp.resend') }}" class="resend-link">Resend OTP</a>
            </div>
        </div>
    </div>
</x-guest-layout>
