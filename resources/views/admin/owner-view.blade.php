<x-app-layout>
    <style>
        /* General Layout */
        .main {
            background-color: #f4f6f9;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header Section */
        .main-title {
            font-size: 28px;
            font-weight: bold;
            color: #2b60a6;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Row Styling */
        .row {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Info Items */
        .info-item {
            margin-bottom: 15px;
            font-size: 16px;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .info-item:last-child {
            margin-bottom: 0;
        }
        .info-label {
            font-weight: bold;
            color: #444;
        }
        .info-value {
            color: #555;
            text-align: right;
        }

        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 10px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #2b60a6;
            color: #ffffff;
            font-weight: bold;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tr:hover {
            background-color: #e6f7ff;
        }

        /* Footer Section */
        .main-footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #666;
        }
        .main-footer a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        .main-footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .info-item {
                flex-direction: column;
                align-items: flex-start;
            }
            .info-value {
                text-align: left;
            }
        }
        tr.current-plan {
    background: #c9faea !important;
}
    </style>

    <div class="main main-app">
        <div class="container">
            <!-- User Details -->
            <h4 class="main-title">User Details</h4>
            <div class="row">
                <div class="info-item">
                    <span class="info-label">Name:</span> 
                    <span class="info-value">{{ $owner['name'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span> 
                    <span class="info-value">{{ $owner['email'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Phone Number:</span> 
                    <span class="info-value">
                        {{ $owner['phone_number'] }}
                        @if ($owner['is_this_whatsapp'] === 'on')
                            <i class="ri-whatsapp-line whatsapp-icon" title="This is a WhatsApp number"></i>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">City:</span> 
                    <span class="info-value">{{ $owner['city'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span> 
                    <span class="info-value">
                        {{ $owner['status'] ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Created At:</span> 
                    <span class="info-value">{{ $owner['created_at'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Updated At:</span> 
                    <span class="info-value">{{ $owner['updated_at'] }}</span>
                </div>
            </div>

            <h4 class="main-title">User Packages</h4>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Package Name</th>
                                <th>Price</th>
                                <th>Price Type</th>
                                <th>Number of Properties</th>
                                <th>Valid Days</th>
                                <th>Images Allowed</th>
                                <!--<th>Future Listings</th>-->
                                <th>Videos Allowed</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Expire Date</th>
                                <th>Payment Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($owner->OrderPackage->isEmpty())
                                <tr>
                                    <td colspan="13" class="text-center">No records found</td>
                                </tr>
                            @else
                                @foreach ($owner->OrderPackage as $index => $package)
                                <tr class="{{ $package['status'] == 'active' ? 'current-plan' : '' }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $package['title'] }}</td>
                                    <td>{{ $package['price'] }}</td>
                                    <td>{{ $package['price_type'] }}</td>
                                    <td>{{ $package['no_property'] }}</td>
                                    <td>{{ $package['valid_days'] }}</td>
                                    <td>{{ $package['upto_images'] }}</td>
                                    <!--<td>{{ $package['future_listing'] }}</td>-->
                                    <td>{{ $package['upto_videos'] }}</td>
                                    <td>{{ ucfirst($package['payment_status']) }}</td>
                                    <td>{{ ucfirst($package['status']) }}</td>
                                    <td>{{ $package['expire_date'] }}</td>
                                    <td>{{ $package['created_at'] }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                
            </div>
            
            
        </div>

        <!-- Footer -->
        <div class="main-footer">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span><br>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>
</x-app-layout>
