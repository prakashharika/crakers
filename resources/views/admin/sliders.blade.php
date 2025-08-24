<x-app-layout>
    <style>
        .img-fluid{
            width: 100px;
            height: 100px;
        }
    </style>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title mb-0">Sliders</h4>
                <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
                    <button class="btn btn-primary mb-3" id="addServiceBtn" data-bs-toggle="modal" data-bs-target="#serviceModal">Add Slider</button>
                </div>
            </div>

            <!-- Success and Error Alerts -->
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
                <!-- Displaying the list of sliders as a table -->
                <h2>Existing Sliders</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sliderList">
                        <!-- Sliders will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>

    <!-- Modal for Adding Slider -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceModalLabel">Add Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="sliderForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" placeholder="Description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Slider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal for Editing Slider -->
<div class="modal fade" id="editSliderModal" tabindex="-1" aria-labelledby="editSliderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSliderModalLabel">Edit Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSliderForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="sliderId">
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Slider Image</label>
                        <input type="file" class="form-control" name="image" id="editImage">
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Current Image</label>
                        <img id="editImagePreview" class="img-fluid mb-2" style="max-width: 100px; display: none;" alt="Current Slider Image">
                    </div>
                    
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="editTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editDescription" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Slider</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        // Fetch all sliders
        function fetchSliders() {
            $.ajax({
                url: `{{ url('/admin') }}/sliders`,
                method: 'GET',
                success: function(data) {
                    let html = '';
                    data.forEach(slider => {
                        html += `
                            <tr>
                                <td><img src="{{asset('/')}}images/${slider.image}" width="100px" height="100px" class="img-fluid"></td>
                                <td>${slider.title}</td>
                                <td>${slider.description}</td>
                                <td>
                            <button class="btn btn-warning btn-sm" onclick="editSlider(${slider.id})">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteSlider(${slider.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#sliderList').html(html);
                },
                error: function() {
                    Toastify({
                        text: "Failed to fetch sliders.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#d9534f",  // Red for errors
                        stopOnFocus: true,
                    }).showToast();
                }
            });
        }
    
        // Add a new slider
        $('#sliderForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: `{{ url('/admin') }}/sliders`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                // Include CSRF token explicitly
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                },
                success: function(data) {
                    Toastify({
                        text: "Slider added successfully!",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#28a745",  // Green for success
                        stopOnFocus: true,
                    }).showToast();
                    fetchSliders();
                    $('#serviceModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    let message = xhr.responseJSON?.message || "Failed to add slider.";
                    Toastify({
                        text: message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#d9534f",  // Red for errors
                        stopOnFocus: true,
                    }).showToast();
                }
            });
        });
    
// Edit slider (Open modal and populate the fields)
function editSlider(id) {
    $.ajax({
        url: `{{ url('/admin') }}/sliders/${id}`,
        method: 'GET',
        success: function(data) {
    console.log(data);

    // Populate the modal fields
    $('#sliderId').val(data.id); // Assuming there's a hidden input to store the slider ID
    $('#editTitle').val(data.title);
    $('#editDescription').val(data.description);

    // Check if the slider has an image and display it
    if (data.image) {
        $('#editImagePreview')
            .attr('src', `{{asset('/')}}/images/${data.image}`) // Update the src attribute
            .show(); // Show the image
    } else {
        $('#editImagePreview').hide(); // Hide the preview if no image is available
    }

    // Open the modal
    $('#editSliderModal').modal('show');
},
        error: function(xhr) {
            console.log(xhr);
            Toastify({
                text: "Failed to fetch slider data.",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#d9534f",  // Red for errors
                stopOnFocus: true,
            }).showToast();
        }
    });
}

$('#editSliderForm').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append('_method', 'PUT'); // Ensure method is passed

    $.ajax({
        url: `{{ url('/admin') }}/sliders/${$('#sliderId').val()}`,
        method: 'POST', // POST is required for FormData with _method
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
        },
        success: function(data) {
            Toastify({
                text: "Slider updated successfully!",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#28a745", // Green for success
                stopOnFocus: true,
            }).showToast();
            fetchSliders(); // Refresh the sliders list
            $('#editSliderModal').modal('hide');
        },
        error: function(xhr, status, error) {
            let message = xhr.responseJSON?.message || "Failed to update slider.";
            Toastify({
                text: message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#d9534f", // Red for errors
                stopOnFocus: true,
            }).showToast();
        }
    });
});



    
        // Delete slider
        function deleteSlider(id) {
            $.ajax({
                url: `{{ url('/admin') }}/sliders/` + id,
                method: 'DELETE',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                },
                success: function() {
                    Toastify({
                        text: "Slider deleted successfully.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#28a745",  // Green for success
                        stopOnFocus: true,
                    }).showToast();
                    fetchSliders();
                },
                error: function() {
                    Toastify({
                        text: "Failed to delete slider.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#d9534f",  // Red for errors
                        stopOnFocus: true,
                    }).showToast();
                }
            });
        }
    
        fetchSliders();
    </script>
</x-app-layout>
