<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        try {
            $requiredData = $this->productRepository->requiredFrontendData();
            return view('public.home.index', compact('requiredData'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function addToWishList($id)
    {
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $userId = Auth::user()->id;

            // Check if the product is already in the user's wishlist
            $existingWishlistItem = Wishlist::where('user_id', $userId)
                ->where('product_id', $id)
                ->first();

            if ($existingWishlistItem) {
                return response()->json(['error' => 'Product already in wishlist'], 400);
            }

            // Add the product to the wishlist
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $id
            ]);

            $productTitle = Product::where('id', $id)->value('title');

            return response()->json([
                'product_name' => $productTitle
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
