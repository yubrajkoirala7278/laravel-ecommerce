<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function all()
    {
        return SubCategory::with('category')->latest();
    }

    public function store($request)
    {
        SubCategory::create($request);
    }

    public function destroy($SubCategory)
    {
        $SubCategory->delete();
    }

    public function update($request, $category)
    {
        $category->update($request);
    }

    public function getCategories()
    {
        return Category::latest()->get();
    }
}
