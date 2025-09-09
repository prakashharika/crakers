<x-app-layout>
    <style>
        .img-fluid {
            width: 100px;
            height: 100px;
        }
        .category-list {
            max-height: 300px;
            overflow-y: auto;
        }
        .product-item {
            transition: all 0.3s;
        }
        .product-item:hover {
            background-color: #f8f9fa;
        }
        .selected {
            background-color: #e3f2fd !important;
            border-left: 4px solid #2196f3;
        }
        #productsContainer {
            min-height: 200px;
            max-height: 400px;
            overflow-y: auto;
        }
    </style>

    <div class="main main-app p-3 p-lg-4">
        <div class="container mt-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="main-title mb-0">Voucher & Promotional Section</h4>
            </div>

            @if (session('success'))
                <script>
                    Toastify({
                        text: "{{ session('success') }}",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#28a745",
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
                            backgroundColor: "#d9534f",
                            stopOnFocus: true,
                        }).showToast();
                    </script>
                @endforeach
            @endif

            <div class="card p-4">
                <h5 class="card-title mb-4">Select Products for Voucher</h5>
                
                <form id="voucherForm" action="{{ route('voucher.store.products') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Category Selection -->
                        <div class="col-md-4 mb-4">
                            <label for="categoryDropdown" class="form-label">Select Category</label>
                            <button class="btn btn-outline-secondary w-100 text-start dropdown-toggle" type="button" 
                                    id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Choose a category
                            </button>
                            <ul class="dropdown-menu w-100 category-list" aria-labelledby="categoryDropdown">
                                @foreach($categories as $category)
                                    <li>
                                        <a class="dropdown-item category-item" href="#" data-id="{{ $category->id }}">
                                            {{ $category->name }} 
                                            <span class="badge bg-primary float-end">{{ $category->products->count() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <input type="hidden" id="selectedCategoryId" name="category_id">
                        </div>
                        
                        <!-- Search Box -->
                        <div class="col-md-8 mb-4">
                            <label for="productSearch" class="form-label">Search Products</label>
                            <input type="text" class="form-control" id="productSearch" 
                                   placeholder="Search products by name...">
                        </div>
                    </div>
                    
                    <!-- Products Display Area -->
                    <div class="mb-4">
                        <h6>Products</h6>
                        <div id="productsContainer" class="border rounded p-3">
                            <div class="text-center text-muted py-5">
                                <i class="ri-search-line display-4 d-block mb-2"></i>
                                <p>Select a category to view products</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Selected Products -->
                    <div class="mb-4">
                        <h6>Selected Products <span class="badge bg-primary" id="selectedCount">0</span></h6>
                        <div id="selectedProducts" class="border rounded p-3">
                            @if($selectedProducts->count() > 0)
                                @foreach($selectedProducts as $selected)
                                    <div class="product-item selected d-flex align-items-center p-2 mb-2 rounded" data-id="{{ $selected->product->id }}">
                                        <input type="checkbox" name="product_ids[]" value="{{ $selected->product->id }}" checked hidden>
                                        @if(isset($selected->product->images))
                                            <img src="{{ asset($selected->product->images) }}" 
                                                 class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-product.png') }}" 
                                                 class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0">{{ $selected->product->name }}</h6>
                                            <small class="text-muted">₹{{ number_format($selected->product->selling_price, 2) }}</small>
                                        </div>
                                        {{-- <button type="button" class="btn btn-sm btn-outline-danger remove-product">
                                            <i class="ri-close-line"></i>
                                        </button> --}}
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center py-3">No products selected yet</p>
                            @endif
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Selected Products</button>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="main-footer mt-5">
            <span>&copy; 2023. CPR Pyropark . All Rights Reserved.</span>
            <span>Developed by :) <a href="https://codewapp.com/" target="_blank">Code Wapp Technologies</a></span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryDropdown = document.getElementById('categoryDropdown');
            const categoryItems = document.querySelectorAll('.category-item');
            const productsContainer = document.getElementById('productsContainer');
            const selectedProducts = document.getElementById('selectedProducts');
            const productSearch = document.getElementById('productSearch');
            const selectedCount = document.getElementById('selectedCount');
            const form = document.getElementById('voucherForm');
            
            let selectedProductIds = new Set();
            
            // Initialize with previously selected products
            document.querySelectorAll('#selectedProducts .product-item').forEach(item => {
                const productId = item.getAttribute('data-id');
                selectedProductIds.add(productId);
            });
            updateSelectedCount();
            
            // Category selection
            categoryItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const categoryId = this.getAttribute('data-id');
                    const categoryName = this.textContent.split('(')[0].trim();
                    
                    categoryDropdown.textContent = categoryName;
                    document.getElementById('selectedCategoryId').value = categoryId;
                    
                    // Fetch products for this category
                    fetch(`/admin/api/category/${categoryId}/products`)
                        .then(response => response.json())
                        .then(products => {
                            displayProducts(products);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            productsContainer.innerHTML = `
                                <div class="text-center text-danger py-5">
                                    <i class="ri-error-warning-line display-4 d-block mb-2"></i>
                                    <p>Error loading products. Please try again.</p>
                                </div>
                            `;
                        });
                });
            });
            
            // Product search functionality
            productSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const productItems = productsContainer.querySelectorAll('.product-item');
                
                productItems.forEach(item => {
                    const productName = item.querySelector('.product-name').textContent.toLowerCase();
                    if (productName.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
            
            // Display products in the container
            function displayProducts(products) {
                if (products.length === 0) {
                    productsContainer.innerHTML = `
                        <div class="text-center text-muted py-5">
                            <i class="ri-inbox-line display-4 d-block mb-2"></i>
                            <p>No products found in this category</p>
                        </div>
                    `;
                    return;
                }
                
                let html = '';
                products.forEach(product => {
                    const isSelected = selectedProductIds.has(product.id.toString());
                    console.log(product);
                    const productImage = (product.images && product.images.length > 0) 
                        ? '{{ asset('') }}' + product.images
                        : '{{ asset('images/default-product.png') }}';
                    
                    html += `
                        <div class="product-item d-flex align-items-center p-2 mb-2 rounded ${isSelected ? 'selected' : ''}" 
                             data-id="${product.id}">
                            <img src="${productImage}" 
                                 class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-0 product-name">${product.name}</h6>
                                <small class="text-muted">₹${parseFloat(product.selling_price).toFixed(2)}</small>
                            </div>
                            <button type="button" class="btn btn-sm ${isSelected ? 'btn-outline-danger' : 'btn-outline-primary'} toggle-product">
                                <i class="${isSelected ? 'ri-close-line' : 'ri-add-line'}"></i>
                            </button>
                        </div>
                    `;
                });
                
                productsContainer.innerHTML = html;
                
                // Add event listeners to product toggle buttons
                productsContainer.querySelectorAll('.toggle-product').forEach(button => {
                    button.addEventListener('click', function() {
                        const productItem = this.closest('.product-item');
                        const productId = productItem.getAttribute('data-id');
                        
                        toggleProductSelection(productId, productItem, this);
                    });
                });
            }
            
            // Toggle product selection
            function toggleProductSelection(productId, productItem, button) {
                if (selectedProductIds.has(productId)) {
                    // Remove from selection
                    selectedProductIds.delete(productId);
                    productItem.classList.remove('selected');
                    button.classList.remove('btn-outline-danger');
                    button.classList.add('btn-outline-primary');
                    button.innerHTML = '<i class="ri-add-line"></i>';
                    
                    // Remove from selected products list
                    const selectedItem = selectedProducts.querySelector(`.product-item[data-id="${productId}"]`);
                    if (selectedItem) {
                        selectedItem.remove();
                    }
                } else {
                    // Add to selection
                    selectedProductIds.add(productId);
                    productItem.classList.add('selected');
                    button.classList.remove('btn-outline-primary');
                    button.classList.add('btn-outline-danger');
                    button.innerHTML = '<i class="ri-close-line"></i>';
                    
                    // Add to selected products list
                    const productName = productItem.querySelector('.product-name').textContent;
                    const productPrice = productItem.querySelector('.text-muted').textContent;
                    const productImage = productItem.querySelector('img').src;
                    
                    const selectedHtml = `
                        <div class="product-item selected d-flex align-items-center p-2 mb-2 rounded" data-id="${productId}">
                            <input type="checkbox" name="product_ids[]" value="${productId}" checked hidden>
                            <img src="${productImage}" 
                                 class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">${productName}</h6>
                                <small class="text-muted">${productPrice}</small>
                            </div>
                        </div>
                    `;
                    
                    if (selectedProducts.querySelector('.text-muted')) {
                        selectedProducts.innerHTML = selectedHtml;
                    } else {
                        selectedProducts.insertAdjacentHTML('beforeend', selectedHtml);
                    }
                    
                    // Add event listener to remove button
                    const removeButton = selectedProducts.querySelector(`.product-item[data-id="${productId}"] .remove-product`);
                    removeButton.addEventListener('click', function() {
                        toggleProductSelection(productId, productItem, button);
                    });
                }
                
                updateSelectedCount();
            }
            
            // Update selected products count
            function updateSelectedCount() {
                selectedCount.textContent = selectedProductIds.size;
            }
            
            // Form submission
            form.addEventListener('submit', function() {
                // Ensure all selected products are included in the form data
                selectedProductIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'product_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });
            });
        });
    </script>
</x-app-layout>