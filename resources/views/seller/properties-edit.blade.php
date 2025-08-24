<x-app-seller-layout>
    <style>
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
div#feature-container{
    background: #f3f4f6;
    padding: 20px;
}
img.img-thumbnail.mt-2 {
    width: 130px;
}
.col-md-4.mb-3 {
    border-bottom: 1px solid #2b60a6;
    padding: 15px;
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
                    <h4 class="main-title mb-0">{{ $property->name ?? 'List' }} Properties Edit</h4>
                </div>
                <div>
                    <a href="{{ route('property-seller-list',['id'=>$property->property_id]) }}" class="btn btn-secondary">Back to List</a>
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

            <div class="card p-5">
                <form method="POST" enctype="multipart/form-data" action="{{ route('properties-list.seller.update', $property->id) }}">
                    @csrf
                    @method('PUT') <!-- Required for updating -->
                    
                    <input type="hidden" name="propertyId" value="{{ $property->id }}">

                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Title -->
                            <div class="col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $property->title }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="area" class="form-label">Area</label>
                                <div class="d-flex align-items-center">
                                    <input type="text" name="area" id="area" class="form-control" value="{{ old('area', $property->area) }}" required>
                                    <!--<span class="ms-2">sq.ft.</span>-->
                                </div>
                            </div>
                            
                            <!-- Configuration -->
                            <div class="col-md-6">
                                <label for="configuration" class="form-label">Configuration</label>
                                <input type="text" name="configuration" id="configuration" class="form-control" value="{{ old('configuration', $property->configuration) }}" required>
                                <label for="configuration" class="form-label">location</label>
                                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $property->location) }}" placeholder="eg. Chennai" required>
                                
                            </div>
                            
                            <!-- Price -->
                            <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    Rs.
                                    <small id="pricePreview" class="form-text text-muted"></small>
                                    <div class="form-group">
                                        <input 
                                            type="number" 
                                            name="price" 
                                            id="price" 
                                            class="form-control" 
                                            value="{{ old('price', $property->price) }}" 
                                            required
                                        >
                                    </div>                                                                    
                                    <label for="price" class="form-label">Tax info</label>
   
                                    <input type="text" name="price_text" id="price_text" class="form-control" value="{{ old('price_text', $property->price_text) }}" placeholder="eg. Crore+ Govt Charges & Tax @ 6,250 per sq.ft. (All inclusive)" required>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" required>{{ old('address', $property->address) }}</textarea>
                            </div>
                            
                            <!-- Total Floors -->
                            <div class="col-md-4">
                                <label for="total_floors" class="form-label">Total Floors</label>
                                <input type="text" name="total_floors" id="total_floors" class="form-control" value="{{ old('total_floors', $property->total_floors) }}" required>
                            </div>
                            
                            <!-- Facing -->
                            <div class="col-md-4">
                                <label for="facing" class="form-label">Facing</label>
                                <input type="text" name="facing" id="facing" class="form-control" value="{{ old('facing', $property->facing) }}" required>
                            </div>
                            
                            <!-- Property Age -->
                            <div class="col-md-4">
                                <label for="property_age" class="form-label">Property Age</label>
                                <input type="text" name="property_age" id="property_age" class="form-control" value="{{ old('property_age', $property->property_age) }}" required>
                            </div>
                            
                            <!-- Nearby Places -->
                            <div class="col-md-12">
                                <label for="near_by_places" class="form-label">Nearby Places</label>
                                
                                <!-- Nearby Places Input Section -->
                                <div class="input-group mb-3">
                                    <select id="icon-selector" class="form-select">
                                        <option value="">Select Icon</option>
                                        <option value="location" data-icon="ri-map-pin-2-fill">📍 Location</option>
                                        <option value="school" data-icon="ri-community-fill">🏫 School</option>
                                        <option value="hospital" data-icon="ri-first-aid-kit-fill">🏥 Hospital</option>
                                        <option value="mall" data-icon="ri-shopping-cart-2-fill">🏬 Mall</option>
                                        <option value="park" data-icon="ri-road-map-fill">🌳 Park</option>
                                        <option value="restaurant" data-icon="ri-restaurant-line">🍴 Restaurant</option>
                                        <option value="bank" data-icon="ri-bank-line">🏦 Bank</option>
                                        <option value="gym" data-icon="ri-run-fill">🏋️‍♂️ Gym</option>
                                        <option value="pharmacy" data-icon="ri-hospital-fill">💊 Pharmacy</option>
                                        <option value="bus_station" data-icon="ri-bus-line">🚏 Bus Station</option>
                                        <option value="train_station" data-icon="ri-train-line">🚉 Train Station</option>
                                        <option value="airport" data-icon="ri-plane-line">✈️ Airport</option>
                                        <option value="library" data-icon="ri-book-line">📚 Library</option>
                                        <option value="cinema" data-icon="ri-film-line">🎬 Cinema</option>
                                        <option value="hotel" data-icon="ri-hotel-line">🏨 Hotel</option>
                                        <option value="supermarket" data-icon="ri-store-line">🛒 Supermarket</option>
                                        <option value="stadium" data-icon="ri-football-line">🏟️ Stadium</option>
                                        <option value="church" data-icon="ri-hospital-fill">⛪ Church</option>
                                        <option value="mosque" data-icon="ri-moon-line">🕌 Mosque</option>
                                        <option value="temple" data-icon="ri-ancient-gate-fill">🏯 Temple</option>
                                        <option value="gas_station" data-icon="ri-gas-station-line">⛽ Gas Station</option>
                                        <option value="police_station" data-icon="ri-shield-user-line">👮 Police Station</option>
                                    </select>
                                    <input type="text" id="place-name" class="form-control" placeholder="Enter place name">
                                    <button type="button" id="add-place" class="btn btn-primary">Add</button>
                                </div>
                                
                                <!-- Preview List -->
                                <div id="nearby-places-container" class="row g-2">
                                    <!-- Dynamically added places will appear here -->
                                </div>
                                
                                <!-- Hidden Input to Store JSON Data -->
                                <textarea name="near_by_places" id="near_by_places" class="form-control d-none">{{ old('near_by_places') }}</textarea>
                            </div>
                            

                            <!-- About Property -->
                            <div class="col-md-12">
                                <label for="about_property" class="form-label">About Property</label>
                                <textarea name="about_property" id="about_property" class="form-control" required>{{ old('about_property', $property->about_property) }}</textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="features" class="form-label">Features</label>
                                
                                <!-- Nearby Places Input Section -->
                                <div class="input-group mb-3">
                                    <select id="icon-selector2" class="form-select">
                                        <option value="">Select Icon</option>
                                        <option value="gym" data-icon="ri-run-fill">🏋️‍♂️ Gym</option>
                                        <option value="wifi" data-icon="ri-wifi-fill">📶 Wifi</option>
                                        <option value="air_conditioning" data-icon="ri-windy-line">❄️ Air Conditioning</option>
                                        <option value="parking" data-icon="ri-parking-line">🅿️ Parking</option>
                                        <option value="tv" data-icon="ri-tv-line">📺 TV</option>
                                        <option value="pool" data-icon="ri-mist-fill">🏊‍♀️ Pool</option>
                                        <option value="heating" data-icon="ri-sun-foggy-fill">🌞 Heating</option>
                                        <option value="security" data-icon="ri-git-repository-private-fill">🔒 Security</option>
                                        <option value="balcony" data-icon="ri-home-8-line">🏡 Balcony</option>
                                        <option value="fireplace" data-icon="ri-fire-line">🔥 Fireplace</option>
                                        <option value="storage" data-icon="ri-store-line">📦 Storage</option>
                                        <option value="pet_friendly" data-icon="ri-bear-smile-line">🐾 Pet Friendly</option>
                                    </select>
                                    <input type="text" id="feature-name" class="form-control" placeholder="Enter feature name">
                                    <button type="button" id="add-feature" class="btn btn-primary">Add</button>
                                </div>
                                
                                <!-- Preview List -->
                                <div id="feature-container" class="row g-2">
                                    <!-- Dynamically added places will appear here -->
                                </div>
                                 <textarea name="features" id="features" class="form-control d-none" required>{{ old('features') }}</textarea>
                            </div>

                            @php
                            $storedImages = json_decode($property->images, true); 
                            $storedImages = $storedImages ?: []; // Ensure it's an array if null
                            @endphp
                            
                            <div class="row">
                                @for ($i = 1; $i <= $package->upto_images; $i++)
                                    <div class="col-md-4 mb-3">
                                        <label for="image{{ $i }}" class="form-label">Image {{ $i }}</label>
                                        <input type="file" name="image{{ $i }}" id="image{{ $i }}" class="form-control">
                                        <small class="text-muted">Optional</small>
                                        
                                        {{-- Preview Section --}}
                                        <div class="mt-2" id="preview-container{{ $i }}">
                                            @if(isset($storedImages[$i - 1])) {{-- Check if there's a stored image for this index --}}
                                                <img src="{{ asset('uploads/properties/images/' . $storedImages[$i - 1]) }}" class="img-thumbnail mt-2" alt="Property Image" />
                                            @endif
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        
                            
                            <!-- Video Uploads -->
                            @php
                                $storedVideos = json_decode($property->videos, true);
                                $storedVideos = $storedVideos ?: []; // Ensure it's an array if null
                            @endphp

                            <div class="container my-4">
                                <div class="row">
                                    @for ($i = 1; $i <= $package->upto_videos; $i++)
                                        <div class="col-md-6 mb-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="card-title">Video {{ $i }}</h5>
                                                    
                                                    <div class="btn-group d-flex mb-3" role="group">
                                                        <input type="radio" class="btn-check" name="video_option{{ $i }}" id="video_upload_option{{ $i }}" value="upload" 
                                                            {{ old("video_option{$i}", $property->{'video_option'.$i}) == 'upload' ? 'checked' : '' }}>
                                                        <label class="btn btn-outline-primary" for="video_upload_option{{ $i }}">Upload Video</label>
                                                        
                                                        <input type="radio" class="btn-check" name="video_option{{ $i }}" id="video_link_option{{ $i }}" value="link" 
                                                            {{ old("video_option{$i}", $property->{'video_option'.$i}) == 'link' ? 'checked' : '' }}>
                                                        <label class="btn btn-outline-primary" for="video_link_option{{ $i }}">YouTube Link</label>
                                                    </div>
                                                    
                                                    <div class="video-upload {{ old("video_option{$i}", $property->{'video_option'.$i}) == 'upload' ? '' : 'd-none' }}">
                                                        <label for="video_file{{ $i }}" class="form-label">Upload Video</label>
                                                        <input type="file" name="video_file{{ $i }}" id="video_file{{ $i }}" class="form-control">
                                                        
                                                        @if(isset($storedVideos[$i - 1]) && !filter_var($storedVideos[$i - 1], FILTER_VALIDATE_URL))
                                                            <video controls class="mt-3 w-100">
                                                                <source src="{{ asset('uploads/properties/videos/' . $storedVideos[$i - 1]) }}" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    </div>

                                                    <div class="video-link {{ old("video_option{$i}", $property->{'video_option'.$i}) == 'link' ? '' : 'd-none' }}">
                                                        <label for="video_link{{ $i }}" class="form-label">YouTube Link</label>
                                                        <input type="url" name="video_link{{ $i }}" id="video_link{{ $i }}" class="form-control" placeholder="Enter YouTube video link" 
                                                            value="{{ old('video_link'.$i, $property->{'video_link'.$i}) }}">
                                                        
                                                        @if(isset($storedVideos[$i - 1]) && filter_var($storedVideos[$i - 1], FILTER_VALIDATE_URL))
                                                            @php
                                                                $videoId = '';
                                                                if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]+)/', $storedVideos[$i - 1], $matches)) {
                                                                    $videoId = $matches[1];
                                                                }
                                                                $embedUrl = $videoId ? 'https://www.youtube.com/embed/' . $videoId : '';
                                                            @endphp

                                                            @if($embedUrl)
                                                                <iframe src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="mt-3 w-100"></iframe>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>


                            <!-- Save Button -->
                            <button type="submit" class="btn btn-primary">Update Property</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[name^="video_option"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            const index = this.name.replace('video_option', ''); // Get the video index
            const uploadDiv = document.querySelector(`#video_file${index}`).closest('.video-upload');
            const linkDiv = document.querySelector(`#video_link${index}`).closest('.video-link');

            if (this.value === 'upload') {
                uploadDiv.classList.remove('d-none');
                linkDiv.classList.add('d-none');
            } else if (this.value === 'link') {
                uploadDiv.classList.add('d-none');
                linkDiv.classList.remove('d-none');
            }
        });
    });
});

    </script>
    
    <script>
           function handleImageUpload(input, index) {
        const previewContainer = document.getElementById(`preview-container${index}`);
        const errorContainer = document.getElementById(`error${index}`);
        const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
        const maxSize = 2 * 1024 * 1024; 
        errorContainer.textContent = "";
        previewContainer.innerHTML = "";

        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (!allowedTypes.includes(file.type)) {
                errorContainer.textContent = "Invalid file type. Only PNG, JPG, JPEG, and WEBP are allowed.";
                input.value = ""; // Reset the input
                return;
            }

            if (file.size > maxSize) {
                errorContainer.textContent = "File size exceeds 2 MB.";
                input.value = ""; // Reset the input
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.alt = `Preview Image ${index}`;
                img.classList.add("image-preview");

                const removeButton = document.createElement("button");
                removeButton.textContent = "Remove";
                removeButton.type = "button";
                removeButton.classList.add("btn", "btn-danger", "mt-2");
                removeButton.onclick = function () {
                    previewContainer.innerHTML = ""; // Clear preview
                    input.value = ""; // Reset the input
                };

                previewContainer.appendChild(img);
                previewContainer.appendChild(removeButton);
            };

            reader.readAsDataURL(file); 
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
    const iconSelector = document.getElementById('icon-selector');
    const placeNameInput = document.getElementById('place-name');
    const addPlaceButton = document.getElementById('add-place');
    const nearbyPlacesContainer = document.getElementById('nearby-places-container');
    const hiddenNearbyPlacesInput = document.getElementById('near_by_places');

    let nearbyPlaces = [];

    function renderNearbyPlaces() {
        nearbyPlacesContainer.innerHTML = '';

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

        hiddenNearbyPlacesInput.value = JSON.stringify(nearbyPlaces);
    }

    addPlaceButton.addEventListener('click', () => {
        const icon = iconSelector.options[iconSelector.selectedIndex].getAttribute('data-icon');
        const name = placeNameInput.value.trim();

        if (!icon || name === '') {
            alert('Please select an icon and enter a place name!');
            return;
        }

        nearbyPlaces.push({ icon, name });
        placeNameInput.value = '';
        iconSelector.selectedIndex = 0;

        renderNearbyPlaces();
    });

    window.removePlace = (index) => {
        nearbyPlaces.splice(index, 1);
        renderNearbyPlaces();
    };

    
    const existingData = @json($property->near_by_places);
    console.log('existingData');
    console.log(existingData);
    nearbyPlaces = JSON.parse(existingData);
    renderNearbyPlaces();
});
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

    // Toggle between upload and link for videos
    const videoOptionInputs = document.querySelectorAll('input[type="radio"][name^="video_option"]');
    videoOptionInputs.forEach((radio) => {
        radio.addEventListener("change", function () {
            const index = this.name.replace('video_option', '');
            const uploadDiv = document.querySelector(`.video-upload input#video_file${index}`).closest('.video-upload');
            const linkDiv = document.querySelector(`.video-link input#video_link${index}`).closest('.video-link');

            if (this.value === 'upload') {
                uploadDiv.classList.remove('d-none');
                linkDiv.classList.add('d-none');
            } else if (this.value === 'link') {
                uploadDiv.classList.add('d-none');
                linkDiv.classList.remove('d-none');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const iconSelector = document.getElementById('icon-selector2');
    const placeNameInput = document.getElementById('feature-name');
    const addPlaceButton = document.getElementById('add-feature');
    const nearbyPlacesContainer = document.getElementById('feature-container');
    const hiddenNearbyPlacesInput = document.getElementById('features');

    let nearbyPlaces = [];

    // Render the grid of nearby places
    function renderNearbyPlaces() {
        nearbyPlacesContainer.innerHTML = '';

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

        hiddenNearbyPlacesInput.value = JSON.stringify(nearbyPlaces);
    }

    // Add new place
    addPlaceButton.addEventListener('click', () => {
        const icon = iconSelector.options[iconSelector.selectedIndex].getAttribute('data-icon');
        const name = placeNameInput.value.trim();

        if (!icon || name === '') {
            alert('Please select an icon and enter a place name!');
            return;
        }

        nearbyPlaces.push({ icon, name });
        placeNameInput.value = '';
        iconSelector.selectedIndex = 0;

        renderNearbyPlaces();
    });

    // Remove a place
    window.removePlace = (index) => {
        nearbyPlaces.splice(index, 1);
        renderNearbyPlaces();
    };

    
    const existingData = @json($property->features);
    console.log('existingData');
    console.log(existingData);
    nearbyPlaces = JSON.parse(existingData);
    renderNearbyPlaces();
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
</x-app-seller-layout>
