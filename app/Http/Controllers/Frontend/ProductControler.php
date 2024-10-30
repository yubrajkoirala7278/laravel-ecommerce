<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductControler extends Controller
{
    public function index($slug){
        $product=Product::with('images')->where('slug',$slug)->first();
        $relatedProducts = Product::latest()
        ->with('images')
        ->where('category_id', $product->category_id)
        ->where('id', '!=', $product->id) // Exclude the current product by ID
        ->get();
        return view('public.product.index',compact('product','relatedProducts'));
    }
}
