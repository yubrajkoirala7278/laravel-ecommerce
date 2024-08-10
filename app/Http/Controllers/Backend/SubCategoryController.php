<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    private $subCategoryRepository;
    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository) {
        $this->subCategoryRepository = $subCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
                if ($request->ajax()) {
                    $category = $this->subCategoryRepository->all();
                    return DataTables::of($category)
                        ->addIndexColumn()
                        ->addColumn('action', function ($row) {
                            $viewUrl = route('sub_category.show',  $row->slug);
                            $editUrl = route('sub_category.edit', $row->slug);
                            return '
                                <a href="' . $editUrl . '" class="btn btn-info editButton">Edit</a> 
                                <a href="javascript:void(0)" class="btn btn-danger delButton" data-slug="' . $row->slug . '">Delete</a> 
                                <a href="' . $viewUrl . '" class="btn btn-success">View</a>';
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
            return view('admin.sub_category.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories=$this->subCategoryRepository->getCategories();
            return view('admin.sub_category.create',compact('categories'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        try{
           $this->subCategoryRepository->store($request->validated());
           return redirect()->route('sub_category.index')->with('success','Sub category created successfully!');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $SubCategory)
    {
        try{
            return view('admin.sub_category.show',compact('SubCategory'));
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $SubCategory)
    {
       try{
        $categories=$this->subCategoryRepository->getCategories();
        return view('admin.sub_category.edit',compact('SubCategory','categories'));
       }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        try{
            $this->subCategoryRepository->update($request->validated(),$subCategory);
            return redirect()->route('sub_category.index')->with('success','SubCategory updated successfully!');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $SubCategory)
    {
        try {
            $this->subCategoryRepository->destroy($SubCategory);
            return response()->json(['success' => 'Sub category deleted successfully!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
