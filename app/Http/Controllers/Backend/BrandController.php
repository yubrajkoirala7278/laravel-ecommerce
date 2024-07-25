<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $brandRepository;
    public function __construct(BrandRepositoryInterface $brandRepository) {
        $this->brandRepository = $brandRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            if ($request->ajax()) {
                $brands = $this->brandRepository->all();
                return DataTables::of($brands)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $viewUrl = route('brands.show',  $row->slug);
                        $editUrl = route('brands.edit', $row->slug);
                        return '
                            <a href="' . $editUrl . '" class="btn btn-info editButton">Edit</a> 
                            <a href="javascript:void(0)" class="btn btn-danger delButton" data-slug="' . $row->slug . '">Delete</a> 
                            <a href="' . $viewUrl . '" class="btn btn-success">View</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.brands.index');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       try{
        return view('admin.brands.create');
       }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
       try{
        $this->brandRepository->store($request->validated());
        return redirect()->route('brands.index')->with('success','Brand created successfully!');
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        try{
            return view('admin.brands.show',compact('brand'));
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
           }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        try{
            return view('admin.brands.edit',compact('brand'));
        }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        try{
            $this->brandRepository->update($request->validated(),$brand);
            return redirect()->route('brands.index')->with('success','Brand updated successfully!');
        }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
       try{
        $this->brandRepository->destroy($brand);
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }
}
