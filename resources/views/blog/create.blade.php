<x-app-layout>
    <style>
        .blog-form-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .image-preview-container {
            margin-top: 15px;
            position: relative;
            display: inline-block;
        }
        
        .image-preview {
            max-width: 300px;
            max-height: 200px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        
        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
        .btn-submit {
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 20px;
        }
        
        .btn-submit:hover {
            background-color: #218838;
        }
        .blog-form-container {
    background: #fff;
}
    </style>

    <div class="main main-app p-3 p-lg-4">
        <div class="blog-form-container">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title mb-0">{{ isset($blogPost) ? 'Edit' : 'Create' }} Blog Post</h4>
                <a href="{{ route('blog.index') }}" class="btn btn-secondary">Back to Blog</a>
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

            <form action="{{ isset($blogPost) ? route('blog.update', $blogPost) : route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($blogPost))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blogPost->title ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="excerpt" class="form-label">Excerpt (Short Description)</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="3">{{ old('excerpt', $blogPost->excerpt ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content', $blogPost->content ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Featured Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                    
                    <div class="image-preview-container" id="imagePreviewContainer" 
                         style="{{ isset($blogPost) && $blogPost->image ? '' : 'display: none;' }}">
                        <img id="imagePreview" src="{{ isset($blogPost) && $blogPost->image ? asset($blogPost->image) : '' }}" 
                             alt="Image preview" class="image-preview">
                        <span class="remove-image" onclick="removeImage()">×</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="published" id="published" class="form-check-input" 
                            {{ old('published', isset($blogPost) && $blogPost->published ? 'checked' : '') }}>
                        <label for="published" class="form-check-label">Publish immediately</label>
                    </div>
                </div>

                <button type="submit" class="btn-submit">{{ isset($blogPost) ? 'Update' : 'Create' }} Post</button>
            </form>
        </div>

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>

    <!-- Include CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Image preview functionality
        function previewImage(input) {
            const previewContainer = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'inline-block';
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function removeImage() {
            const previewContainer = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');
            const fileInput = document.getElementById('image');
            
            preview.src = '';
            previewContainer.style.display = 'none';
            fileInput.value = '';
        }
        
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                        'alignment', 'blockQuote', 'insertTable', 'undo', 'redo', '|', 'imageUpload'
                    ]
                },
                placeholder: 'Write your blog content here...',
            })
            .catch(error => {
                console.error(error);
            });
            
        // Show image preview if editing and image exists
        @if(isset($blogPost) && $blogPost->image)
            document.getElementById('imagePreviewContainer').style.display = 'inline-block';
        @endif
    </script>
</x-app-layout>