<x-app-layout>
    <style>
        .yes-no-toggle {
    position: relative;
    display: inline-flex;
    width: 120px;
    height: 40px;
    background-color: #e9ecef;
    border-radius: 20px;
    align-items: center;
    justify-content: space-between;
    padding: 0 5px;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.toggle-input {
    display: none;
}

.toggle-label {
    flex: 1;
    text-align: center;
    line-height: 40px;
    font-size: 14px;
    color: #6c757d;
    z-index: 2;
    cursor: pointer;
    transition: color 0.3s ease-in-out;
}

.toggle-slider {
    position: absolute;
    top: 3px;
    left: 3px;
    width: 50px;
    height: 34px;
    background-color: #ffffff;
    border-radius: 17px;
    transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
    z-index: 1;
}

#future_property_yes:checked + label {
    color: #28a745;
}

#future_property_yes:checked ~ .toggle-slider {
    transform: translateX(0);
    background-color: #28a745;
}

#future_property_no:checked + label {
    color: #dc3545;
}

#future_property_no:checked ~ .toggle-slider {
    transform: translateX(70px);
    background-color: #dc3545;
}

        .video-option + .btn {
    transition: background-color 0.3s ease, color 0.3s ease;
}

.video-option:checked + .btn {
    background-color: #0d6efd; 
    color: white;
}
#pricePreview {
    color: #0d6efd !important;
}
.image-preview {
    width: 130px;
    height: 110px;
    object-fit: cover;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 10px;
}
div#nearby-places-container {
    background: #f3f4f6;
    padding: 20px;
}
div#feature-container{
    background: #f3f4f6;
    padding: 20px;
}
button.btn.btn-danger.mt-2 {
        padding: 5px 12px;
        font-size: 12px; 
        line-height: 1.5;
        border-radius: 4px;
        height: auto; 
    }

    div[id^="preview-container"] {
        display: flex;
        flex-direction: column;
        align-items: center; 
        justify-content: center;
    }

    div[id^="preview-container"] button {
        margin-top: 5px;
    }
</style>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="main-title mb-0">{{ $property->name ?? 'List' }} Products Add</h4>
                </div>
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
            <div class="card p-5">
          <!-- Product Form -->
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Name *</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
    </div>

    <!-- Tamil Name -->
    <div class="mb-3">
        <label for="tamil_name" class="form-label">Tamil Name (Optional)</label>
        <input type="text" name="tamil_name" id="tamil_name" value="{{ old('tamil_name') }}" class="form-control">
    </div>

    <!-- Base Price -->
    <div class="mb-3">
        <label for="base_price" class="form-label">Base Price *</label>
        <input type="number" name="base_price" id="base_price" value="{{ old('base_price') }}" class="form-control" required min="0" step="0.01">
    </div>

    <!-- Selling Price -->
    <div class="mb-3">
        <label for="selling_price" class="form-label">Selling Price *</label>
        <input type="number" name="selling_price" id="selling_price" value="{{ old('selling_price') }}" class="form-control" required min="0" step="0.01">
    </div>

    <!-- Packet or Box -->
    <div class="mb-3">
        <label class="form-label">Packet or Box *</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="packet_or_box" id="packet" value="packet" {{ old('packet_or_box') == 'packet' ? 'checked' : '' }} required>
                <label class="form-check-label" for="packet">Packet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="packet_or_box" id="box" value="box" {{ old('packet_or_box') == 'box' ? 'checked' : '' }}>
                <label class="form-check-label" for="box">Box</label>
            </div>
        </div>
    </div>

    <!-- Quantity -->
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity *</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="form-control" required min="0">
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description *</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Slug -->
    <!-- <div class="mb-3">
        <label for="slug" class="form-label">Slug *</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control" required>
    </div> -->

    <!-- Items -->
    <div class="mb-3">
        <label for="items" class="form-label">Items *</label>
        <input type="text" name="items" id="items" value="{{ old('items') }}" class="form-control" required>
    </div>

    <!-- Images -->
    <div class="mb-3">
        <label for="images" class="form-label">Images (multiple)</label>
        <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary">Save Product</button>
</form>




                
                
            </div>
        </div>

        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description')).catch(error => { console.error(error); });
</script>

<!-- Include CKEditor 4 CDN -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('description');

    // Ensure CKEditor updates the hidden textarea before form submit
    document.querySelector('form').addEventListener('submit', function (e) {
        for (var instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const videoOptions = document.querySelectorAll('.video-option');
    
            videoOptions.forEach(option => {
                option.addEventListener('change', function () {
                    const parentCard = this.closest('.card-body');
                    const videoUpload = parentCard.querySelector('.video-upload');
                    const videoLink = parentCard.querySelector('.video-link');
    
                    if (this.value === 'upload') {
                        videoUpload.classList.remove('d-none');
                        videoLink.classList.add('d-none');
                    } else {
                        videoUpload.classList.add('d-none');
                        videoLink.classList.remove('d-none');
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const imageInputs = document.querySelectorAll('input[type="file"][name^="image"]');
    const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    const maxImageSize = 2 * 1024 * 1024; // 2 MB

    imageInputs.forEach((input) => {
        input.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (file) {
                if (!validImageTypes.includes(file.type)) {
                    Toastify({
                            text: "Invalid image type. Only JPEG, PNG, JPG, and WebP are allowed.", 
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#d9534f", 
                            stopOnFocus: true,
                        }).showToast();
                    e.target.value = ""; // Clear the input
                    return;
                }
                if (file.size > maxImageSize) {
                    Toastify({
                            text: "Image size must be less than 2 MB.", 
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#d9534f", 
                            stopOnFocus: true,
                        }).showToast();
                    e.target.value = ""; // Clear the input
                    return;
                }
            }
        });
    });

    // Validation for videos
    const videoInputs = document.querySelectorAll('input[type="file"][name^="video_file"]');
    const validVideoTypes = ['video/mp4', 'video/mov', 'video/avi', 'video/x-flv'];
    const maxVideoSize = 50 * 1024 * 1024; // 50 MB

    videoInputs.forEach((input) => {
        input.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (file) {
                if (!validVideoTypes.includes(file.type)) {
                    Toastify({
                            text: "Invalid video type. Only MP4, MOV, AVI, and FLV are allowed.", 
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#d9534f", 
                            stopOnFocus: true,
                        }).showToast();
                    e.target.value = ""; // Clear the input
                    return;
                }
                if (file.size > maxVideoSize) {
                    Toastify({
                            text: "Video size must be less than 50 MB.", 
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#d9534f", 
                            stopOnFocus: true,
                        }).showToast();
                    e.target.value = ""; // Clear the input
                    return;
                }
            }
        });
    });
});
   function handleImageUpload(input, index) {
        const previewContainer = document.getElementById(`preview-container${index}`);
        const errorContainer = document.getElementById(`error${index}`);
        const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
        const maxSize = 2 * 1024 * 1024; // 2 MB

        // Clear previous error message and preview content
        errorContainer.textContent = "";
        previewContainer.innerHTML = "";

        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Validate file type
            if (!allowedTypes.includes(file.type)) {
                errorContainer.textContent = "Invalid file type. Only PNG, JPG, JPEG, and WEBP are allowed.";
                input.value = ""; // Reset the input
                return;
            }

            // Validate file size
            if (file.size > maxSize) {
                errorContainer.textContent = "File size exceeds 2 MB.";
                input.value = ""; // Reset the input
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                // Create image element with fixed size
                const img = document.createElement("img");
                img.src = e.target.result;
                img.alt = `Preview Image ${index}`;
                img.classList.add("image-preview");

                // Create remove button
                const removeButton = document.createElement("button");
                removeButton.textContent = "Remove";
                removeButton.type = "button";
                removeButton.classList.add("btn", "btn-danger", "mt-2");
                removeButton.onclick = function () {
                    previewContainer.innerHTML = ""; // Clear preview
                    input.value = ""; // Reset the input
                };

                // Append image and remove button to preview container
                previewContainer.appendChild(img);
                previewContainer.appendChild(removeButton);
            };

            reader.readAsDataURL(file); 
        }
    }
    
    </script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const iconSelector = document.getElementById('icon-selector');
    const placeNameInput = document.getElementById('place-name');
    const addPlaceButton = document.getElementById('add-place');
    const nearbyPlacesContainer = document.getElementById('nearby-places-container');
    const hiddenNearbyPlacesInput = document.getElementById('near_by_places');

    let nearbyPlaces = [];

    // Function to render the grid of nearby places
    function renderNearbyPlaces() {
        // Clear the current container
        nearbyPlacesContainer.innerHTML = '';

        // Render updated places in col-4 cards
        nearbyPlaces.forEach((place, index) => {
            const placeCard = document.createElement('div');
            placeCard.className = 'col-4';

            placeCard.innerHTML = `
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <i class="${place.icon} me-2"></i>
                        <span>${place.name}</span>
                        <button type="button" class="btn btn-sm btn-danger ms-auto" onclick="removePlace(${index})">X</button>
                    </div>
                </div>
            `;

            nearbyPlacesContainer.appendChild(placeCard);
        });

        // Update the hidden input with the JSON data
        hiddenNearbyPlacesInput.value = JSON.stringify(nearbyPlaces);
    }

    // Add a place to the list
    addPlaceButton.addEventListener('click', () => {
        const icon = iconSelector.options[iconSelector.selectedIndex].getAttribute('data-icon');
        const name = placeNameInput.value.trim();

        if (name === '') {
            alert('Place name cannot be empty!');
            return;
        }

        // Add to the array
        nearbyPlaces.push({ icon, name });

        // Clear the input fields
        placeNameInput.value = '';
        iconSelector.selectedIndex = 0;

        // Re-render the places
        renderNearbyPlaces();
    });

    // Remove a place from the list
    window.removePlace = (index) => {
        nearbyPlaces.splice(index, 1);
        renderNearbyPlaces();
    };

    // Prepopulate the list if there is existing data
    const oldData = hiddenNearbyPlacesInput.value;
    if (oldData) {
        nearbyPlaces = JSON.parse(oldData);
        renderNearbyPlaces();
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const iconSelector = document.getElementById('icon-selector2');
    const placeNameInput = document.getElementById('feature-name');
    const addPlaceButton = document.getElementById('add-feature');
    const nearbyPlacesContainer = document.getElementById('feature-container');
    const hiddenNearbyPlacesInput = document.getElementById('features');

    let nearbyPlaces = [];

    // Function to render the grid of nearby places
    function renderNearbyPlaces() {
        // Clear the current container
        nearbyPlacesContainer.innerHTML = '';

        // Render updated places in col-4 cards
        nearbyPlaces.forEach((place, index) => {
            const placeCard = document.createElement('div');
            placeCard.className = 'col-4';

            placeCard.innerHTML = `
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <i class="${place.icon} me-2"></i>
                        <span>${place.name}</span>
                        <button type="button" class="btn btn-sm btn-danger ms-auto" onclick="removePlace(${index})">X</button>
                    </div>
                </div>
            `;

            nearbyPlacesContainer.appendChild(placeCard);
        });

        // Update the hidden input with the JSON data
        hiddenNearbyPlacesInput.value = JSON.stringify(nearbyPlaces);
    }

    // Add a place to the list
    addPlaceButton.addEventListener('click', () => {
        const icon = iconSelector.options[iconSelector.selectedIndex].getAttribute('data-icon');
        const name = placeNameInput.value.trim();

        if (name === '') {
            alert('Place name cannot be empty!');
            return;
        }

        // Add to the array
        nearbyPlaces.push({ icon, name });

        // Clear the input fields
        placeNameInput.value = '';
        iconSelector.selectedIndex = 0;

        // Re-render the places
        renderNearbyPlaces();
    });

    // Remove a place from the list
    window.removePlace = (index) => {
        nearbyPlaces.splice(index, 1);
        renderNearbyPlaces();
    };

    // Prepopulate the list if there is existing data
    const oldData = hiddenNearbyPlacesInput.value;
    if (oldData) {
        nearbyPlaces = JSON.parse(oldData);
        renderNearbyPlaces();
    }
});

    </script>
    <script>
        document.getElementById('price').addEventListener('input', function() {
            const price = parseInt(this.value, 10);
            const previewElement = document.getElementById('pricePreview');
            if (!isNaN(price)) {
                previewElement.textContent = formatPrice(price);
            } else {
                previewElement.textContent = '';
            }
        });
    
        function formatPrice(price) {
            if (price >= 10000000) {
                return `${(price / 10000000).toFixed(2)}cr`;
            } else if (price >= 100000) {
                return `${(price / 100000).toFixed(2)}lakh`;
            } else if (price >= 1000) {
                return `${(price / 1000).toFixed(2)}k`;
            } else {
                return price.toLocaleString();
            }
        }
    </script>
</x-app-layout>
