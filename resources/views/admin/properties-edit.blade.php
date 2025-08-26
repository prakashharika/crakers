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
div#feature-container{
    background: #f3f4f6;
    padding: 20px;
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
                    <h4 class="main-title mb-0">{{ $property->name ?? 'List' }} Products Edit</h4>
                </div>
                
            </div>            
            @if ($errors->any())
                @foreach ($errors->all() as $error)
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

            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    ← Back to List
                </a>
            </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="category_id" value="{{ request()->query('category_id') }}">

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>

        <!-- Tamil Name -->
        <div class="mb-3">
            <label for="tamil_name" class="form-label">Tamil Name (Optional)</label>
            <input type="text" name="tamil_name" id="tamil_name" value="{{ old('tamil_name', $product->tamil_name) }}" class="form-control">
        </div>

        <!-- Base Price -->
        <div class="mb-3">
            <label for="base_price" class="form-label">Base Price *</label>
            <input type="number" name="base_price" id="base_price" value="{{ old('base_price', $product->base_price) }}" class="form-control" required min="0" step="0.01">
        </div>

        <!-- Selling Price -->
        <div class="mb-3">
            <label for="selling_price" class="form-label">Selling Price *</label>
            <input type="number" name="selling_price" id="selling_price" value="{{ old('selling_price', $product->selling_price) }}" class="form-control" required min="0" step="0.01">
        </div>

        <!-- Packet or Box -->
        <div class="mb-3">
            <label class="form-label">Packet or Box *</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="packet_or_box" id="packet" value="packet" {{ old('packet_or_box', $product->packet_or_box) == 'packet' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="packet">Packet</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="packet_or_box" id="box" value="box" {{ old('packet_or_box', $product->packet_or_box) == 'box' ? 'checked' : '' }}>
                    <label class="form-check-label" for="box">Box</label>
                </div>
            </div>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity *</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control" required min="0">
        </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description *</label>
        <textarea name="description" id="description" class="form-control" required>{!! old('description', $product->description) !!}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Slug -->
    <!-- <div class="mb-3">
        <label for="slug" class="form-label">Slug *</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" class="form-control" required>
    </div> -->

    <!-- Items -->
    <div class="mb-3">
        <label for="items" class="form-label">Items *</label>
        <input type="text" name="items" id="items" value="{{ old('items', $product->items) }}" class="form-control" required>
    </div>

@if ($product->images)
    <div class="mb-3">
        <label class="form-label">Existing Images</label>
        <div class="d-flex flex-wrap gap-2">
                <div style="position: relative;">
                    <img src="{{ asset($product->images) }}" alt="Product Image" width="80" class="img-thumbnail">
                    {{-- Optional: Add remove button or checkbox here --}}
                </div>
        </div>
    </div>
@endif

<!-- Upload New Images -->
<div class="mb-3">
    <label for="images" class="form-label">Replace/Add Images</label>
    <input type="file" name="images" id="images" class="form-control" multiple accept="image/*">
</div>


    <!-- Submit -->
    <button type="submit" class="btn btn-success">Update Product</button>
</form>

            </div>
        </div>
    </div>
 

    <!-- CKEditor script -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>
        </x-app-layout>
        