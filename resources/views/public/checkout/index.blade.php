@extends('public.layouts.master')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                        <li class="breadcrumb-item">Checkout</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-9 pt-4">
            <div class="container">
                <form action="{{ route('frontend.checkout.products') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="sub-title">
                                <h2>Shipping Address</h2>
                            </div>
                            <div class="card shadow-lg border-0">
                                <div class="card-body checkout-form">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="first_name" id="first_name" class="form-control"
                                                    placeholder="First Name"
                                                    value="{{ old('first_name', $customerDetail->first_name ?? '') }}">
                                                @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="last_name" id="last_name" class="form-control"
                                                    placeholder="Last Name"
                                                    value="{{ old('last_name', $customerDetail->last_name ?? '') }}">
                                                @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Email"
                                                    value="{{ old('email', $customerDetail->email ?? '') }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <select name="country_name" id="country" class="form-control">
                                                    <option value="" disabled selected>Select a Country</option>
                                                    @if (count($countries) > 0)
                                                        @foreach ($countries as $country)
                                                            <option @selected(old('country_name', $customerDetail->country_name ?? '') == $country->name)
                                                                value="{{ $country->name }}">{{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('country_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ old('address', $customerDetail->address ?? '') }}</textarea>
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="apartment" id="apartment" class="form-control"
                                                    placeholder="Apartment, suite, unit, etc. (optional)"
                                                    value="{{ old('apartment', $customerDetail->apartment ?? '') }}">
                                                @error('apartment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="city" id="city" class="form-control"
                                                    placeholder="City"
                                                    value="{{ old('city', $customerDetail->city ?? '') }}">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="state" id="state" class="form-control"
                                                    placeholder="State"
                                                    value="{{ old('state', $customerDetail->state ?? '') }}">
                                                @error('state')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="zip" id="zip" class="form-control"
                                                    placeholder="Zip" value="{{ old('zip', $customerDetail->zip ?? '') }}">
                                                @error('zip')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="phone" id="phone" class="form-control"
                                                    placeholder="Mobile No."
                                                    value="{{ old('phone', $customerDetail->phone ?? '') }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        {{-- <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div> --}}

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sub-title">
                                <h2>Order Summery</h3>
                            </div>
                            <div class="card cart-summery">
                                <div class="card-body">
                                    @if (count($cartsProducts) > 0)
                                        @foreach ($cartsProducts as $cartProduct)
                                            <div class="d-flex justify-content-between pb-2 cart-item">
                                                <div class="h6">
                                                    {{ $cartProduct->product->title }} X
                                                    <span class="cart-count"
                                                        data-count="{{ $cartProduct->cart_count }}">{{ $cartProduct->cart_count }}</span>
                                                </div>
                                                <div class="h6">
                                                    $<span class="product-total"
                                                        data-price="{{ $cartProduct->product->price }}">
                                                        {{ $cartProduct->cart_count * $cartProduct->product->price }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="d-flex justify-content-between summery-end">
                                        <div class="h6"><strong>Subtotal</strong></div>
                                        <div class="h6"><strong>$<span id="subtotal"></span></strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="h6"><strong>Shipping</strong></div>
                                        <div class="h6"><strong>$ <span
                                                    id="shipping-charge">{{ $shippingCharge ?? 0.0 }}</span></strong>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="h6"><strong>Discount</strong></div>
                                        <div class="h6"><strong>$ <span id="discount-amount">{{$couponDiscount??0}}</span></strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 summery-end">
                                        <div class="h5"><strong>Total</strong></div>
                                        <div class="h5"><strong>$<span id="total-charge">0</span></strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group apply-coupan mt-4">
                                <input type="text" placeholder="Coupon Code" class="form-control">
                                <button class="btn btn-dark" type="button" id="coupon-btn">Apply Coupon</button>
                            </div>

                            <div class="card payment-form ">
                                <h3 class="card-title h5 mb-3">Payment Method</h3>
                                <div>
                                    <input type="radio" name="payment_method" value="cod" id="payment_method_one"
                                        onclick="togglePaymentDetails()">
                                    <label for="payment_method_one" class="form-check-label">COD</label>
                                </div>
                                <div>
                                    <input type="radio" name="payment_method" value="stripe" id="payment_method_two"
                                        onclick="togglePaymentDetails()" checked>
                                    <label for="payment_method_two" class="form-check-label">Stripe</label>
                                </div>

                                <div class="card-body p-0 mt-2" id="payment-details" style="display:none;">
                                    <div class="mb-3">
                                        <label for="card_number" class="mb-2">Card Number</label>
                                        <input type="text" name="card_number" id="card_number"
                                            placeholder="Valid Card Number" class="form-control">
                                        @error('card_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="expiry_date" class="mb-2">Expiry Date</label>
                                            <input type="text" name="expiry_date" id="expiry_date"
                                                placeholder="MM/YYYY" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="expiry_date" class="mb-2">CVV Code</label>
                                            <input type="text" name="expiry_date" id="expiry_date" placeholder="123"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                                </div>
                            </div>


                            <!-- CREDIT CARD FORM ENDS HERE -->

                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ==========function to calculate subtotal and total charge=========
            function calculateSubtotal() {
                let subtotal = 0;
                let shippingChargeElement = document.getElementById('shipping-charge');
                let discountAmountElement=document.getElementById('discount-amount');
                let shippingCharge = parseFloat(shippingChargeElement.textContent) || 0;
                let discountAmount = parseFloat(discountAmountElement.textContent) || 0;

                // Get all product totals
                document.querySelectorAll('.cart-item').forEach(function(item) {
                    let count = parseInt(item.querySelector('.cart-count').getAttribute('data-count')) || 0;
                    let price = parseFloat(item.querySelector('.product-total').getAttribute(
                        'data-price')) || 0;

                    subtotal += count * price;
                });

                // Update subtotal in the view
                document.getElementById('subtotal').textContent = subtotal.toFixed(2);

                // Update total charge in the view
                let totalCharge = shippingCharge + subtotal -discountAmount;
                document.getElementById('total-charge').innerText = totalCharge.toFixed(2);
            }
            // ========== end of function to calculate subtotal and total charge ==========

            // ========== function to toggle payment details ==========
            function togglePaymentDetails() {
                const paymentDetails = document.getElementById('payment-details');
                const stripeRadio = document.getElementById('payment_method_two');

                // Show payment details if 'Stripe' is selected, otherwise hide it
                if (stripeRadio && stripeRadio.checked) {
                    paymentDetails.style.display = 'block';
                } else if (paymentDetails) {
                    paymentDetails.style.display = 'none';
                }
            }
            // ========== end of function to toggle payment details ==========

            // ========== AJAX request for getting shipping charge ==========
            function updateShippingCharge() {
                const countryName = document.getElementById('country').value;

                if (countryName) {
                    $.ajax({
                        url: '{{ route('getShippingCharge') }}',
                        type: 'GET',
                        data: {
                            country_name: countryName
                        },
                        success: function(response) {
                            document.getElementById('shipping-charge').textContent = response
                                .shipping_charge;
                            calculateSubtotal();
                        },
                        error: function() {
                            toastify().error('Something went wrong!');
                        }
                    });
                }
            }
            // ========== end of AJAX request for getting shipping charge ==========

            // =====Event listeners for country change and payment method change=========
            $(document).ready(function() {
                $('#country').change(function() {
                    updateShippingCharge();
                });

                // Initial calculation on page load
                calculateSubtotal();

                // Toggle payment details on page load and when the payment method changes
                togglePaymentDetails();
                // Event listener for payment method change
                document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
                    radio.addEventListener('change', togglePaymentDetails);
                });
            });
            // ========end of Event listeners for country change and payment method change=========

            // =============check coupon status==================
            $('#coupon-btn').on('click', function() {
                var couponCode = $('input[placeholder="Coupon Code"]').val();

                $.ajax({
                    url: "{{ route('check.coupon.status') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        coupon_code: couponCode
                    },
                    success: function(response) {
                        if (response.valid) {
                            $('#discount-amount').text(response.discount_amount);
                            let totalChargeAfterDiscount=$('#total-charge').text()-response.discount_amount;
                            document.getElementById('total-charge').innerText = totalChargeAfterDiscount.toFixed(2);
                        } else {
                            toastify().error(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastify().error(xhr.statusText);
                    }
                });
            });
            // ==========end of check coupon status==========
        });
    </script>
@endsection
