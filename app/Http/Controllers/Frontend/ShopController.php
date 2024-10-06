<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ShopController extends Controller
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
            $requiredShopData = $this->productRepository->requiredShopData();
            return view('public.shop.index', compact('requiredData', 'requiredShopData'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function products(Request $request)
    {
        $query = Product::with('brand', 'category', 'subCategory');
        

        // =======Apply search filter=======
        if ($request->search) {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('price', 'LIKE', '%' . $request->search . '%');
        }

        // =====Apply brand filter from checkbox=========
        if ($request->brands) {
            $query->whereIn('brand_id', $request->brands);
        }

        // ====Apply category filter from radio button======
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // ======Apply price range filter from slider range======
        if ((int)$request->min_price >= 0 && $request->max_price) {
            $query->whereBetween('price', [(int)$request->min_price, (int)$request->max_price]);
        }

        // ========Apply sorting from select field=========
        switch ($request->sort_by) {
            case 'Price High':
                $query->orderBy('price', 'desc');
                break;
            case 'Price Low':
                $query->orderBy('price', 'asc');
                break;
            case 'Latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // =======Paginate the results============
        $products = $query->paginate(4);

        // =========return products with pagination=======
        return response()->json([
            'products' => $products->items(),
            'pagination' => (string) $products->links('pagination::bootstrap-5')
        ]);
    }
}
