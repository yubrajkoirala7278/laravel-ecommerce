<?php

namespace App\Repositories\Interfaces;

Interface ProductRepositoryInterface{
    public function all();
    public function store($request);
    public function destroy($product);
    public function update($request, $product);
    public function requiredData();
    public function requiredFrontendData();
    public function requiredShopData();
    public function categoryWithSubCategories();
    public function products();
}