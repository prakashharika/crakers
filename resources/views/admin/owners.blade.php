<x-app-layout>
    <style>
        .row{
            background: #fff;
        }
.contact-info {
    display: flex;
    align-items: center;
    gap: 8px; 
    /* font-size: 16px; */
    font-weight: 500;
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    border-radius: 5px;
}

.whatsapp-icon {
    color: #25D366; 
    font-size: 16px;
}

.phone-icon {
    color: #007BFF; 
    font-size: 16px;
}
.phone-number {
    color: #333;
    /* font-size: 16px; */
    font-weight: normal;
}
.contact-link {
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    gap: 5px;
    text-decoration: none;
    color: inherit;
}
a.user-name {
    color: #0dcaf0 !important;
}
i.ri-eye-2-line {
    color: #2b60a6;
    font-size: 18px;
}
.contact-link {
    display: flex; 
    align-items: center; 
    gap: 5px; 
    text-decoration: none; 
    color: inherit; 
}
.contact-info:hover {
    background-color: #e6f7ff; 
    cursor: pointer;
}
</style>
    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4" bis_skin_checked="1">
                <div bis_skin_checked="1">
                    <h4 class="main-title mb-0"> Sellers List</h4>
                </div>

                <div class="d-flex align-items-center gap-2 mt-3 mt-md-0" bis_skin_checked="1">
                    {{-- <a class="btn btn-secondary mb-3" href="{{ route('property.view') }}">Back to list</a> --}}
                </div>
            </div>
            <div class="card p-4">
                <div class="col-xl-12">
                <div class="card">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Date of Register</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i =0;
                            @endphp
                            @foreach ($owners as $owner)
                            <tr class="{{ $i%2==1?'':'table-active'}}">
                            <td>{{ ++$i }}</td>
                            <td>
                                <a href="{{ route('view.landowner',['id'=>$owner->id ]) }}" class="user-name">{{ $owner->name }}</a>
                            </td>
                            <td>{{ $owner->email }}</td>
                            <td class="contact-info">
                                @if ($owner->is_this_whatsapp == 'on')
                                    <a href="https://wa.me/{{ $owner->phone_number }}" class="contact-link">
                                        <i class="ri-whatsapp-fill whatsapp-icon"></i>
                                        <span class="phone-number">{{ $owner->phone_number }}</span>
                                    </a>
                                @else
                                    <a href="tel:{{ $owner->phone_number }}" class="contact-link">
                                        <i class="ri-phone-line phone-icon"></i>
                                        <span class="phone-number">{{ $owner->phone_number }}</span>
                                    </a>
                                @endif
                            </td>                                                     
                            <td>{{ $owner->city }}</td>
                            <td>{{ $owner->created_at }}</td>
                            <td>
                                <a href="{{ route('view.landowner',['id'=>$owner->id]) }}"  class="contact-link"> <i class="ri-eye-2-line"></i></a>
                            </td>
                            {{-- <td  class="text-center">
                                <a class="btn btn-success" href="{{ route("properties-list.view", ['id' => $property->id]) }}"><i class="ri-eye-line"></i></a>
                                <a class="btn btn-info" href="{{ route("properties-list.edit", ['id' => $property->id]) }}"><i class="ri-edit-2-fill"></i></a>
                                <a class="btn btn-danger" href="{{ route("properties-list.delete", ['id' => $property->id]) }}"><i class="ri-delete-bin-7-line"></i></a>
                            </td> --}}
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        {{-- <div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="propertyModalLabel"
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
        </div> --}}
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://jayamwebsolutions.com/" target="_blank">Jayam Web Soluions</a></span>
        </div><!-- main-footer -->
    </div>
</x-app-layout>
