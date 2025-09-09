<x-app-seller-layout>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4" bis_skin_checked="1">
                <div bis_skin_checked="1">
                    <h4 class="main-title mb-0">Property Management</h4>
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
                <div class="d-flex align-items-center gap-2 mt-3 mt-md-0" bis_skin_checked="1">
                    {{-- <button class="btn btn-primary mb-3" id="addPropertyBtn">Add Property</button> --}}
                </div>
            </div>
            <div class="card p-4">
                <div class="col-xl-12">
                    <div class="card">
                        <table class="table table-bordered" id="propertyTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Manage Properties</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="propertyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form id="propertyForm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="propertyModalLabel">Add Property</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="propertyId">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="savePropertyBtn">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div><!-- main-footer -->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const propertyTableBody = document.querySelector('#propertyTable tbody');
            const propertyForm = document.getElementById('propertyForm');
            const propertyModal = new bootstrap.Modal(document.getElementById('propertyModal'));
            let isEditMode = false;

            function fetchProperties() {
                fetch("{{ route('property.seller.index') }}")
                    .then(res => res.json())
                    .then(data => {
                        propertyTableBody.innerHTML = '';
                        data.forEach((property, index) => {
                            const row = `
                                 <tr class="${index % 2 === 1 ? 'table-active' : ''}">
                                    <td>${index + 1}</td>
                                    <td>${property.name}</td>
                                    <td>
                                        ${property.image ? `<img src="{{ url('/') }}/${property.image}" alt="Image" class="img-thumbnail" width="50">` : 'No Image'}
                                    </td>
                                    <td>${property.description || '-'}</td>
                                     <td>
                                            <a class="btn btn-primary btn-sm" href="{{ url('/') }}/seller/property-seller-list/${property.id}">Properties</a>
                                        </td>
                                </tr>
                            `;
                            propertyTableBody.insertAdjacentHTML('beforeend', row);
                        });
                    });
            }

            // document.getElementById('addPropertyBtn').addEventListener('click', () => {
            //     isEditMode = false;
            //     propertyForm.reset();
            //     document.getElementById('propertyId').value = '';
            //     document.getElementById('propertyModalLabel').textContent = 'Add Property';
            //     propertyModal.show();
            // });

            propertyTableBody.addEventListener('click', (event) => {
                if (event.target.classList.contains('edit-btn')) {
                    isEditMode = true;
                    const id = event.target.dataset.id;
                    console.log(id);
                    fetch(`{{ url('/') }}/admin/property/${id}`)
                        .then(res => {
                            if (!res.ok) {
                                throw new Error('Failed to fetch property data');
                            }
                            return res.json();
                        })
                        .then(property => {
                            // console.log('Fetched property:', property);

                            if (property) {
                                document.getElementById('propertyId').value = property.id || '';
                                document.getElementById('name').value = property.name || '';
                                document.getElementById('description').value = property.description ||
                                    '';
                                document.getElementById('sort_order').value = property.sort_order || '';
                                document.getElementById('status').value = property.status !==
                                    undefined ? property.status : '1'; // default to '1' (Active)
                                document.getElementById('propertyModalLabel').textContent =
                                    'Edit Property';

                                if (typeof propertyModal !== 'undefined') {
                                    propertyModal.show();
                                } else {
                                    console.error('Property modal is not initialized.');
                                }
                            } else {
                                console.error('No property data returned');
                            }
                        })
                        .catch(error => {
                            // Log any errors to the console
                            console.error('Error fetching property:', error);
                        });

                }

                if (event.target.classList.contains('delete-btn')) {
                    const id = event.target.dataset.id;
                    if (confirm('Are you sure you want to delete this property?')) {
                        fetch(`{{ url('/') }}/admin/property/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                }
                            })
                            .then(res => res.json())
                            .then(() => fetchProperties());
                    }
                }
            });

            $('#propertyForm').on('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const url = isEditMode
    ? `{{ route('property.update', ['property' => ':property']) }}`.replace(':property', formData.get('id'))
    : "{{ route('property.store') }}";

    const method = 'POST';

    // console.log("URL:", url);
    // console.log("Method:", method);

    // formData.forEach((value, key) => {
    //     console.log(`FormData Key: ${key}, Value: ${value}`);
    // });
    $.ajax({
        url: url,
        type: method,
        data: formData,
        processData: false, 
        contentType: false, 
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(data) {
            console.log("Response Data:", data);
            fetchProperties();
            propertyModal.hide(); 
        },
        error: function(xhr, status, error) {
            console.error("Failed to fetch property data:", error);
            console.error("Response:", xhr.responseText);
            alert(`An error occurred: ${error}`);
        }
    });
});



            fetchProperties();
        });
    </script>
    </x-app-seller-layout>

