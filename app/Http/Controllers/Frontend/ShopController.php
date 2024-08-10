<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ShopController extends Controller
{
    private $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }
    public function index(){
        try{
            $categories=$this->productRepository->categoryWithSubCategories();
            $requiredData=$this->productRepository->requiredFrontendData();
            $requiredShopData=$this->productRepository->requiredShopData();
            return view('public.shop.index',compact('requiredData','requiredShopData','categories'));
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }
}
