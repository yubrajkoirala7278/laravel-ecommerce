<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        try {
            if (!Auth::user()) {
                return back()->with('error', 'Please login to add items to cart!!');
            }
            $cartsProducts = Cart::with('product')->latest()->where('user_id', Auth::user()->id)->get();
            $shippingCharge=20;
            return view('public.cart.index', compact('cartsProducts','shippingCharge'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    // =============function to add items into cart when click on ADD TO CART BUTTON=============
    public function addToCart($id)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'You must be logged in to add items to the cart!'
                ], 401);
            }

            $product = Product::find($id);
            if (!$product) {
                return response()->json([
                    'error' => 'Product not found'
                ], 404);
            }

            $existingCartItem = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $id)
                ->first();

            if ($existingCartItem) {
                if ($existingCartItem->cart_count >= 5) {
                    return response()->json([
                        'error' => 'Only five items can be added to cart!'
                    ], 409);
                }
                $existingCartItem->cart_count += 1;
                $existingCartItem->save();
            } else {
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => (int) $id,
                    'cart_count' => 1
                ]);
            }

            // Calculate total cart count
            $totalCartCount = Cart::where('user_id', Auth::user()->id)->sum('cart_count');

            return response()->json([
                'success' => 'Product has been added to cart!',
                'total_cart_count' => $totalCartCount
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    // =============End of function to add items into cart when click on ADD TO CART BUTTON=============

    // ==================function to remove item from cart when click on minus button================
    public function removeFromCart($id)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'You must be logged in to update the cart!'
                ], 401);
            }

            $cartItem = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $id)
                ->first();

            if ($cartItem) {
                if ($cartItem->cart_count > 1) {
                    $cartItem->cart_count -= 1;
                    $cartItem->save();
                } else {
                    return response()->json([
                        'error' => 'Cannot have less than 1 item in the cart!'
                    ], 409);
                }

                // Calculate total cart count
                $totalCartCount = Cart::where('user_id', Auth::user()->id)->sum('cart_count');

                return response()->json([
                    'success' => 'Product quantity decreased!',
                    'total_cart_count' => $totalCartCount
                ], 200);
            }

            return response()->json([
                'error' => 'Product not found in the cart!'
            ], 404);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    // ==================end of function to remove item from cart when click on minus button================


    // ==========function to remove item from cart when click on cross button====================
    public function removeItemFromCart($id)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'You must be logged in to remove items from the cart!'
                ], 401);
            }

            // Find the cart item
            $cartItem = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $id)
                ->first();

            if ($cartItem) {
                $cartItem->delete();

                // Calculate total cart count after item is removed
                $totalCartCount = Cart::where('user_id', Auth::user()->id)->sum('cart_count');

                // Optionally, calculate total price of items in the cart if needed
                $totalPrice = Cart::where('user_id', Auth::user()->id)
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->sum(DB::raw('carts.cart_count * products.price'));

                return response()->json([
                    'success' => 'Item removed from cart!',
                    'total_cart_count' => $totalCartCount,
                    'total_price' => $totalPrice
                ], 200);
            }

            return response()->json([
                'error' => 'Product not found in the cart!'
            ], 404);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    // ==========end of function to remove item from cart when click on cross button====================



    // ========function to get total number of items added on cart of individual user==============
    public function getCartCount()
    {
        if (Auth::check()) {
            // Get the sum of cart_count for all items in the cart for the logged-in user
            $cartCount = Cart::where('user_id', Auth::user()->id)->sum('cart_count');

            return response()->json([
                'cartCount' => $cartCount
            ]);
        }

        return response()->json([
            'cartCount' => 0
        ]);
    }
    // ========end of function to get total number of items added on cart of individual user==============

    // ===========Function to Handle manual input change in cart count============
    public function updateCartCount(Request $request, $id)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'You must be logged in to update the cart!'
                ], 401);
            }

            $cartItem = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $id)
                ->first();

            if ($cartItem) {
                $cartCount = (int) $request->input('cart_count');

                if ($cartCount <= 0) {
                    return response()->json([
                        'error' => 'The cart count must be at least 1!'
                    ], 400);
                }else if($cartCount>5){
                    return response()->json([
                        'error' => 'The cart count should not be greater than 5!',
                        'cart_count' => $cartItem->cart_count
                    ], 400);
                }

                $cartItem->cart_count = $cartCount;
                $cartItem->save();

                // Calculate total cart count
                $totalCartCount = Cart::where('user_id', Auth::user()->id)->sum('cart_count');

                return response()->json([
                    'success' => 'Cart count updated!',
                    'total_cart_count' => $totalCartCount
                ], 200);
            }

            return response()->json([
                'error' => 'Product not found in the cart!'
            ], 404);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
    // ===========End of function to Handle manual input change in cart count============
}
