<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function orders()
    {
        try {
            $orders = Order::where('user_id', Auth::user()->id)->latest()->get();
            return view('public.auth.order', compact('orders'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function orderDetails($id)
    {
        $order = Order::with('order_items.product')->where('id', $id)->first();
        return view('public.auth.order_details', compact('order'));
    }

    public function myAccount()
    {
        try {
            $user = User::with('customer_address')->where('id', Auth::user()->id)->first();
            return view('public.auth.account', compact('user'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function updatePassword()
    {
        try {
            return view('public.auth.update_password');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function myWishList()
    {
        try {
            $wishlists = Wishlist::with('product')->latest()->get();
            return view('public.auth.wishlist', compact('wishlists'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            User::where('id', Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            CustomerAddress::where('user_id', Auth::user()->id)->update([
                'address' => $request->address,
                'phone' => $request->phone
            ]);
            return back()->with('success', 'Profile updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function removeWishListProduct($id)
    {
        try {
            Wishlist::where('id', $id)->delete();
            return back()->with('success', 'Product removed from wishlist!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function updateUserProfilePassword(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'The new password and confirm password do not match.',
        ]);
        try {
            $user = Auth::user();

            // Check if the old password matches the user's current password
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'The provided old password does not match our records.']);
            }

            // Update the password
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return back()->with('success', 'Password updated successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
