@extends('public.layouts.master')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                        <li class="breadcrumb-item">Cart</li>
                    </ol>
                </div>
            </div>
        </section>
        <section class=" section-9 pt-4"   id="cart-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table" id="cart">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($cartsProducts) > 0)
                                        @foreach ($cartsProducts as $cartProduct)
                                            <tr id="cart-item-{{ $cartProduct->id }}">
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('storage/images/products/' . $cartProduct->product->image) }}"
                                                            width="" height="">
                                                        <h2>{{ Str::limit($cartProduct->product->title, 15) }}</h2>
                                                    </div>
                                                </td>
                                                <td>$<span
                                                        id="item-price-{{ $cartProduct->product->id }}">{{ number_format($cartProduct->product->price, 2) }}</span>
                                                </td>
                                                <td>
                                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1"
                                                                data-product-id="{{ $cartProduct->product->id }}">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-sm border-0 text-center cart-input"
                                                            id="cart-count-{{ $cartProduct->product->id }}"
                                                            value="{{ $cartProduct->cart_count ?? 1 }}"
                                                            data-product-id="{{ $cartProduct->product->id }}">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1"
                                                                data-product-id="{{ $cartProduct->product->id }}">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$<span
                                                        id="total-price-{{ $cartProduct->product->id }}">{{ number_format($cartProduct->product->price * $cartProduct->cart_count, 2) }}</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger btn-remove"
                                                        data-product-id="{{ $cartProduct->product->id }}">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="text-center">
                                            <td colspan="20">No products added on cart..</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card cart-summery">
                            <div class="sub-title">
                                <h2 class="bg-white">Cart Summery</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Subtotal</div>
                                    <div id="subtotal-price">$0</div>
                                </div>
                                {{-- <div class="d-flex justify-content-between pb-2">
                                    <div>Shipping Charge</div>
                                    <div id="shipping-price">${{ $shippingCharge }}</div>
                                </div> --}}
                                {{-- <div class="d-flex justify-content-between summery-end">
                                    <div>Total</div>
                                    <div id="total-price">$0</div>
                                </div> --}}
                                <div class="pt-2">
                                    <a href="{{route('frontend.checkout')}}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <section class="section-9 pt-4" id="no-product-in-cart" >
            <div class="container text-center">
                <p>There are no items in this cart</p>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            // ==========Add to cart on plus button click==============
            $('.btn-plus').on('click', function() {
                let productId = $(this).data('product-id');
                let inputField = $('#cart-count-' + productId);
                let currentCount = parseInt(inputField.val()) || 0;
                let price = parseFloat($('#item-price-' + productId).text().replace(/[$,]/g, '')) || 0; // Get the item price

                $.ajax({
                    url: '/add-to-cart/' + productId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            let newCount = currentCount + 1;
                            inputField.val(newCount);
                            let newTotal = price * newCount;
                            $('#total-price-' + productId).text(newTotal.toFixed(2));
                            // Update total cart count
                            $('#cart-count').text(response.total_cart_count);
                            // Update subtotal after removing the item
                            calculateSubtotal();
                        }
                    },
                    error: function(xhr) {
                        toastify().error(xhr.responseJSON.error);
                    }
                });
            });
            // ==========End of Add to cart on plus button click==============

            // ===========Decrease item count on minus button click===============
            $('.btn-minus').on('click', function() {
                let productId = $(this).data('product-id');
                let inputField = $('#cart-count-' + productId);
                let currentCount = parseInt(inputField.val()) || 1;
                let price = parseFloat($('#item-price-' + productId).text().replace(/[$,]/g, '')) || 0; // Get the item price

                $.ajax({
                    url: '/remove-from-cart/' + productId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            let newCount = currentCount - 1;
                            inputField.val(newCount);

                            let newTotal = price * newCount;
                            $('#total-price-' + productId).text(newTotal.toFixed(2));

                            // Update total cart count
                            $('#cart-count').text(response.total_cart_count);
                            // Update subtotal after removing the item
                            calculateSubtotal();
                        }
                    },
                    error: function(xhr) {
                        toastify().error(xhr.responseJSON.error);
                    }
                });
            });
            // ===========End of Decrease item count on minus button click===============

            // ==========Remove item from cart on cross button click=======================
            $('.btn-remove').on('click', function() {
                let productId = $(this).data('product-id');
                let row = $(this).closest('tr'); // Get the row containing the item to remove

                $.ajax({
                    url: '/remove-item-from-cart/' + productId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Remove the row from the table
                            row.remove();

                            // Update total cart count
                            $('#cart-count').text(response.total_cart_count);

                            // Update total price if needed
                            $('#total-price').text('$' + response.total_price.toFixed(2));
                            // Update subtotal after removing the item
                            calculateSubtotal();
                        }
                    },
                    error: function(xhr) {
                        toastify().error(xhr.responseJSON.error);
                    }
                });
            });
            // ==========End of Remove item from cart on cross button click=======================

            // ===========Handle manual input change in cart count============
            $('.cart-input').on('blur', function() {
                let productId = $(this).data('product-id');
                let inputField = $('#cart-count-' + productId);
                let newCount = parseInt(inputField.val()) || 1; // Ensure at least 1
                let price = parseFloat($('#item-price-' + productId).text().replace(/[$,]/g, '')) || 0; // Get the item price

                if (newCount <= 0 || isNaN(newCount)) {
                    toastify().error('Please enter a valid number greater than zero.');
                    inputField.val(1); // Reset to 1 if invalid
                    return;
                }

                $.ajax({
                    url: '/update-cart-count/' + productId,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // Add CSRF token here
                        cart_count: newCount
                    },
                    success: function(response) {
                        if (response.success) {
                            let newTotal = price * newCount;
                            $('#total-price-' + productId).text(newTotal.toFixed(2));
                            // Update total cart count
                            $('#cart-count').text(response.total_cart_count);
                            // Update subtotal after removing the item
                            calculateSubtotal();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON.cart_count) {
                            cart_count = xhr.responseJSON
                                .cart_count;
                            inputField.val(cart_count);
                        }
                        toastify().error(xhr.responseJSON.error);
                    }
                });
            });
            // ===========End of Handling manual input change in cart count============

            //======== Function to calculate the total subtotal from all cart items=======
            function calculateSubtotal() {
                let subtotal = 0;

                // Loop through all items and sum their total prices
                $('input[id^="cart-count-"]').each(function() {
                    let productId = $(this).attr('id').split('-')[2]; // Get the product ID
                    let cartCount = parseInt($(this).val()) || 0; // Get the cart count for this product
                    let price = parseFloat($('#item-price-' + productId).text().replace(/[$,]/g, '')) || 0; // Get the item price
                    // Calculate total price for the current item (price * quantity)
                    let itemTotal = price * cartCount;
                    $('#total-price-' + productId).text(itemTotal.toFixed(2)); // Update item total display

                    // Add the item total to the subtotal
                    subtotal += itemTotal;
                });

                // Update the subtotal display
                $('#subtotal-price').text('$' + subtotal.toFixed(2));

                // Get the shipping price from the div
                let shippingPriceText = $('#shipping-price').text(); // Get the text content
                let shippingPrice = parseFloat(shippingPriceText.replace('$', '').trim()) || 0; // Convert to float

                // Calculate total price
                let totalPrice = subtotal + shippingPrice; // Ensure both are numbers
                $('#total-price').text('$' + totalPrice.toFixed(2)); // Update the total price display
                if(subtotal==0){
                    $('#no-product-in-cart').show();
                    $('#cart-product').hide();
                }else{
                    $('#no-product-in-cart').hide();
                    $('#cart-product').show();
                }

            }
            // =========end of Function to calculate the total subtotal from all cart items

            // ======Initial subtotal calculation on page load========
            calculateSubtotal();
            // =========End of Initial subtotal calculation on page load=====

        });
    </script>
@endsection
