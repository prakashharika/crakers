<x-app-layout>
    <style>
        .img-fluid {
            width: 100px;
            height: 100px;
        }
    </style>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title mb-0">About Us</h4>
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
               <form action="{{ route('about.us.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="about_us">About Us Content</label>
                      <textarea name="about_us" id="about_us" class="form-control" rows="10">{{ old('about_us', $about->content ?? '') }}</textarea>

                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://jayamwebsolutions.com/" target="_blank">Jayam Web
                    Solutions</a></span>
        </div>
    </div>

    <!-- Include CKEditor -->
<!-- Include CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#about_us'), {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                'alignment', 'blockQuote', 'insertTable', 'undo', 'redo'
            ],
            placeholder: 'Write or edit your About Us content here...',
            alignment: {
                options: ['left', 'center', 'right', 'justify']
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

    
</x-app-layout>
