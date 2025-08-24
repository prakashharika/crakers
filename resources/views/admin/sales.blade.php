<x-app-layout>
    <style>
        .row{
            background: #fff;
        }
.contact-info {
    display: flex;
    align-items: center;
    gap: 8px; 
    /* font-size: 16px; */
    font-weight: 500;
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    border-radius: 5px;
}

.whatsapp-icon {
    color: #25D366; 
    font-size: 16px;
}

.phone-icon {
    color: #007BFF; 
    font-size: 16px;
}
.phone-number {
    color: #333;
    /* font-size: 16px; */
    font-weight: normal;
}
.contact-link {
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    gap: 5px;
    text-decoration: none;
    color: inherit;
}
a.user-name {
    color: #0dcaf0 !important;
}
i.ri-eye-2-line {
    color: #2b60a6;
    font-size: 18px;
}
.contact-link {
    display: flex; 
    align-items: center; 
    gap: 5px; 
    text-decoration: none; 
    color: inherit; 
}
.contact-info:hover {
    background-color: #e6f7ff; 
    cursor: pointer;
}
</style>
<div class="main main-app p-3 p-lg-4">
    <div class="container mt-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="main-title mb-0">Sales List</h4>
            </div>
            <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
                {{-- You can add any extra buttons or links here --}}
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="salesTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="salesEnquiryTab" data-bs-toggle="tab" href="#salesEnquiry" role="tab" aria-controls="salesEnquiry" aria-selected="true">Sales Enquiry</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="salesAdminTab" data-bs-toggle="tab" href="#salesAdmin" role="tab" aria-controls="salesAdmin" aria-selected="false">Sales For Admin</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="salesSellerTab" data-bs-toggle="tab" href="#salesSeller" role="tab" aria-controls="salesSeller" aria-selected="false">Sales For Seller</a>
            </li>
        </ul>
        @php
        $i = 0;
    @endphp
        <div class="tab-content mt-3" id="salesTabsContent">
                <div class="tab-pane fade show active" id="salesEnquiry" role="tabpanel" aria-labelledby="salesEnquiryTab">
                <div class="card p-4">
                    <div class="col-xl-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Date of Register</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                @if (is_null($sale->pro_id))
                                <tr class="{{ $i%2 == 1 ? '' : 'table-active' }}">
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $sale->name }}</td>
                                        <td>{{ $sale->email }}</td>
                                        <td class="contact-info">
                                            @if ($sale->is_this_whatsapp == 'on')
                                                <a href="https://wa.me/{{ $sale->phone }}" class="contact-link">
                                                    <i class="ri-whatsapp-fill whatsapp-icon"></i>
                                                    <span class="phone-number">{{ $sale->phone }}</span>
                                                </a>
                                            @else
                                                <a href="tel:{{ $sale->phone }}" class="contact-link">
                                                    <i class="ri-phone-line phone-icon"></i>
                                                    <span class="phone-number">{{ $sale->phone }}</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ $sale->city }}</td>
                                        <td>{{ $sale->created_at }}</td>
                                       
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sales For Admin Tab -->
            <div class="tab-pane fade" id="salesAdmin" role="tabpanel" aria-labelledby="salesAdminTab">
                <!-- Content specific to Admin -->
                <div class="card p-4">
                    <div class="col-xl-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Property</th>
                                    <th>Date of Enquiry</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Admin specific content -->
                                @foreach ($sales as $sale)
                                
                                @if($sale->land_owner_id == '' && !is_null($sale->pro_id))
                                       <tr>
                                        <td>{{ ++$i }} </td>
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
                                        <td>
                                            @if(isset($sale) && !empty($sale->pro_id) && !empty($sale->title))
                                            <a class="btn btn-primary" href="{{ route('property-view', ['slug' => \Hashids::encode($sale->pro_id), 'name' => Str::slug($sale->title)]) }}" target="_blank" rel="noopener noreferrer">view</a>
                                            @else
                                            Property not available
                                            @endif
                                            </td>
                                        <td>{{ $sale->created_at }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sales For Seller Tab -->
            <div class="tab-pane fade" id="salesSeller" role="tabpanel" aria-labelledby="salesSellerTab">
                <!-- Content specific to Seller -->
                <div class="card p-4">
                    <div class="col-xl-12">
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
                                @if($sale->land_owner_id != '' )
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
                                        <td>
                                            @if(isset($sale) && !empty($sale->pro_id) && !empty($sale->title))
                                            <a class="btn btn-primary" href="{{ route('property-view', ['slug' => \Hashids::encode($sale->pro_id), 'name' => Str::slug($sale->title)]) }}" target="_blank" rel="noopener noreferrer">view</a>
                                            @else
                                            Property not available
                                            @endif
                                            </td>
                                        <td>{{ $sale->created_at }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="main-footer mt-5">
        <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
        <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
    </div>
</div>

</x-app-layout>
