<x-app-seller-layout>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4" bis_skin_checked="1">
                <div bis_skin_checked="1">
                    <h4 class="main-title mb-0">Property Management</h4>
                </div>
                @if($errors->any())
                @foreach($errors->all() as $error)
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
            
            @if(session('error'))
                <script>
                    Toastify({
                        text: "{{ session('error') }}",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#d9534f",
                        stopOnFocus: true,
                    }).showToast();
                </script>
            @endif
                <div class="d-flex align-items-center gap-2 mt-3 mt-md-0" bis_skin_checked="1">
                    {{-- <button class="btn btn-primary mb-3" id="addPropertyBtn">Add Property</button> --}}
                </div>
            </div>
            <div class="card p-4">
                <div class="col-xl-12">
                    <div class="card">
                        @php
                            $i =0;
                        @endphp
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Seller</th>
                                    <th>Property</th>
                                    <th>Date of Enquiry</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $sale->name }}</td>
                                        <td>{{ $sale->email }}</td>
                                        <td>@if ($sale->is_this_whatsapp == 'on')
                                            <a href="https://wa.me/{{ $sale->phone }}" class="contact-link">
                                                <i class="ri-whatsapp-fill whatsapp-icon"></i>
                                                <span class="phone-number">{{ $sale->phone }}</span>
                                            </a>
                                        @else
                                            <a href="tel:{{ $sale->phone }}" class="contact-link">
                                                <i class="ri-phone-line phone-icon"></i>
                                                <span class="phone-number">{{ $sale->phone }}</span>
                                            </a>
                                        @endif</td>
                                        <td>{{ $sale->city }}</td>
                                        <td>{{ $sale->land_owner_name }}</td>
                                        <td><a class="btn btn-primary" href="{{ route('property-view', ['slug' => \Hashids::encode($sale->pro_id), 'name' => Str::slug($sale->title)]) }}" target="_blank" rel="noopener noreferrer">view</a></td>
                                        <td>{{ $sale->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://jayamwebsolutions.com/" target="_blank">Jayam Web Soluions</a></span>
        </div><!-- main-footer -->
    </div>
    </x-app-seller-layout>

