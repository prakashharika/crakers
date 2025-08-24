<x-app-seller-layout>
    <style>
        /* General Layout Styling */
        .advertisement-image {
            width: 500px;
            height: auto;
            display: block;
            margin: 20px auto;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .main {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card h4 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .form-select,
        .form-control {
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #2B60A6;
            border-color: #2B60A6;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #1e497a;
            border-color: #1e497a;
        }

        /* Error message styling */
        #image-error {
            display: block;
            margin-top: 10px;
            color: red;
            font-size: 0.9rem;
        }

        .main-footer {
            text-align: center;
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 50px;
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
                    <h4 class="main-title mb-0">Add Advertisement</h4>
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
            <div class="container mt-4">
                <!-- Display Existing Advertisement Image -->
                @if ($advertisement && $advertisement->ad_image)
                    <div class="card p-4">
                        <h4 class="main-title mb-0">Your Advertisement</h4>
                        <img src="{{ asset($advertisement->ad_image) }}" alt="Advertisement Image" class="img-fluid mt-3 advertisement-image">
                    </div>
                @else
                    <div class="card p-4">
                        <p>No advertisement image uploaded yet.</p>
                    </div>
                @endif
            </div>

            <!-- Advertisement Upload Form -->
            <div class="card p-4">
                <form method="POST" action="{{ route('seller.advertisements.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="property_id" class="form-label">Select Property</label>
                        <select class="form-select" id="property_id" name="property_id" required>
                            <option value="" disabled selected>Choose a property</option>
                            @foreach ($properties->PropertiesList as $property)
                            <option value="{{ $property->id }}" 
                                @if (isset($advertisement) && $advertisement->property_id == $property->id) selected @endif>
                                {{ $property->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ad_image" class="form-label">Upload Advertisement Image</label>
                        <input type="file" class="form-control" id="ad_image" name="ad_image" accept="image/*" required>
                        <div id="image-error" class="text-danger" style="display:none;"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Advertisement</button>
                </form>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>

    <!-- JavaScript for File Validation -->
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
    </script>
</x-app-seller-layout>
