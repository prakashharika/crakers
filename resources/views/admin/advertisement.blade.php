<x-app-layout>
    <style>
        .row {
            background: #fff;
        }
    </style>

    <div class="main main-app p-3 p-lg-4">
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
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="main-title mb-0">Advertisement List</h4>
                </div>
                <div>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#advertisementModal" onclick="resetModal()">Add Advertisement</button>
                </div>
            </div>

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="salesTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="adminAdvertisementTab" data-bs-toggle="tab" href="#adminAdvertisement" role="tab" aria-controls="adminAdvertisement" aria-selected="true">Admin Advertisement</a>
                </li>
                @if ($advertisementsWithSeller->isNotEmpty())
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="sellerAdvertisementTab" data-bs-toggle="tab" href="#sellerAdvertisement" role="tab" aria-controls="sellerAdvertisement" aria-selected="false">Seller Advertisement</a>
                    </li>
                @endif
            </ul>

            <div class="tab-content mt-3" id="salesTabsContent">
                <!-- Admin Advertisement Tab -->
                <div class="tab-pane fade show active" id="adminAdvertisement" role="tabpanel" aria-labelledby="adminAdvertisementTab">
                    <div class="card p-4">
                        <div class="col-xl-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ad</th>
                                        <th>Property</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($advertisementsWithoutSeller as $index => $add)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><img src="{{ asset($add->ad_image) }}" alt="Ad Image" style="width: 100px; height: auto;"></td>
                                            <td>{{ $add->property->title }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#advertisementModal" onclick="editAdvertisement({{ $add }})"><i class="ri-edit-2-fill"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteAdvertisement({{ $add->id }})">
                                                    <i class="ri-delete-bin-7-line"></i>
                                                </button>
                                                                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($advertisementsWithSeller->isNotEmpty())
                    <div class="tab-pane fade" id="sellerAdvertisement" role="tabpanel" aria-labelledby="sellerAdvertisementTab">
                        <div class="card p-4">
                            <div class="col-xl-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ad</th>
                                            <th>Property</th>
                                            <th>Seller</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($advertisementsWithSeller as $index => $add)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><img src="{{ asset($add->ad_image) }}" alt="Ad Image" style="width: 100px; height: auto;"></td>
                                                <td>{{ $add->property->title }}</td>
                                                <td>{{ $add->seller->name }}</td>
                                                <td>
                                                    {{-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#advertisementModal" onclick="editAdvertisement({{ $add }})"><i class="ri-edit-2-fill"></i></button> --}}
 <button class="btn btn-danger btn-sm" onclick="deleteAdvertisement({{ $add->id }})">
                                                    <i class="ri-delete-bin-7-line"></i>
                                                </button>                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Advertisement Modal -->
        <div class="modal fade" id="advertisementModal" tabindex="-1" aria-labelledby="advertisementModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.advertisements.store') }}" method="POST" enctype="multipart/form-data" id="advertisementForm">
                    @csrf
                    <input type="hidden" name="id" id="advertisementId">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="advertisementModalLabel">Add Advertisement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="property_id" class="form-label">Property</label>
                                <select class="form-select" id="property_id" name="property_id" required>
                                    <option value="" disabled selected>Select a Property</option>
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}">{{ $property->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="ad_image" class="form-label">Advertisement Image</label>
                                <input type="file" class="form-control" id="ad_image" name="ad_image" accept="image/*">
                                <div id="image-error" class="text-danger" style="display:none;"></div>
                                <img id="adImagePreview" src="#" alt="Advertisement Image" class="mt-2" style="max-width: 100%; display: none;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Advertisement</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>

    <script>
        function resetModal() {
            document.getElementById('advertisementForm').reset();
            document.getElementById('advertisementId').value = '';
            document.getElementById('advertisementModalLabel').innerText = 'Add Advertisement';
        }

        function editAdvertisement(advertisement) {
            resetModal();
            console.log(advertisement);
            document.getElementById('advertisementId').value = advertisement.id;
            document.getElementById('property_id').value = advertisement.property_id;
            document.getElementById('advertisementModalLabel').innerText = 'Edit Advertisement';
            const adImageElement = document.getElementById('adImagePreview');
            const path = "{{ asset('') }}";
            if (advertisement.ad_image) {
                adImageElement.src = path+advertisement.ad_image;
                adImageElement.style.display = 'block'; 
            } else {
                adImageElement.style.display = 'none'; 
            }
        }
    </script>
        <script>
            document.getElementById('ad_image').addEventListener('change', function(event) {
                // Clear any previous error message
                const errorMessage = document.getElementById('image-error');
                errorMessage.style.display = 'none';
            
                // Get the file
                const file = event.target.files[0];
            
                // Check if file is selected
                if (!file) {
                    return;
                }
            
                // Check file type (image only)
                if (!file.type.startsWith('image/')) {
                    errorMessage.textContent = "Please upload a valid image file.";
                    errorMessage.style.display = 'block';
                    event.target.value = ''; // Clear the input field
                    return;
                }
            
                // Check image dimensions (e.g., 1200x400)
                const img = new Image();
                img.onload = function() {
                    const width = img.width;
                    const height = img.height;
            
                    // Set your required image size (for example, 1200x400)
                    const requiredWidth = 400;
                    const requiredHeight =600;
            
                    if (width < requiredWidth || height < requiredHeight) {
                        errorMessage.textContent = `Image dimensions must be at least ${requiredWidth}px by ${requiredHeight}px.`;
                        errorMessage.style.display = 'block';
                        event.target.value = ''; // Clear the input field
                    }
                };
            
                // Read the file and check its dimensions
                img.src = URL.createObjectURL(file);
            
                if (file.size > 2 * 1024 * 1024) { // 2MB in bytes
                    errorMessage.textContent = "The image file size must be less than 2MB.";
                    errorMessage.style.display = 'block';
                    event.target.value = ''; // Clear the input field
                }
            });
            function deleteAdvertisement(advertisementId) {
    var url = `{{ route('admin.advertisements.destroy',['advertisement' => ':id']) }}`.replace(':id', advertisementId);
    
    if (confirm('Are you sure you want to delete this advertisement?')) {
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Check if the response was successful
            if (data.success) {
                Toastify({
                    text: data.message, // Show the success message
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#28a745", // Green for success
                    stopOnFocus: true,
                }).showToast();
                location.reload(); // Reload the page to reflect the changes
            } else {
                Toastify({
                    text: data.message, // Show the error message
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#d9534f", // Red for error
                    stopOnFocus: true,
                }).showToast();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Toastify({
                text: "An error occurred. Please try again.", // Generic error message
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#d9534f", // Red for error
                stopOnFocus: true,
            }).showToast();
        });
    }
}


        </script>
</x-app-layout>
