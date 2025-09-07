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
                <h4 class="main-title mb-0">Terms and Conditions</h4>
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
                <form id="privacyPolicyForm" action="{{ route('terms.conditions.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="termsConditions" class="form-label">Privacy Policy</label>
                        <textarea name="terms_conditions" id="terms_conditions" class="form-control" rows="10">{{ $terms->content ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Policy</button>
                </form>
            </div>
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
