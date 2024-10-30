<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductControler;
use App\Http\Controllers\Frontend\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('frontend.home');
Route::get('/shop',[ShopController::class,'index'])->name('frontend.shop');
Route::get('/contact-us',[ContactController::class,'index'])->name('frontend.contactus');
Route::post('/contact-us',[ContactController::class,'contact'])->name('frontend.contact');

Route::get('/products',[ShopController::class,'products'])->name('frontend.products');
Route::get('/product/{slug}',[ProductControler::class,'index'])->name('frontend.product');
Route::get('/cart',[CartController::class,'index'])->name('frontend.cart');
Route::get('/add-to-cart/{id}',[CartController::class,'addToCart'])->name('frontend.addToCart');
Route::get('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('frontend.removeFromCart');
Route::get('/remove-item-from-cart/{id}', [CartController::class, 'removeItemFromCart'])->name('frontend.removeItemFromCart');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('frontend.getCartCount');
Route::post('/update-cart-count/{id}', [CartController::class, 'updateCartCount'])->name('cart.update.count');
Route::get('/checkout',[CheckoutController::class,'index'])->name('frontend.checkout');
Route::post('/checkout-products',[CheckoutController::class,'checkoutProduct'])->name('frontend.checkout.products');
Route::get('/get-shipping-charge', [CheckoutController::class, 'getShippingCharge'])->name('getShippingCharge');
Route::post('/check-coupon-status', [CheckoutController::class, 'checkCouponStatus'])->name('check.coupon.status');
Route::get('/my-orders',[AuthController::class,'orders'])->name('frontend.orders');
Route::get('/my-order-details/{id}',[AuthController::class,'orderDetails'])->name('frontend.my_order_details');
Route::post('/add-to-wishlist/{id}', [HomeController::class, 'addToWishList'])->name('addToWishList');
Route::get('/my-account',[AuthController::class,'myAccount'])->name('frontend.my_account');
Route::get('/update-password',[AuthController::class,'updatePassword'])->name('frontend.update.password');
Route::get('/my-wishlist',[AuthController::class,'myWishList'])->name('frontend.wishlist');
Route::put('/update-profile',[AuthController::class,'updateProfile'])->name('frontend.update.profile');
Route::delete('/remove-wishlist-product/{id}',[AuthController::class,'removeWishListProduct'])->name('frontend.wishlist.remove');
Route::put('/update-user-password',[AuthController::class,'updateUserProfilePassword'])->name('frontend.update.user.password');
Route::get('/about-us',[HomeController::class,'aboutUs'])->name('frontend.aboutus');
Route::get('/terms-and-conditions',[HomeController::class,'termsAndConditions'])->name('frontend.terms_and_conditions');