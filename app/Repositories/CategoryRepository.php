<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements CategoryRepositoryInterface
{

   public function all()
   {
      $categories = Category::latest();
      return $categories;
   }

   public function store($request)
   {
      // store single image in storage folder
      if (isset($request['image'])) {
         $timestamps = now()->timestamp;
         $originalName = $request['image']->getClientOriginalName();
         $imageName = $timestamps . '-' . $originalName;
         $request['image']->storeAs('public/images/category', $imageName);
         // update the image name in the $request array
         $request['image'] = $imageName;
      }
     
      // store in db
      Category::create($request);
   }

   public function destroy($category)
   {
      // delete image from local storage
      if (isset($category->image)) {
         Storage::delete('public/images/category/' . $category->image);
      }
      $category->delete();
   }

   public function update($request, $category)
   {
      if (isset($request['image'])) {
         // Delete the old image from storage folder
         Storage::delete('public/images/category/' . $category->image);
         // Store the new image
         $timestamp = now()->timestamp;
         $originalName = $request['image']->getClientOriginalName();
         $imageName = $timestamp . '-' . $originalName;
         $request['image']->storeAs('public/images/category', $imageName);
         // Update the image name in the $request array
         $request['image'] = $imageName;
      }
      $category->update($request);
   }
}
