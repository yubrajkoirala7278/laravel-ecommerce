<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class HomeController extends Controller
{
    private $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }
    public function index(){
        try{
            $categories=$this->productRepository->categoryWithSubCategories();
            $requiredData=$this->productRepository->requiredFrontendData();
            return view('public.home.index',compact('requiredData','categories'));
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
        
    }
}
