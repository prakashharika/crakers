<x-app-layout>
    <style>
        /* General form styling */
        .main-app {
            background: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            font-size: 1.5rem !important;
    font-weight: 700;
    text-align: center;
    margin-bottom: 0.5rem;
        }

        .alert {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 1rem;
        }

        /* Form field styling */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: 600;
            margin-bottom: 5px;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: none;
            border: 1px solid #ccc;
        }
        .form-control:focus {
            border-color: #007bff;
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .button-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

        .d-flex input {
            margin-right: 10px;
            flex: 1;
        }

        .form-group .d-flex {
            display: flex;
            align-items: center;
        }

        /* Styling for multi-line input fields */
        .form-group textarea {
            resize: vertical;
         
        }

        /* Success message */
        .alert-success {
            background-color: #28a745;
            color: white;
        }
    </style>

    <div class="main-app ps-5" >
        <div class="container ps-5">
            <h2>Edit {{ $package->title }} Package</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <div class="card p-3" style="border-width: 2px;
    border-style: solid;
    border-color: #3699db;">

          
            <form action="{{ route('packages.update') }}" method="POST">
                @csrf

                <!-- Hidden field to identify the package being edited -->
                <input type="hidden" name="package_id" value="{{ $package->id }}">

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" value="{{ $package->title }}" required>
                </div>

                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" rows="3" name="content" required>{{ $package->content }}</textarea>
                </div>

                <div class="form-group d-flex align-items-center gap-2 ms-1">
                    <label for="price" class="mb-0">Price:</label>
                    <input type="number" class="form-control" name="price" value="{{ $package->price }}" required style="max-width: 200px;">
                    {{-- <select class="form-control" name="price_type" required style="max-width: 150px;">
                        <option value="month" {{ $package->price_type == 'month' ? 'selected' : '' }}>Monthly</option>
                        <option value="year" {{ $package->price_type == 'year' ? 'selected' : '' }}>Yearly</option>
                    </select> --}}
                </div>
                <div class="form-group d-flex align-items-center gap-2 ms-5">
                    <input type="text" class="form-control form-control-sm" name="no_property_listing" value="{{ old('no_property_listing', $package->no_property_listing ?? '') }}" placeholder="text" required style="max-width: 200px;">
                    <label for="no_property_listing" class="mb-0">No Property Listing</label>
                </div>
                
                <!-- Property Visibility Days -->
                <div class="form-group d-flex align-items-center gap-2 ms-5">
                        <input type="text" class="form-control" name="property_visibility_days" value="{{ old('property_visibility_days_text', $package->property_visibility_days ?? '') }}" placeholder="text" required style="max-width: 200px;">
                        <label for="property_visibility_days">Property Visibility Days</label>
                </div>

                <!-- Upto Images -->
                <div class="form-group d-flex align-items-center gap-2 ms-5">
                    <input type="text" class="form-control" name="upto_images" value="{{ old('upto_images', $package->upto_images ?? '') }}" placeholder="text" style="max-width: 200px;">
                    <label for="upto_images">Upto Images</label>
                    </div>

                <!-- Future Listing Days -->
                <div class="form-group d-flex align-items-center gap-2 ms-5">
                    <input type="text" class="form-control" name="future_listing_days" value="{{ old('future_listing_days', $package->future_listing_days ?? '') }}" placeholder="text" style="max-width: 200px;">
                    <label for="future_listing_days">Future Listing Days</label>
                </div>

                <!-- Upto Video -->
                <div class="form-group d-flex align-items-center gap-2 ms-5">
                        <input type="text" class="form-control" name="upto_video" value="{{ old('upto_video', $package->upto_video ?? '') }}" placeholder="text" style="max-width: 200px;">
                        <label for="upto_video">Upto Video</label>
                 </div>
                <small class="text-muted">Leave empty if you don't want to show this</small>

                <!-- Extra Features -->
                <div class="form-group">
                    <label for="extra_features">Extra Features:</label>
                    <textarea class="form-control" name="extra_features[]" rows="4" placeholder="Enter each feature on a new line">{{ implode("\n", $package->extra_features ?? []) }}</textarea>
                    <span class="text-muted">Enter each item on a new line  </span>
                </div>

                <!-- Not Included -->
                <div class="form-group">
                    <label for="not_included">Not Included:</label>
                    <textarea class="form-control" name="not_included[]" rows="4" placeholder="Enter each item on a new line">{{ implode("\n", $package->not_included ?? []) }}</textarea>
                    <span class="text-muted">Enter each item on a new line</span>
                </div>

                <div class="form-group">
                    <label for="button_title">Button Title:</label>
                    <input type="text" class="form-control" name="button_title" value="{{ $package->button_title }}">
                </div>

                <div class="button-container">
    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
</div>
            </div>
            </form>
        </div>
    </div>

    <script>
        // Add a row for the "Property Listing Days"
        document.getElementById('add-property-listing-day').addEventListener('click', function() {
            var div = document.createElement('div');
            div.classList.add('property-day');
            div.innerHTML = '<input type="text" class="form-control" name="no_property_listing[]" placeholder="Text"><input type="number" class="form-control" name="no_property_listing_values[]" placeholder="Value"><button type="button" class="btn btn-danger remove-row">Remove</button>';
            document.getElementById('no_property_listing').appendChild(div);
        });

        // Remove a row
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-row')) {
                event.target.parentElement.remove();
            }
        });
    </script>
</x-app-layout>
