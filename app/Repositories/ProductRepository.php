<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
   private $imageRepository;

   public function __construct(ImageRepositoryInterface $imageRepository)
   {
      $this->imageRepository = $imageRepository;
   }

   public function all()
   {
      $products = Product::latest()->with('category', 'brand', 'subCategory')->get();
      return $products;
   }

   public function store($request)
   {
      // store single image in storage folder
      if (isset($request['image'])) {
         $timestamps = now()->timestamp;
         $originalName = $request['image']->getClientOriginalName();
         $imageName = $timestamps . '-' . $originalName;
         $request['image']->storeAs('public/images/products', $imageName);
      }

      // store in db
      $product = Product::create([
         'title' => $request['title'],
         'slug' => $request['slug'],
         'description' => $request['description'],
         'shipping_returns' => $request['shipping_returns'],
         'price' => $request['price'],
         'compare_price' => $request['compare_price'] ? $request['compare_price'] : null,
         'category_id' => $request['category'],
         'sub_category_id' => $request['sub_category'] ? $request['sub_category'] : null,
         'brand_id' => $request['brand'],
         'is_featured' => $request['featured'],
         'track_qty' => $request['track_qty'],
         'qty' => $request['qty'],
         'status' => $request['status'],
         'image' => $imageName,
         'max_item_add_to_cart'=>$request['max_item_add_to_cart']??5
      ]);

      if (isset($request['images'])) {
         $this->imageRepository->addImages($product, $request['images'], 'product');
      }

   }

   public function destroy($product)
   {
      $product = Product::with('images')->find($product->id);
      if (!empty($product['images'])) {
         $this->imageRepository->deleteImages($product['images']);
     }
      if (isset($product->image)) {
         Storage::delete('public/images/products/' . $product->image);
      }

      $product->delete();
   }

   public function update($request, $product)
   {
      // store single image
      $imageName = null;
      if (isset($request['image'])) {
         // Delete the old image from storage folder
         Storage::delete('public/images/products/' . $product->image);
         // Store the new image
         $timestamp = now()->timestamp;
         $originalName = $request['image']->getClientOriginalName();
         $imageName = $timestamp . '-' . $originalName;
         $request['image']->storeAs('public/images/products', $imageName);
      }
      $product->update([
         'title' => $request['title'],
         'slug' => $request['slug'],
         'description' => $request['description'],
         'shipping_returns' => $request['shipping_returns'],
         'price' => $request['price'],
         'compare_price' => $request['compare_price'] ? $request['compare_price'] : null,
         'category_id' => $request['category'],
         'sub_category_id' => $request['sub_category'] ? $request['sub_category'] : null,
         'brand_id' => $request['brand'],
         'is_featured' => $request['featured'],
         'track_qty' => $request['track_qty'],
         'qty' => $request['qty'],
         'status' => $request['status'],
         'image' => $imageName ? $imageName : $product->image,
      ]);
      if (!empty($request['images'])) {
         $this->imageRepository->updateImages($product, $request['images'], 'product',true);
     }
   }

   public function requiredData()
   {
      $categories = Category::latest()->get();
      $subcategories = SubCategory::latest()->get();
      $brands = Brand::latest()->get();
      return [
         'categories' => $categories,
         'subcategories' => $subcategories,
         'brands' => $brands
      ];
   }

   public function categoryWithSubCategories()
   {
      $categories_with_subCategories = Category::with(['subCategory' => function ($query) {
         $query
            ->where('status', 1);
      }])
         ->select('id', 'slug', 'name')
         ->where('status', 1)
         ->latest()
         ->get();
      return $categories_with_subCategories;
   }



   public function requiredFrontendData()
   {
      $categories = Category::withCount('products')
         ->where('status', 1)
         ->having('products_count', '>', 0)
         ->latest()
         ->take(8)
         ->get();

      $featuredProducts = Product::where('is_featured', 'Yes')
         ->where('status', 1)
         ->latest()
         ->take(8)
         ->get();

      $latestProducts = Product::where('status', 1)->latest()->take(8)->get();
      return [
         'categories' => $categories,
         'featuredProducts' => $featuredProducts,
         'latestProducts' => $latestProducts,
      ];
   }

   public function requiredShopData()
   {
      // get all the categories where status=1 and get all it's subCategories whose status=1
      $categories = Category::with(['subCategory' => function ($query) {
         $query->where('status', 1);
      }])->where('status', 1)->latest()->get();

      $brands = Brand::latest()->get();

      $products = Product::where('status', 1)->latest()->paginate(10);

      return [
         'categories' => $categories,
         'brands' => $brands,
         'products' => $products
      ];
   }

   public function products()
   {
      dd('i am here');
   }
}
