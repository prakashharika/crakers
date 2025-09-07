<x-app-layout>
    <style>
        .img-fluid {
            width: 100px;
            height: 100px;
        }
        .post-property-section {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
 .property-register {
     display: flex;
     align-items: center;
     justify-content: space-between;
     margin: 30px;
 }
 button.btn.btn-success.save--btn {
    display: flex;
    justify-content: right;
    align-content: flex-end;
    align-items: flex-start;
    justify-self: end;
    margin: 30px;
}
 .post-property-button {
    padding: 15px 30px;
    margin-top: 60px;
    background-color: var(#004AAD);
    border: 1px solid var(#004AAD);
    color: var(#fff) !important;
    border-radius: 10px;
}
 .post-property-section-left-content {
     flex: 1;
     text-align: left;
     padding: 20px;
 }

 .post-property-section-plus-content {
     display: flex;
     gap: 20px;
     margin-top: 20px;
 }

 .post-property-section-plus span {

     color: var(--blue);
 }

 .post-property-section-right-content {
     flex: 1;
     display: flex;
     justify-content: center;
     align-items: center;
 }

 .post-property-button {
     padding: 15px 30px;

     margin-top: 60px;
     background-color: var(--blue);
     border: 1px solid var(--blue);
     color: var(--light) !important;
     border-radius: 10px;
 }

 .post-property-section-right-content img {
     max-width: 80%;
     height: auto;
     margin-top: 20px;

 }

 /* =================================post propertysection ends================== */
 /* ==========================apartment section styling==================================================================== */
 .apartment-gallery-section {
     background-color: var(--light);
     width: 100vw;
     height: 85vh;
     padding: 30px 0px;
 }

 .apartment-gallery-image-card-slider {
     display: flex;
     overflow: hidden;
     gap: 20px;
     scroll-behavior: smooth;
     position: relative;

 }

 .apartment-gallery-image-card {
     min-width: 250px;
     border-radius: 15px;
     overflow: hidden;
     cursor: pointer;
     box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
     background-color: #ffffff;
     transition: transform 0.3s ease, box-shadow 0.3s ease;
     text-align: center;
     position: relative;
 }

 /* Image styling */
 .apartment-gallery-image-card img {
     width: 100%;
     height: 350px;
     object-fit: cover;
 }

 /* Overlay styling */
 .apartment-gallery-image-card-overlay {
     position: absolute;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     background: rgba(0, 0, 0, 0.6);
     color: white;
     display: flex;
     flex-direction: column;
     justify-content: center;
     align-items: center;
     padding: 10px;
     opacity: 0;
     transition: opacity 0.3s ease;
 }
    </style>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title mb-0">General Details</h4>
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

            <div class="card p-4">
                <form id="privacyPolicyForm" action="{{ route('general.details.store') }}" method="POST" enctype="multipart/form-data" style="background: #EBF1FD; border-radius: 8px;">
                    @csrf
                    <button type="submit" class="btn btn-success save--btn mb-4">Save</button>
            
                    <div class="row p-3">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="Logo" class="form-label">Logo</label>
                                <br>
                                <div id="imagePreviewContainer" style="position: relative; display: inline-block;">
                                    <label for="propertyImage" id="uploadLabel" style="cursor: pointer; display: inline-block;">
                                        <img id="previewImage" src="{{ asset('images/'.(isset($general->logo)?$general->logo:'')) }}" alt="Post Property Image" class="img-thumbnail" style="width: 100%; max-width: 300px; border-radius: 8px;">
                                    </label>
                                    <span id="closeIcon" style="position: absolute; top: 5px; right: 5px; background: red; color: white; padding: 5px; border-radius: 50%; cursor: pointer; display: none;" onclick="removeImage()">×</span>
                                    <input type="file" name="property_image" id="propertyImage" accept="image/*" style="display: none;" onchange="previewFile(event)">
                                </div>                            </div>
                
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" cols="30" rows="6" class="form-control" placeholder="Enter your address">{{ $general->address }}</textarea>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" name="phone" id="phone" class="form-control" value="{{ $general->phone }}" placeholder="Enter phone number">
                            </div>
                
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $general->email }}" placeholder="Enter email address">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="facebook" class="form-label">Facebook Link</label>
                                <input type="url" name="facebook" id="facebook" class="form-control" value="{{ $general->facebook }}" placeholder="Enter Facebook profile link">
                            </div>
                
                            <div class="form-group mb-3">
                                <label for="twitter" class="form-label">Twitter Link</label>
                                <input type="url" name="twitter" id="twitter" class="form-control" value="{{ $general->twitter }}" placeholder="Enter Twitter profile link">
                            </div>
                
                            <div class="form-group mb-3">
                                <label for="linkedin" class="form-label">LinkedIn Link</label>
                                <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ $general->linkedin }}" placeholder="Enter LinkedIn profile link">
                            </div>
                
                            <div class="form-group mb-3">
                                <label for="instagram" class="form-label">Instagram Link</label>
                                <input type="url" name="instagram" id="instagram" class="form-control" value="{{ $general->instagram }}" placeholder="Enter Instagram profile link">
                            </div>
                
                            <div class="form-group mb-3">
                                <label for="map" class="form-label">Embedded Map Link</label>
                                <input type="text" name="map" id="map" class="form-control"  value="{{ $general->embaded }}" placeholder="Enter Google Maps embedded link">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Footer Description</label>
                                <textarea name="description" id="description" cols="30" rows="6" class="form-control" placeholder="Enter your footer description">{{ $general->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <script>
                function previewFile(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('previewImage');
                    const closeIcon = document.getElementById('closeIcon');
                    const uploadLabel = document.getElementById('uploadLabel');
            
                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        closeIcon.style.display = 'block'; // Show the close icon
                        uploadLabel.style.cursor = 'default'; // Disable upload when image is displayed
                    }
                }
            
                function removeImage() {
                    const preview = document.getElementById('previewImage');
                    const closeIcon = document.getElementById('closeIcon');
                    const uploadLabel = document.getElementById('uploadLabel');
                    const inputFile = document.getElementById('propertyImage');
            
                    preview.src = `{{ asset('images/'.$general->logo) }}`; // Reset to default image
                    closeIcon.style.display = 'none'; // Hide the close icon
                    uploadLabel.style.cursor = 'pointer'; // Enable upload again
                    inputFile.value = ""; // Clear the input file
                }
            </script>
            
        </div>

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Jayam Web
                    Solutions</a></span>
        </div>
    </div>

    <!-- Include CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#terms_conditions'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                    'alignment', 'blockQuote', 'insertTable', 'undo', 'redo'
                ],
                placeholder: 'Write or edit your terms conditions here...',
                alignment: {
                    options: ['left', 'center', 'right', 'justify'] 
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    
</x-app-layout>
