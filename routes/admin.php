<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DiscountCouponController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/orders',[OrderController::class,'index'])->name('admin.orders');
Route::get('/orders/{id}',[OrderController::class,'view'])->name('admin.orders.view');
Route::put('/status/update/{id}',[OrderController::class,'updateStatus'])->name('admin.update.status');
Route::get('/users',[UserController::class,'index'])->name('admin.users');
Route::delete('/user/{id}',[UserController::class,'destroy'])->name('admin.user.destroy');


Route::resources([
    'category'=>CategoryController::class,
    'sub_category'=>SubCategoryController::class,
    'brands'=>BrandController::class,
    'products'=>ProductController::class,
    'shipping'=>ShippingController::class,
    'coupon_discount'=>DiscountCouponController::class,
    'page'=>PageController::class,
]);