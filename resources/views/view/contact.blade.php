@extends('layouts.main')
@section('content')
<style>
    body {
        padding-top: 100px;
    }

    @media(max-width:576px) {
        body {
            padding-top: 150px;
        }
    }
    .text-primary{
    color: #0B62E0 !important;
}
.btn-primary {
    color: #fff;
    background-color: #0B62E0;
    border-color: #0B62E0;
    border-radius: 4px;
}
.btn-primary:hover {
    color: #fff;
    background-color: #003b8f;
    border-color: #023781;
}
</style>
<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <h3 class="text-center fs-2 text-primary mb-2">Let's Connect</h3>
        <div class="row g-5">
            <div class="col-lg-6 h-100 wow fadeInUp" data-wow-delay="0.2s">
                @if(session('alert'))
                <script>
                    Swal.fire({
                        icon: "{{ session('alert.type') }}", // success or error
                        title: "{{ session('alert.type') === 'success' ? 'Success!' : 'Error!' }}",
                        text: "{{ session('alert.message') }}",
                    });
                </script>
                @endif
                
                <form action="{{ route('user.enquiry') }}" method="post">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-12 col-xl-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" name="name" id="name"
                                    placeholder="Your Name" />
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-6">
                            <div class="form-floating">
                                <input type="email" class="form-control border-0" name="email" id="email"
                                    placeholder="Your Email" />
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-floating">
                                <input type="phone" class="form-control border-0" name="phone" id="phone" placeholder="Phone" />
                                <label for="phone">Your Phone</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control border-0" name="message" placeholder="Leave a message here"
                                    id="message" style="height: 175px"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3 my-4">
                                Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 wow fadeInUp " data-wow-delay="0.4s">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="d-inline-flex rounded bg-white w-100 p-4">
                            <i class="fas fa-map-marker-alt fa-2x text-secondary me-4"></i>
                            <div>
                                <h4>Factory Address:</h4>
                                <p class="mt-2 fw-bold">
                                    {{ $genaral->address??'' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12">
                        <div class="d-inline-flex rounded bg-white w-100 p-4">
                            <i class="fa fa-phone-alt fa-2x text-secondary me-4"></i>
                            <div class="WhatsApp">
                                <h4>Direct sales and service contact (India)</h4>
                                <p class="mb-0 fw-bold">
                                    <a class="WhatsApp" href="https://wa.me/{{ $genaral->phone??''  }}" target="_blank"
                                        rel="noopener noreferrer" style="text-decoration: none; color: inherit;">
                                        WhatsApp:  {{ $genaral->phone??''  }}
                                    </a>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-12">
                        <div class="d-inline-flex rounded bg-white w-100 p-4">
                            <i class="fas fa-envelope fa-2x text-secondary me-4"></i>

                            <div>
                                <h4>Email</h4>
                                <p class="mb-0">{{ $genaral->email??''  }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="h-100 overflow-hidden">
                {!! Str::replace('width="600"','width="100%"', $genaral->embaded??'') !!}
            </div>
        </div>
    </div>
</div>
@endsection