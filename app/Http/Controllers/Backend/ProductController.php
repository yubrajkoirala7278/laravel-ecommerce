<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $product = $this->productRepository->all();
                return DataTables::of($product)
                    ->addIndexColumn()
                    ->addColumn('category_name', function ($product) {
                        return $product->category ? $product->category->name : 'N/A';
                    })
                    ->addColumn('sub_category_name', function ($product) {
                        return $product->subcategory ? $product->subcategory->name : 'N/A';
                    })
                    ->addColumn('brand_name', function ($product) {
                        return $product->brand ? $product->brand->name : 'N/A';
                    })
                    ->addColumn('track_qty', function ($product) {
                        return $product->track_qty===1 ? 'Yes' : 'No';
                    })
                    ->addColumn('action', function ($row) {
                        $viewUrl = route('products.show',  $row->slug);
                        $editUrl = route('products.edit', $row->slug);
                        return '
                            <a href="' . $editUrl . '" class="btn btn-info editButton">Edit</a> 
                            <a href="javascript:void(0)" class="btn btn-danger delButton" data-slug="' . $row->slug . '">Delete</a> 
                            <a href="' . $viewUrl . '" class="btn btn-success">View</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.products.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $requiredData=$this->productRepository->requiredData();
            return view('admin.products.create',compact('requiredData'));
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try{
           $this->productRepository->store($request->validated());
           return redirect()->route('products.index')->with('success','Product added successfully!');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try{
            return view('admin.category.show',compact('product'));
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        try {
            $requiredData=$this->productRepository->requiredData();
            return view('admin.products.edit', compact('product','requiredData'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        try{
           $this->productRepository->update($request->validated(),$product);
           return redirect()->route('products.index')->with('success','Product updated successfully!');
        }catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            $this->productRepository->destroy($product);
            return response()->json(['success' => 'Product deleted successfully!']);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
