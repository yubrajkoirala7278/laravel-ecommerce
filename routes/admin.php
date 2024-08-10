<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resources([
    'category'=>CategoryController::class,
    'sub_category'=>SubCategoryController::class,
    'brands'=>BrandController::class,
    'products'=>ProductController::class,
]);