<x-app-layout>
    <style>
        .img-fluid {
            width: 100px;
            height: 100px;
        }
    </style>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title mb-0">Users List</h4>
            </div>

            @if (session('success'))
                <script>
                    Toastify({
                        text: "{{ session('success') }}",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#28a745", // Green for success
                        stopOnFocus: true,
                    }).showToast();
                </script>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <script>
                        Toastify({
                            text: "{{ $error }}",
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#d9534f", // Red for errors
                            stopOnFocus: true,
                        }).showToast();
                    </script>
                @endforeach
            @endif

             <div class="container">
        <h1>Buyer List</h1>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if($buyers->count() > 0)
                @foreach($buyers as $buyer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $buyer->name }}</td>
                        <td>{{ $buyer->email }}</td>
                        <td>{{ $buyer->phone_number }}</td>
                        <td>{{ $buyer->city }}</td>
                        <td>{{ $buyer->address }}</td>
                        <td>{{ ucfirst($buyer->status) }}</td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="7">No buyers found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

            <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Codewapp
                   </a></span>
        </div>
    </div>
         </div>
