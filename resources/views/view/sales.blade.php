@extends('layouts.main')

@section('content')

 <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
 
<style>
    :root {
        --primary-color: #004AAD;
        --secondary-color: #40C351;
        --text-color: #333;
        --light-bg: #f5f5f5;
        --border-color: #ccc;
    }

    body {
        font-family: 'Inter', sans-serif;
        color: black;
        line-height: 1.6;

    }

    @media (min-height: 800px) {
        .main-sell {
            min-height: 70vh;
            /* Ensure full viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5rem 0;
            margin-bottom: 2rem;
            /* Add some padding for a balanced layout */
        }
    }

    .main-sell {
        padding-top: 180px !important;
        min-height: 100vh;
    }

    @media(max-width:576px) {
        .main-sell {
            padding-top: 250px !important;
        }
    }

    .sell-property-action-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .sell-property-heading {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-color);
    }

    .sell-property-redirect {
        font-size: 15px;
        padding: 10px;
        background: var(--light-bg);
        border-radius: 5px;
        display: inline-block;
    }

    .property-link {
        color: #ff0000;
        font-weight: 600;
        text-decoration: none;
        border-bottom: 2px solid #ff0000;
        transition: all 0.3s ease;
    }

    .form-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 12px;
        padding-right: 2.5rem;
    }

    @media (max-width: 576px) {
        body {
            font-size: 14px;
        }

        .form-select {
            width: 100%;
            max-width: none;
        }
    }

    @media (min-width: 577px) {
        body {
            font-size: 16px;
        }
    }

    .property-link:hover {
        color: var(--primary-color);
        border-bottom-color: var(--primary-color);
    }

    .form-container {
        background-color: var(--light-bg);
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        border: 1px solid var(--border-color);
        border-radius: 5px;
        padding: 0.75rem;
        font-size: 14px !important;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 74, 173, 0.25);
    }

    .updates-container {
        display: flex;
        align-items: center;
       
        margin-bottom: 20px;
    }

    .updates-text {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .whatsapp-icon {
        width: 20px;
        height: 20px;
        margin-right: 5px !important;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
        margin-left:10px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: var(--secondary-color);

    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .property-selection {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .property-type-label {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .property-type-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
    }

    .property-type-option {
        padding: 10px;
        background-color: #e0e0e0;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        text-align: center;
        transition: background-color 0.3s, color 0.3s;
    }

    .property-type-option:hover,
    .property-type-option.active {
        background-color: gray;
        color: white;
    }

    .submit-button {
        background-color: #004aad !important;
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s;
        width: 100%;
        max-width: 300px;
        color: white !important;
    }



    .submit-button:hover {
        background-color: #003380;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    @media (max-width: 768px) {
        .sell-property-heading {
            font-size: 24px;
        }

        .property-type-options {
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        }

        .form-container {
            padding: 20px;
        }
    }

    @media (max-width: 576px) {
        .sell-property-action-container {
            text-align: center;
        }

        .sell-property-redirect {
            margin-top: 15px;
        }

        .property-type-options {
            grid-template-columns: 1fr;
        }

        .updates-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .updates-toggle {
            margin-top: 10px;
        }
    }
    .property-form{
         {
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    padding: 30px;
    /* margin: 0 50px; */

    }
    .iti {
    position: relative;
    display: inline-block;
    width: 100%;
}
    
</style>

<style>
    .sales-property-image img{
        width:100%;
        height:543px;
        object-fit:cover;
    }
</style>
<main class="">
    @if($errors->any())
    @foreach($errors->all() as $error)
        <script>
            Toastify({
                text: "{{ $error }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#d9534f",  // Red for errors
                stopOnFocus: true,
            }).showToast();
        </script>
    @endforeach
@endif

@if(session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#5cb85c",  // Green for success
            stopOnFocus: true,
        }).showToast();
    </script>
@endif

@if(session('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#d9534f",  // Red for errors
            stopOnFocus: true,
        }).showToast();
    </script>
@endif

    <div class="main-sell">
        <div class="container">
            <div class="row sell-property-action-container">
                <div class="col-md-8 mb-3 mb-md-0">
                    <h1 class="sell-property-heading">Send Your Message</h1>
                </div>
                <div class="col-md-4 d-flex justify-content-md-end align-items-center">
                    <div class="sell-property-redirect">
                        <span>Looking for a property?</span>
                        <a class="property-link" href="{{ route('home') }}">Click Here</a>
                    </div>
                </div>
           

        <div class="container">
    <div class="row align-items-center">
        <!-- Left Column: Big Image -->
        <div class="col-md-6 sales-property-image">
            <img src="{{asset('assets/images/house2.avif')}}" alt="Description of the image" class="img-fluid" style="border-radius: 10px;">
        </div>

        <!-- Right Column: Form -->
        <div class="col-md-6">
            <form class="property-form" action="{{ route('sales.enquire') }}" method="post" novalidate>
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name"
                            value="{{ old('name') }}" required>
                        <div class="error-message text-danger small"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Enter your email" value="{{ old('email') }}" required>
                        <div class="error-message text-danger small"></div>
                    </div>
                </div>

                <!-- Row 2: Phone and City -->
                <div class="row mb-3">
                    <div class="col-md-12 mb-3 mb-md-0">
                        <label for="phone" class="form-label">Phone Number</label> <br>
                        <input type="text" id="phone" name="phone" class="form-control"
                            placeholder="Enter your phone number" value="{{ old('phone') }}" required>
                        <div class="error-message text-danger small"></div>
                    </div>
                     <!-- WhatsApp Updates Toggle -->
                <div class="updates-container mb-3 mt-3">
                    <div class="updates-text">
                        Is this number available on
                        <svg xmlns="http://www.w3.org/2000/svg" class="whatsapp-icon" viewBox="0 0 48 48">
                            <path fill="#40C351"
                                d="M35.175 12.832C32.195 9.852 28.234 8.207 24.02 8.207c-8.704 0-15.785 7.074-15.789 15.773 0 2.98.836 5.883 2.414 8.395l.375.598-1.594 5.821 5.973-1.566.578.344c2.422 1.438 5.199 2.199 8.031 2.199h.008c8.695 0 15.773-7.078 15.777-15.777 0-4.215-1.64-8.18-4.621-11.16z">
                            </path>
                            <path fill="#FFF"
                                d="M19.27 16.047c-.355-.793-.73-.809-1.07-.82-.277-.012-.594-.012-.91-.012s-.828.118-1.261.594c-.438.473-1.664 1.621-1.664 3.957 0 2.332 1.703 4.59 1.937 4.906.238.312 3.285 5.257 8.106 7.16 4.008 1.578 4.824 1.266 5.691 1.188.87-.082 2.808-1.148 3.202-2.258.395-1.105.395-2.054.277-2.254-.117-.2-.433-.316-.91-.554-.472-.239-2.804-1.383-3.242-1.543-.434-.157-.75-.235-1.066.238-.317.472-1.227 1.543-1.504 1.859-.277.316-.55.355-1.027.12-.472-.238-1.996-.738-3.809-2.355-1.41-1.258-2.363-2.809-2.64-3.285-.278-.472-.031-.73.207-.968.214-.21.476-.554.714-.832.234-.277.312-.473.472-.789.156-.316.078-.594-.039-.832-.117-.238-1.039-2.582-1.461-3.52z">
                            </path>
                        </svg>
                        WhatsApp?
                    </div>
                    <div class="updates-toggle">
                        <label class="switch">
                            <input type="checkbox" name="isthiswhatsapp" id="toggle-switch" {{ old('isthiswhatsapp', 'on') == 'on' ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                    <div class="col-md-12 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city"
                            value="{{ old('city') }}" required>
                        <div class="error-message text-danger small"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="g-recaptcha" data-sitekey="6LcpU8cqAAAAAHBELeQBy0_TY5mx6VuWthaPA4cO" data-action="LOGIN"></div>
                    </div>
                </div>

                <!-- Hidden Input -->
                <input type="hidden" name="pro_id" value="{{ old('pro_id', isset($slug) ? $slug : '') }}">

               

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn submit-button mb-4">Send Your Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
            
        </div> </div>
    </div>
    </div>
    </div>
    </div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneInput = document.querySelector("#phone");
            const form = document.querySelector("form");

            // Initialize intlTelInput
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "in",
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
            });

            // Handle property type selection
            const propertyTypeOptions = document.querySelectorAll('.property-type-option');
            propertyTypeOptions.forEach(option => {
                option.addEventListener('click', function () {
                    propertyTypeOptions.forEach(opt => opt.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Handle form submission
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                if (validateForm()) {
                    form.submit();
                }
            });

            // Form validation function
            function validateForm() {
                let isValid = true; // Assume form is valid unless a validation fails
                const name = document.getElementById('name');
                const email = document.getElementById('email');
                const phone = document.getElementById('phone');
                const city = document.getElementById('city');

                // Validate name
                if (name.value.trim() === '') {
                    isValid = false;
                    showError(name, 'Name is required');
                } else {
                    clearError(name);
                }

                // Validate email
                if (email.value.trim() === '') {
                    isValid = false;
                    showError(email, 'Email is required');
                } else if (!isValidEmail(email.value)) {
                    isValid = false;
                    showError(email, 'Please enter a valid email address');
                } else {
                    clearError(email);
                }

                // Validate phone
                if (phone.value.trim() === '') {
                    isValid = false;
                    showError(phone, 'Phone number is required');
                } else if (!iti.isValidNumber()) {
                    isValid = false;
                    showError(phone, 'Please enter a valid phone number');
                } else {
                    clearError(phone);
                }

                // Validate city
                if (city.value === '') {
                    isValid = false;
                    showError(city, 'Please select a city');
                } else {
                    clearError(city);
                }

                return isValid; // Return whether the form is valid
            }

            // Helper function to show error messages
            function showError(input, message) {
                const formGroup = input.closest('.col-md-6');
                let errorElement = formGroup.querySelector('.error-message');
                if (!errorElement) {
                    errorElement = document.createElement('div');
                    errorElement.className = 'error-message';
                    formGroup.appendChild(errorElement);
                }
                errorElement.textContent = message;
                input.classList.add('is-invalid');
            }

            // Helper function to clear error messages
            function clearError(input) {
                const formGroup = input.closest('.col-md-6');
                const errorElement = formGroup.querySelector('.error-message');
                if (errorElement) {
                    errorElement.remove();
                }
                input.classList.remove('is-invalid');
            }

            // Helper function to validate email format
            function isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(String(email).toLowerCase());
            }

            // Handle WhatsApp toggle
            const whatsappToggle = document.getElementById('toggle-switch');
            whatsappToggle.addEventListener('change', function () {
                if (this.checked) {
                    console.log('WhatsApp updates enabled');
                } else {
                    console.log('WhatsApp updates disabled');
                }
            });
        });

    </script>
@endsection
