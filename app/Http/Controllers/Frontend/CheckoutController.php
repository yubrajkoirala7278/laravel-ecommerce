<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderPlaced;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingCharge;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        try {
            if (!Auth::user()) {
                return back()->with('error', 'Please login to proceed checkout!!');
            }
            $cartsProducts = Cart::with('product')->latest()->where('user_id', Auth::user()->id)->get();
            $countries = Country::orderBy('name', 'asc')->get();
            $customerDetail = CustomerAddress::where('user_id', Auth::user()->id)->first();
            $countryName = CustomerAddress::where('user_id', Auth::user()->id)->value('country_name');
            $shippingCharge = ShippingCharge::where('country_name', $countryName)->value('amount');
            $couponId = UserCoupon::where('user_id', Auth::user()->id)->latest()->value('coupon_id');
            $couponDiscount=DiscountCoupon::where('id',$couponId)->latest()->value('discount_amount');
            return view('public.checkout.index', compact('cartsProducts', 'shippingCharge', 'countries', 'customerDetail','couponDiscount'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    // =======checkout=======
    public function checkoutProduct(CheckoutRequest $request)
    {
        try {
            //   save user addresses to database
            $user = Auth::user();
            $customerAddress=CustomerAddress::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'country_name' => $request->country_name,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'phone' => $request->phone,
                    'apartment' => $request->apartment
                ]
            );

            //  save order details to database
            if ($request->payment_method == 'cod') {
                $countryName = CustomerAddress::where('user_id', Auth::user()->id)->value('country_name');
                $shippingCharge = ShippingCharge::where('country_name', $countryName)->value('amount')??0;
                $couponId = UserCoupon::where('user_id', Auth::user()->id)->latest()->value('coupon_id');
                $couponDiscount=DiscountCoupon::where('id',$couponId)->latest()->value('discount_amount')??0;
                $subTotal = Cart::with('product')
                    ->where('user_id', $user->id)
                    ->get()
                    ->sum(function ($cartItem) {
                        return $cartItem->product->price * $cartItem->cart_count;
                    });
                $totalCharge = $shippingCharge + $subTotal - $couponDiscount;
                $order = Order::create([
                    'user_id' => $user->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'country_name' => $request->country_name,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'phone' => $request->phone,
                    'apartment' => $request->apartment,
                    'sub_total' => $subTotal,
                    'shipping_charge' => $shippingCharge,
                    'total_charge' => $totalCharge,
                    'coupon_discount' => $couponDiscount
                ]);

                // store order items in order items table
                $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
                foreach ($carts as $key => $cart) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'product_name' => $cart->product->title,
                        'qty' => $cart->cart_count,
                        'price' => $cart->product->price,
                        'total' => $cart->cart_count*$cart->product->price+$shippingCharge-$couponDiscount,
                    ]);
                    $product=Product::where('id',$cart->product_id)->first();
                    if($product->track_qty==true){
                        $product->update(
                            [
                                'qty'=>$product->qty-$cart->cart_count
                            ]
                        );
                    }
                    
                }
                event(new OrderPlaced($customerAddress,$carts,$shippingCharge,$subTotal,$couponDiscount,$totalCharge));
                Cart::where('user_id', Auth::user()->id)->delete();
                return view('public.checkout.order_success');
            } else {
                dd('pay with card');
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function getShippingCharge(Request $request)
    {
        try{
            $countryName = $request->input('country_name');
            $shippingCharge = ShippingCharge::where('country_name', $countryName)->value('amount')??0;
    
            return response()->json(['shipping_charge' => $shippingCharge]);
        }catch(\Throwable $th){
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
        
    }

    public function checkCouponStatus(Request $request)
    {
        $couponCode = $request->coupon_code;
        $userId = auth()->id(); // Get the currently authenticated user's ID
       
    
        // Find the coupon in the database
        $coupon = DiscountCoupon::where('code', $couponCode)
            ->where('starts_at', '<=', now())
            ->where('expires_at', '>=', now())
            ->first();
    
        if ($coupon) {
            
            // Check if the user has already used the coupon
            $userCouponUsage = UserCoupon::where('user_id', $userId)
                ->where('coupon_id', $coupon->id)
                ->exists();
    
            if ($userCouponUsage) {
                return response()->json([
                    'valid' => false,
                    'message' => 'Coupon has already been used.',
                ]);
            }
            UserCoupon::create([
                'user_id'=>$userId,
                'coupon_id'=>$coupon->id
            ]);
    
            // If coupon has not been used, return the discount amount
            return response()->json([
                'valid' => true,
                'discount_amount' => $coupon->discount_amount,
            ]);
        } else {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid Coupon Code or Expired!',
            ]);
        }
    }
    
}
