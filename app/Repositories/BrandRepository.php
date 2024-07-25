<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{

   public function all()
   {
      $brands = Brand::latest();
      return $brands;
   }

   public function store($request)
   { 
      Brand::create($request);
   }

   public function destroy($brand)
   {
      $brand->delete();
   }

   public function update($request, $brand)
   {
      $brand->update($request);
   }
}
