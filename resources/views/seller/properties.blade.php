<x-app-seller-layout><style>
        .row{
            background: #fff;
        }
    </style>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4" bis_skin_checked="1">
                <div bis_skin_checked="1">
                    <h4 class="main-title mb-0">{{ $property->name??'List' }} Properties</h4>
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
                    <a class="btn btn-secondary mb-3" href="{{ route('property-cate-owner.view') }}">Back to list</a>
                    <a class="btn btn-primary mb-3" href="{{ route('property.seller.add',['id' => $property->id]) }}">Add Property</a>
                </div>
            </div>
            <div class="card p-4">
                <div class="col-xl-12">
                <div class="card">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Area</th>
                                <th>Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i =0;
                            @endphp
                            @if(isset($properties->PropertiesList))
                            @foreach ($properties->PropertiesList as $property)
                            <tr class="{{ $i%2==1?'':'table-active'}}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $property->title }}</td>
                            <td>{{ $property->area }} </td>
                            <td>
                                @php
                                    $price = $property->price;
                                    if ($price >= 10000000) {
                                        $formattedPrice = number_format($price / 10000000, 1) . ' CR';  // Crore
                                    } elseif ($price >= 100000) {
                                        $formattedPrice = number_format($price / 100000, 1) . ' Lakh';  // Lakh
                                    } elseif ($price >= 1000) {
                                        $formattedPrice = number_format($price / 1000, 1) . ' K';      // Thousand
                                    } else {
                                        $formattedPrice = $price;  // Less than 1000
                                    }
                                @endphp
                                {{ $formattedPrice }}
                            </td>
                            <td  class="text-center">
                                <a class="btn btn-success" href="{{ route("properties-list.seller.view", ['id' => $property->id]) }}"><i class="ri-eye-line"></i></a>
                                <a class="btn btn-info" href="{{ route("properties-list.seller.edit", ['id' => $property->id]) }}"><i class="ri-edit-2-fill"></i></a>
                                <a 
                                class="btn btn-danger" 
                                href="#" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-id="{{ $property->id }}"
                            >
                                <i class="ri-delete-bin-7-line"></i>
                            </a>                            </td>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this property?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a id="confirmDelete" class="btn btn-danger" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            // Update modal's delete link dynamically
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const propertyId = button.getAttribute('data-id');
                const deleteLink = "{{ route('properties-list.seller.delete', ['id' => ':id']) }}".replace(':id', propertyId);
                const confirmDelete = document.getElementById('confirmDelete');
                confirmDelete.href = deleteLink;
            });
        </script>
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
            <span>Developed by :) <a href="https://jayamwebsolutions.com/" target="_blank">Jayam Web Soluions</a></span>
        </div><!-- main-footer -->
    </div>
    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>

    <script>
$(document).ready(function() {
    $('.future-property-dropdown').on('change', function() {
        let status = $(this).val();
        let propertyId = $(this).data('id');
        
        console.log(status);
        console.log(propertyId);
        
        $.ajax({
            url: `{{ route('seller.future.status.update') }}`, 
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', 
                status: status,
                id: propertyId
            },
            success: function(response) {
                if (response.success) {
                    Toastify({
                        text: response.message || "Status updated successfully!",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#28a745",  
                        stopOnFocus: true,
                    }).showToast();
                } else {
                    Toastify({
                        text: response.message || "An error occurred. Please try again.",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#FFC107",  
                        stopOnFocus: true,
                    }).showToast();
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON?.message || 'Failed to update status. Please try again.';
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
});
    </script>
    </x-app-seller-layout>
