<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice</title>
</head>

<body>
    <div
        style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
        <!-- Email Header -->
        <div style="background-color: #4CAF50; color: white; padding: 20px; text-align: center;">
            <h1 style="margin: 0;">Thank you for your order!</h1>
        </div>

        <!-- Email Body -->
        <div style="padding: 20px;">
            <h2>Your Order ID: <span style="color: #4CAF50;">#5</span></h2>

            <!-- Shipping Address -->
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px;">Shipping Address</h3>
            <p><strong>{{ $customerAddress->first_name }} {{ $customerAddress->last_name }}</strong></p>
            <p>{{ $customerAddress->apartment }}, {{ $customerAddress->city }}, {{ $customerAddress->country_name }}</p>
            <p>{{ $customerAddress->state }}, {{ $customerAddress->zip }}</p>
            <p><strong>Phone:</strong> {{ $customerAddress->phone }}</p>
            <p><strong>Email:</strong> {{ $customerAddress->email }}</p>

            <!-- Products Section -->
            <h3 style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-top: 30px;">Products</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Product</th>
                        <th style="padding: 10px; text-align: right; border: 1px solid #ddd;" width="100">Price</th>
                        <th style="padding: 10px; text-align: right; border: 1px solid #ddd;" width="100">Qty</th>
                        <th style="padding: 10px; text-align: right; border: 1px solid #ddd;" width="100">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($carts as $cart)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $cart['product']['title'] ?? 'N/A' }}</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">
                            ${{ $cart['product']['price'] ?? '0.00' }}
                        </td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">
                            {{ $cart['cart_count'] ?? '0' }}
                        </td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">
                            ${{ ($cart['product']['price'] ?? 0) * ($cart['cart_count'] ?? 0) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 10px; border: 1px solid #ddd; text-align: center;">No items in cart</td>
                    </tr>
                @endforelse
                

                    <!-- Subtotal -->
                    <tr>
                        <th colspan="3" style="padding: 10px; text-align: right; border: 1px solid #ddd;">Subtotal:
                        </th>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">${{ $subTotal }}</td>
                    </tr>
                    <!-- Shipping -->
                    <tr>
                        <th colspan="3" style="padding: 10px; text-align: right; border: 1px solid #ddd;">Shipping:
                        </th>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">${{ $shippingCharge }}
                        </td>
                    </tr>
                    <!-- Coupon Discount -->
                    <tr>
                        <th colspan="3" style="padding: 10px; text-align: right; border: 1px solid #ddd;">Coupon
                            Discount:</th>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">${{ $couponDiscount }}
                        </td>
                    </tr>
                    <!-- Grand Total -->
                    <tr style="background-color: #f9f9f9; font-weight: bold;">
                        <th colspan="3" style="padding: 10px; text-align: right; border: 1px solid #ddd;">Grand
                            Total:</th>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">${{ $totalCharge }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Email Footer -->
        <div style="background-color: #f9f9f9; padding: 20px; text-align: center; color: #777;">
            Regards, <br>
            <strong>Company Name</strong><br>
            <p style="margin-top: 10px; color: #555;">1234 Street Name, City, Country</p>
            <p style="margin-top: 0;">Email: support@company.com</p>
        </div>
    </div>
</body>

</html>
