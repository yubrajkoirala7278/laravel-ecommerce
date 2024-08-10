<?php

namespace App\Repositories\Interfaces;

Interface SubCategoryRepositoryInterface{
    public function all();
    public function store($request);
    public function destroy($SubCategory);
    public function update($request, $product);
    public function getCategories();
}