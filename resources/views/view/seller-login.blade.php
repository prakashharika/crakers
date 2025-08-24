<x-guest-layout>
    <style>

        .form-container {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-size: 1rem;
            color: #fff;
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
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
            margin-top: 10px;
        }

        .submit-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .google-button {
            background-color: #fff;
            color: #000;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 1rem;
            border: 1px solid #DDDDDD;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            width:auto;
            align-content: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .row.d-flex.justify-content-center.text-center {
    display: flex;
    justify-content: center;
}
        .google-button img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .google-button:hover {
            background-color: #fff;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-sell {
                padding: 30px;
            }

            .submit-button,
            .google-button {
                width: 100%;
                padding: 14px;
            }
        }
    </style>

    <main class="container-fluid">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    Toastify({
                        text: "{{ $error }}",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#d9534f",
                        stopOnFocus: true,
                    }).showToast();
                </script>
            @endforeach
        @endif

        <div class="main-sell">
            <form class="property-form" action="{{ route('seller.log') }}" method="post" novalidate>
                @csrf
                <div class="form-container">
                    <div class="form-group">
                        <label for="email" class="form-label">Seller Login :</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="" required>
                    </div>
                    <div class="row d-flex justify-content-center text-center">
                        <button type="submit" class="btn submit-button">Submit</button>
                    </div>
                </div>
            </form>
            <div class="row d-flex justify-content-center text-center">
                <a href="{{ url('login/google') }}" class="google-button">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google Logo">
                    Login with Google
                </a>
            </div>
        </div>
    </main>
</x-guest-layout>
