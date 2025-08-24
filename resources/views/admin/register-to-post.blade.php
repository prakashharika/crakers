<x-app-layout>
    <style>
        .img-fluid {
            width: 100px;
            height: 100px;
        }
        .post-property-section {
     background-color: var(--bg-service);
     display: flex;
     align-items: center;
     justify-content: center;
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
                <h4 class="main-title mb-0">Home Banner</h4>
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
                <form id="privacyPolicyForm" action="{{ route('register.section.store') }}" method="POST" enctype="multipart/form-data" style="background: #EBF1FD">
                    @csrf
                    <button type="submit" class="btn btn-success save--btn">Save</button>
            
                    <section class="post-property-section">
                        <div class="container property-register">
                            <div class="post-property-section-left-content">
                                <h2 class="home-section-title half-underline mb-0">
                                    <input type="text" name="title" value="{{ $register->title??'' }}" class="form-control">
                                </h2>
                                <h4 class="mt-4">
                                    <input type="text" name="subtitle" value="{{ $register->subtitle??'' }}" class="form-control">
                                </h4>
                                
                                    <div class="btn btn-primary mt-3"><input type="text" name="btn" value="{{ $register->btn??'' }}" class="form-control"></div>
                            </div>
                            <div class="post-property-section-right-content">
                                <div id="imagePreviewContainer" style="position: relative; display: inline-block;">
                                    <label for="propertyImage" id="uploadLabel" style="cursor: pointer; display: inline-block;">
                                        <img id="previewImage" src="{{ asset('/images/'.$register->image??'') }}" alt="Post Property Image" style="width: 100%; max-width: 300px;">
                                    </label>
                                    <span id="closeIcon" style="position: absolute; top: 5px; right: 5px; background: red; color: white; padding: 5px; border-radius: 50%; cursor: pointer; display: none;" onclick="removeImage()">×</span>
                                    <input type="file" name="property_image" id="propertyImage" accept="image/*" style="display: none;" onchange="previewFile(event)">
                                </div>
                            </div>
                        </div>
                    </section>
            
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
            
                    preview.src = "{{ asset('/images/'.$register->image??'') }}"; // Reset to default image
                    closeIcon.style.display = 'none'; // Hide the close icon
                    uploadLabel.style.cursor = 'pointer'; // Enable upload again
                    inputFile.value = ""; // Clear the input file
                }
            </script>
            
        </div>

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://jayamwebsolutions.com/" target="_blank">Jayam Web
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
