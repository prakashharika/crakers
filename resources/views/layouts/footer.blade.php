@php
    $buy = App\Models\Property::where('status', 1)
        ->orderBy('sort_order', 'asc')
        ->get();
        $genaral = App\Models\GeneralDetail::find(1);
@endphp
        <!-- Footer -->
        <footer class="tf-footer">
            <div class="container d-flex">
                <span class="br-line"></span>
            </div>
            <div class="footer-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 mb_30 mb-xl-0">
                            <div class="footer-col-block">
                                <p class="footer-heading footer-heading-mobile">Contact us</p>
                                <div class="tf-collapse-content">
                                    <ul class="footer-contact">
                                        <li>
                                            <i class="icon icon-map-pin"></i>
                                            <span class="br-line"></span>
                                            <a href="https://www.google.com/maps?q=8500+Lorem+Street+Chicago,+IL+55030+Dolor+sit+amet" target="_blank"
                                                class="h6 link">
                                                {{isset($genaral->address)?$genaral->address:''}}
                                            </a>
                                        </li>
                                        <li>
                                            <i class="icon icon-phone"></i>
                                            <span class="br-line"></span>
                                            @if(isset($genaral->phone))
                                                @foreach(explode(',', $genaral->phone) as $phone)
                                                    <a href="tel:{{ trim($phone) }}" class="h6 link">{{ trim($phone) }}</a>
                                                @endforeach
                                            @endif
                                        </li>
                                        <li>
                                            <i class="icon icon-envelope-simple"></i>
                                            <span class="br-line"></span>
                                            <a href="mailto: {{isset($genaral->email)?$genaral->email:''}}" class="h6 link"> {{isset($genaral->email)?$genaral->email:''}}</a>
                                        </li>
                                    </ul>
                                    <div class="social-wrap">
                                        <ul class="tf-social-icon">
                                            <li>
                                                <a href="{{isset($genaral->facebook)?$genaral->facebook:''}}" target="_blank" class="social-facebook">
                                                    <span class="icon"><i class="icon-fb"></i></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{isset($genaral->instagram)?$genaral->instagram:''}}" target="_blank" class="social-instagram">
                                                    <span class="icon"><i class="icon-instagram-logo"></i></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{isset($genaral->twitter)?$genaral->twitter:''}}" target="_blank" class="social-x">
                                                    <span class="icon"><i class="icon-x"></i></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{isset($genaral->linkedin)?$genaral->linkedin:''}}" target="_blank" class="social-tiktok">
                                                    <span class="icon"><i class="icon-tiktok"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-6 mb_30 mb-xl-0">
                            <div class="footer-col-block footer-wrap-1 ms-xl-auto">
                                <p class="footer-heading footer-heading-mobile">Categories</p>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li><a href="javascript:void(0)" class="link h6">Shipping</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">aaaaaaaaand</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">ssssssss order</a></li>
                                        <li><a href="javascript:void(0)" class="link h6">Terms & sssss</a></li>
                                        <li><a href="javascript:void(0)" data-bs-toggle="modal" class="link h6">xxxxxxx Guide</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 mb_30 mb-sm-0">
                            <div class="footer-col-block footer-wrap-2 mx-xl-auto">
                                <p class="footer-heading footer-heading-mobile">Information</p>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li><a href="{{ route('about.us.view') }}" class="link h6">About Us</a></li>
                                        <li><a href="{{ route('terms.conditions.view') }}" class="link h6">Term & Policy</a></li>
                                        <li><a href="{{ route('privacy.policy.view') }}" class="link h6">Privacy Policy</a></li>
                                        <li><a href="{{route('blog.list')}}" class="link h6">Blog</a></li>
                                        <!-- <li><a href="javascript:void(0)" class="link h6">Refunds</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6">
                            <div class="footer-col-block">
                                <p class="footer-heading footer-heading-mobile">Let’s keep in touch</p>
                                <div class="tf-collapse-content">
                                    <div class="footer-newsletter">
                                        <p class="h6 caption">
                                          {{isset($genaral->description)?$genaral->description:''}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /Footer -->

    <!-- Javascript -->
    <script src={{ asset('front-end/js/bootstrap.min.js')}}></script>
    <script src={{ asset('front-end/js/jquery.min.js')}}></script>
    <script src={{ asset('front-end/js/swiper-bundle.min.js')}}></script>
    <script src={{ asset('front-end/js/carousel.js')}}></script>
    <script src={{ asset('front-end/js/bootstrap-select.min.js')}}></script>
    <script src={{ asset('front-end/js/lazysize.min.js')}}></script>
    <script src={{ asset('front-end/js/wow.min.js')}}></script>
    <script src={{ asset('front-end/js/parallaxie.js')}}></script>
    <script src={{ asset('front-end/js/count-down.js')}}></script>
    <script src={{ asset('front-end/js/main.js')}}></script>

    <script src="js/sibforms.js" defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quickViewButtons = document.querySelectorAll('[data-bs-toggle="modal"][href="#quickView"]');
    
    quickViewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.card-product');

            // ==== Get product data from card ====
            const imgSrc = productCard.querySelector('.img-product').getAttribute('src');
            const imgAlt = productCard.querySelector('.img-product').getAttribute('alt');
            const productName = productCard.querySelector('.name-product a').textContent.trim();
            const productLink = productCard.querySelector('.name-product a').getAttribute('href');
            const priceNew = productCard.querySelector('.price-new').textContent.trim();
            const priceOld = productCard.querySelector('.price-old') ? productCard.querySelector('.price-old').textContent.trim() : '';
            const productId = productCard.querySelector('.product-action_list a[data-bs-toggle="offcanvas"]').getAttribute('data-product-id');

            // ==== Update QuickView modal ====
            const modal = document.querySelector('#quickView');

            // Update image (first slide)
            const modalImg = modal.querySelector('.swiper-slide:first-child img');
            modalImg.src = imgSrc;
            modalImg.alt = imgAlt;

            // Update product name + link
            const modalName = modal.querySelector('.product-info-name');
            modalName.textContent = productName;
            modalName.setAttribute('href', productLink);

            // Update prices
            modal.querySelector('.price-new').textContent = priceNew;
            if (priceOld) {
                modal.querySelector('.price-old').textContent = priceOld;
                modal.querySelector('.price-old').style.display = 'inline';
            } else {
                modal.querySelector('.price-old').style.display = 'none';
            }

            // Update "Add to cart" button product ID
            const modalAddToCartBtn = modal.querySelector('.add-to-cart-btn');
            if (modalAddToCartBtn) {
                modalAddToCartBtn.setAttribute('data-product-id', productId);
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click event to all add to cart buttons
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            
            // Find the closest product container - handle both card product and modal scenarios
            let productElement = this.closest('.card-product');
            if (!productElement) {
                productElement = this.closest('.modal-quick-view');
            }
            
            // Safely get quantity from the quantity input field
            let quantity = 1;
            let quantityInput = null;
            
            if (productElement) {
                quantityInput = productElement.querySelector('.quantity-product');
                if (quantityInput) {
                    quantity = parseInt(quantityInput.value) || 1;
                }
            }
            
            // Validate quantity (must be at least 1)
            if (quantity < 1) {
                showToast('Error', 'Quantity must be at least 1', 'error');
                return;
            }
            
            // Show loading indicator
            const originalHtml = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';
            this.disabled = true;
            
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showToast('Success', data.message, 'success');
                    
                    // Update cart count in header (if you have one)
                    updateCartCount(data.cart_count);
                    
                    // Update offcanvas cart
                    updateCartSidebar();
                    
                    // Reset quantity to 1 after successful addition if input exists
                    if (quantityInput) {
                        quantityInput.value = 1;
                    }
                } else {
                    showToast('Error', data.message || 'Failed to add product to cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Something went wrong', 'error');
            })
            .finally(() => {
                // Restore button
                this.innerHTML = originalHtml;
                this.disabled = false;
            });
        });
    });
    
    // Handle remove from cart buttons (delegated event for dynamic content)
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove')) {
            e.preventDefault();
            const removeButton = e.target.closest('.remove');
            const cartItem = removeButton.closest('.tf-mini-cart-item');
            const productId = removeButton.getAttribute('data-product-id');
            
            if (!productId) {
                console.error('No product ID found for removal');
                return;
            }
            
            // Show loading on the remove button
            const originalHtml = removeButton.innerHTML;
            removeButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
            removeButton.style.pointerEvents = 'none';
            
            fetch('{{ route("cart.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showToast('Success', data.message, 'success');
                    
                    // Update cart count in header
                    updateCartCount(data.cart_count);
                    
                    // Remove the item from the UI or refresh the entire cart
                    if (cartItem) {
                        cartItem.remove();
                        
                        // Check if cart is now empty
                        const cartItems = document.querySelectorAll('.tf-mini-cart-item');
                        if (cartItems.length === 0) {
                            // Show empty cart message
                            document.querySelector('.tf-mini-cart-items').innerHTML = `
                                <div class="box-text_empty type-shop_cart">
                                    <div class="empty_top">
                                        <span class="icon">
                                            <i class="icon-shopping-cart-simple"></i>
                                        </span>
                                        <h3 class="text-emp fw-normal">Your cart is empty</h3>
                                        <p class="h6 text-main">
                                            Your cart is currently empty. Let us assist you in finding the right product
                                        </p>
                                    </div>
                                    <div class="empty_bot">
                                        <a href="javascript:void(0)" class="tf-btn animate-btn">Shopping</a>
                                        <a href="javascript:void(0)" class="tf-btn style-line">Back to home</a>
                                    </div>
                                </div>
                            `;
                        }
                        
                        // Update cart totals
                        updateCartTotals(data);
                    } else {
                        // If we can't find the specific item, refresh the entire cart
                        updateCartSidebar();
                    }
                } else {
                    showToast('Error', data.message || 'Failed to remove product from cart', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error', 'Something went wrong', 'error');
            })
            .finally(() => {
                // Restore button
                removeButton.innerHTML = originalHtml;
                removeButton.style.pointerEvents = 'auto';
            });
        }
    });

    
    // Function to show toast notifications
    function showToast(title, message, type = 'info') {
        const toastContainer = document.getElementById('toast-container') || createToastContainer();
        const toastId = 'toast-' + Date.now();
        
        const toastHTML = `
            <div id="${toastId}" class="toast align-items-center text-white bg-${type}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <strong>${title}</strong>: ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        
        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toastElement = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
        
        // Remove toast after it hides
        toastElement.addEventListener('hidden.bs.toast', function() {
            this.remove();
        });
    }
    
    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'toast-container position-fixed top-0 end-0 p-3';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
        return container;
    }
    
    function updateCartCount(count) {
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = count;
            el.style.display = count > 0 ? 'inline-block' : 'none';
        });
    }
    
    function updateCartSidebar() {
        // Fetch updated cart content via AJAX and update the sidebar
        fetch('{{ route("cart.content") }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartItemsContainer = document.querySelector('.tf-mini-cart-items');
                    if (cartItemsContainer) {
                        cartItemsContainer.innerHTML = data.html;
                    }
                    updateCartTotals(data);
                }
            });
    }
    
    function updateCartTotals(data) {
        // Update cart totals in the sidebar
        const countElement = document.querySelector('.prd-count');
        const totalElement = document.querySelector('.total-price');
        
        if (countElement) countElement.textContent = data.count;
        if (totalElement) totalElement.textContent = '₹' + data.total.toFixed(2);
    }
});
</script>


