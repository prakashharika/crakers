<x-app-layout>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4" bis_skin_checked="1">
                <div bis_skin_checked="1">
                    <h4 class="main-title mb-0">Category Management</h4>
                </div>

                <div class="d-flex align-items-center gap-2 mt-3 mt-md-0" bis_skin_checked="1">
                    <button class="btn btn-primary mb-3" id="addPropertyBtn">Add Category</button> 
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
                                    <th>Tamil Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Manage Products</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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
                            <h5 class="modal-title" id="propertyModalLabel">Add Category</h5>
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
                                <label for="tamil_name" class="form-label">Tamil Name</label>
                                <input type="text" name="tamil_name" id="tamil_name" class="form-control">
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
            <span>Developed by :) <a href="https://jayamwebsolutions.com/" target="_blank">Jayam Web Soluions</a></span>
        </div><!-- main-footer -->
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

   <script>
document.addEventListener('DOMContentLoaded', function() {
    const propertyTableBody = document.querySelector('#propertyTable tbody');
    const propertyForm = document.getElementById('propertyForm');
    const propertyModal = new bootstrap.Modal(document.getElementById('propertyModal'));
    let isEditMode = false;

    function fetchProperties() {
        fetch("{{ route('property.index') }}")
            .then(res => res.json())
            .then(data => {
                propertyTableBody.innerHTML = '';
                data.forEach((property, index) => {
                    const row = `
                        <tr class="${index % 2 === 1 ? 'table-active' : ''}">
                            <td>${index + 1}</td>
                            <td>${property.name}</td>
                            <td>${property.tamil_name || '-'}</td>
                            <td>
                                ${property.image ? `<img src="{{ url('/') }}/${property.image}" alt="Image" class="img-thumbnail" width="50">` : 'No Image'}
                            </td>
                            <td>${property.description || '-'}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ url('/') }}/admin/property-list/${property.id}">Products</a>
                            </td>
                            <td>${property.status == 1 ? 'Active' : 'Inactive'}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-btn" data-id="${property.id}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${property.id}">
                                    <i class="bi bi-trash"></i> 
                                </button>
                            </td>
                        </tr>
                    `;
                    propertyTableBody.insertAdjacentHTML('beforeend', row);
                });
            });
    }

    document.getElementById('addPropertyBtn').addEventListener('click', () => {
        isEditMode = false;
        propertyForm.reset();
        document.getElementById('propertyId').value = '';
        document.getElementById('propertyModalLabel').textContent = 'Add Product';
        propertyModal.show();
    });

    propertyTableBody.addEventListener('click', (event) => {
        // Handle Edit button click
        if (event.target.closest('.edit-btn')) {
            isEditMode = true;
            const btn = event.target.closest('.edit-btn');
            const id = btn.dataset.id;

            fetch(`{{ url('/') }}/admin/property/${id}`)
                .then(res => {
                    if (!res.ok) throw new Error('Failed to fetch property data');
                    return res.json();
                })
                .then(property => {
                    document.getElementById('propertyId').value = property.id || '';
                    document.getElementById('name').value = property.name || '';
                    document.getElementById('description').value = property.description || '';
                    document.getElementById('sort_order').value = property.sort_order || '';
                    document.getElementById('status').value = property.status !== undefined ? property.status : '1';
                    document.getElementById('propertyModalLabel').textContent = 'Edit Property';
                    propertyModal.show();
                })
                .catch(error => console.error('Error fetching property:', error));
        }

        // Handle Delete button click
        if (event.target.closest('.delete-btn')) {
            const btn = event.target.closest('.delete-btn');
            const id = btn.dataset.id;

            if (confirm('Are you sure you want to delete this property?')) {
                fetch(`{{ url('/admin/property') }}/${id}`, {
                    method: 'POST', // Simulate DELETE
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                })
                .then(res => res.json())
                .then(response => {
                    Toastify({
                        text: response.message || 'Property deleted successfully',
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#dc3545",
                        stopOnFocus: true,
                    }).showToast();

                    fetchProperties(); // Refresh table
                })
                .catch(error => {
                    console.error("Delete failed:", error);
                    Toastify({
                        text: "Failed to delete property.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#BB2D3B",
                        stopOnFocus: true,
                    }).showToast();
                });
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
                fetchProperties();
                propertyModal.hide();
                Toastify({
                    text: "Updated successfully!",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#28a745",
                    stopOnFocus: true,
                }).showToast();
            },
            error: function(xhr) {
                let response;
                try {
                    response = JSON.parse(xhr.responseText);
                } catch (e) {
                    response = { success: false, errors: { message: "An unexpected error occurred." } };
                }
                let errorMessage = "An error occurred.";
                if (response.errors) {
                    errorMessage = Object.values(response.errors).flat().join(" ");
                }
                Toastify({
                    text: errorMessage,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#BB2D3B",
                    stopOnFocus: true,
                }).showToast();
            }
        });
    });

    fetchProperties();
});
</script>

</x-app-layout>
