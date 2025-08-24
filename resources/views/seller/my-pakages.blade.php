<x-app-seller-layout>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
    
        .main {
            background: #fdfdfd;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    
        .main-title {
            font-size: 1.5rem;
            font-weight: 600;
        }
    
        .card {
            background: #ffffff;
            border: 1px solid #e6e6e6;
            border-radius: 8px;
            padding: 16px;
        }
    
        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
    
        .table th,
        .table td {
            padding: 12px;
            text-align: center;
        }
    
        .table th {
            background: #2B60A6;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
    
        .table tr {
            transition: background-color 0.3s ease;
        }
    
        .table tr:nth-child(even) {
            background: #f2f2f2;
        }
    
        .table tr:hover {
            background: #f9f9f9;
        }
    
        .current-plan {
            background: #def2ff !important;
        }
    
        /* Badge Styling */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 0.8rem;
            border-radius: 12px;
        }
    
        .badge.bg-success {
            background: #28a745;
            color: #ffffff;
        }
    
        .badge.bg-danger {
            background: #dc3545;
            color: #ffffff;
        }
    
        .badge.bg-secondary {
            background: #6c757d;
            color: #ffffff;
        }
    
        /* Modal Styling */
        .modal-content {
            border-radius: 8px;
        }
    
        .modal-title {
            font-weight: 600;
        }
    
        .btn-primary {
            background-color: #2B60A6;
            border: none;
            transition: background-color 0.3s ease;
        }
    
        .btn-primary:hover {
            background-color: #0056b3;
        }
    
        .main-footer {
            text-align: center;
            font-size: 0.85rem;
            color: #6c757d;
            padding: 16px;
            border-top: 1px solid #e6e6e6;
        }
    
        .main-footer a {
            color: #007bff;
            text-decoration: none;
        }
    
        .main-footer a:hover {
            text-decoration: underline;
        }
    </style>
    
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="main-title mb-0">My Packages Details</h4>
                </div>
            </div>
            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>No Of Property</th>
                                <th>Valid Days</th>
                                <th>Upto Images</th>
                                <th>Upto Videos</th>
                                <!--<th>Future Listing</th>-->
                                <th>Payment Status</th>
                                <th>Expire Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @if(isset($packages))
                                @foreach ($packages as $package)
                                    <tr class="{{ $i%2==1?'':'table-active'}} {{ $package->status === 'active'?'current-plan':'' }}">
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $package->title }}</td>
                                        <td>{{ 'Rs. ' . $package->price }}</td>
                                        <td>{{ $package->no_property }}</td>
                                        <td>{{ $package->valid_days }} Days</td>
                                        <td>{{ $package->upto_images }} Images</td>
                                        <td>{{ $package->upto_videos }} Videos</td>
                                        <!--<td>{{ $package->future_listing }} Listings</td>-->
                                        <td>
                                            @if($package->payment_status === 'success')
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-danger">Failed</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($package->expire_date)->format('d M, Y') }}</td>
                                        <td>
                                            @if($package->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11" class="text-center">No data available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>
    </x-app-seller-layout>
    