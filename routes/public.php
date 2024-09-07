<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('frontend.home');
Route::get('/shop',[ShopController::class,'index'])->name('frontend.shop');

Route::get('/products',[ShopController::class,'products'])->name('frontend.products');