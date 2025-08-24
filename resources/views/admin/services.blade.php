<x-app-layout>

    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title mb-0">Services</h4>
                <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
                    <button class="btn btn-primary mb-3" id="addServiceBtn" data-bs-toggle="modal" data-bs-target="#serviceModal">Add Service</button>
                </div>
            </div>

            @if (session('success'))
            <script>
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#28a745",  // Green for success
                    stopOnFocus: true,
                }).showToast();
            </script>
        @endif

        <!-- Display errors via Toastify -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
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

            <div class="card p-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =0;
                    @endphp
                        @foreach ($services as $service)
                        <tr class="{{ $i%2==1?'':'table-active'}}">
                            <td>{{ ++$i }}</td>
                            <td><i class="{{ $service->icon }}"></i> {{ $service->title }}</td>
                            <td>{!! \Str::limit($service->description, 50) !!}</td>
                                <td><img src="{{ asset('/' . $service->image) }}" width="50" height="50" alt="Service Image"></td>
                                <td>
                                    <button onclick="editService({{ $service->id }})" class="btn btn-warning btn-sm">Edit</button>
                                    <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>

    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Modal size increased here -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="serviceForm" action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="serviceId" name="serviceId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="serviceName">Service Name</label>
                                <input type="text" id="serviceName" name="name" class="form-control" placeholder="Service Name" required>
                                <br>
                                <br>
                                <label for="serviceIcon">Service Icon</label>
                                <select name="serviceIcon" id="serviceIcon">
                                    <option value=""> -- Select Icon -- </option>
                                    <option value="ri-home-4-fill">🏠 Home</option>
                                    <option value="ri-search-2-line">🔍 Search</option>
                                    <option value="ri-flight-takeoff-line">✈️ Airplane</option>
                                    <option value="ri-seedling-fill">🌱 Tree Seedling</option>
                                    <option value="ri-auction-fill">⚖️ Legal</option>
                                    <option value="ri-registered-fill">📝 Registration</option>
                                    <option value="ri-customer-service-2-fill">📞 Customer Service</option>
                                    <option value="ri-user-settings-fill">⚙️ User Settings</option>
                                    <option value="ri-file-copy-2-fill">📁 File Management</option>
                                    <option value="ri-pie-chart-2-fill">📊 Analytics</option>
                                    <option value="ri-wallet-3-fill">💳 Payment Services</option>
                                    <option value="ri-shield-user-fill">🛡️ Security</option>
                                    <option value="ri-global-fill">🌍 Global Access</option>
                                    <option value="ri-truck-fill">🚚 Logistics</option>
                                    <option value="ri-hotel-fill">🏨 Hospitality</option>
                                    <option value="ri-shopping-bag-3-fill">🛒 E-commerce</option>
                                    <option value="ri-heart-pulse-fill">🏥 Healthcare</option>
                                    <option value="ri-lightbulb-flash-fill">🛍️ Innovation</option>
                                    <option value="ri-group-fill">🛍️ Team Collaboration</option>
                                    <option value="ri-store-3-fill">🛍️ Retail</option>
                                    <option value="ri-briefcase-4-fill">💼 Professional Services</option>
                                    <option value="ri-graduation-cap-fill">🎓 Education</option>
                                    <option value="ri-rocket-fill">🚀 Startup</option>
                                    <option value="ri-cloud-fill">☁️ Cloud Services</option>
                                    <option value="ri-bank-fill">🏦 Banking</option>
                                    <option value="ri-phone-fill">📱 Telecommunication</option>
                                </select>
                                
                                <br>
                                <br>                                
                                <br>                                
                                <label for="serviceName">Service Image</label>
                                <input type="file" id="serviceImage" name="image" accept=".jpg,.png,.jpeg,.webp" class="form-control mt-2">
                                <div id="imagePreview" class="mt-2">
                                    <!-- The image preview will be inserted here dynamically -->
                                </div>
                            </div>
                            <div class="col-6">
                                <textarea id="serviceDescription" name="description" class="form-control mt-2" placeholder="Service Description"></textarea> <!-- CKEditor textarea -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveServiceBtn">Save Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
    let editor;

ClassicEditor
    .create(document.querySelector('#serviceDescription'), {
        height: 600,
        toolbar: [
            'bold', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo'
        ]  
    })
    .then(ed => {
        editor = ed;  // Store the editor instance for later use
    })
    .catch(error => {
        console.error(error);
    });
    </script>
    <script>
        let editingServiceId = null;

        // Open modal for adding a new service
        document.getElementById('addServiceBtn').addEventListener('click', function() {
            editingServiceId = null; 
            document.getElementById('serviceModalLabel').innerText = 'Add Service';
            document.getElementById('serviceForm').reset();
            document.getElementById('serviceId').value = ''; 
            document.getElementById('saveServiceBtn').innerText = 'Save Service'; 
        });
        $(document).ready(function() {
    // Move the editService function outside this block so it's globally accessible
    window.editService = async function(id) {
    editingServiceId = id;
    console.log(id);

    try {
        const response = await fetch(`{{ url('/admin/service/${id}/edit') }}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const service = await response.json(); // Assuming the server returns JSON data
        console.log(service);

        if (editor) {
            editor.setData(service.description);  
        }

        document.getElementById('serviceModalLabel').innerText = 'Edit Service';
        document.getElementById('serviceName').value = service.title;
        document.getElementById('serviceIcon').value = service.icon;
        document.getElementById('serviceId').value = service.id;
        document.getElementById('saveServiceBtn').innerText = 'Update Service';

        const imagePreviewContainer = document.getElementById('imagePreview');
        if (service.image) {
            imagePreviewContainer.innerHTML = `<img src="{{ asset('/') }}${service.image}" alt="Service Image" style="max-width: 100%; height: auto;">`;
        } else {
            imagePreviewContainer.innerHTML = ''; 
        }

        const form = document.getElementById('serviceForm');
        form.action = `{{ url('/admin/service') }}/${service.id}`;

        const existingMethodInput = form.querySelector('input[name="_method"]');
        if (existingMethodInput) {
            existingMethodInput.remove();
        }
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);

        $('#serviceModal').modal('show');
    } catch (error) {
        console.error('Error fetching service:', error);
    }
};

});

   


        // Delete a service
        async function deleteService(id) {
            if (confirm('Are you sure you want to delete this service?')) {
                const response = await fetch(`{{ url('/admin/service/${id}') }}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                    }
                });
            }
        }
        function handleImagePreview(input) {
    const imagePreviewContainer = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        // Read the file and display it
        reader.onload = function(e) {
            imagePreviewContainer.innerHTML = `<img src="${e.target.result}" alt="Selected Image" style="max-width: 100%; height: auto;">`;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
    </script>    
    
</x-app-layout>
