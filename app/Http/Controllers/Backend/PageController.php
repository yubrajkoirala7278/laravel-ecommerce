<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StaticPage::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('page.edit', $row->id) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editStaticPage">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteStaticPage">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.static_pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.static_pages.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            StaticPage::create([
                'name' => $request['name'],
                'slug' => $request['slug'],
                'content' => $request['content']
            ]);
            return redirect()->route('page.index')->with('success', 'Static page has been added!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $staticPage=StaticPage::find($id);
            return view('admin.static_pages.edit',compact('staticPage'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            StaticPage::where('id',$id)->update([
                'name' => $request['name'],
                'slug' => $request['slug'],
                'content' => $request['content']
            ]);
            return redirect()->route('page.index')->with('success','Static page has been updated!');
           }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
           }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StaticPage::find($id)->delete();
        return response()->json(['success'=>'Static page has been deleted successfully.']);
    }
}
