<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Country;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ShippingCharge::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('shipping.edit', $row->id) . '" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editShippingCharge">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteShippingCharge">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.shipping.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $countries = Country::orderBy('name', 'asc')->get();
            return view('admin.shipping.create', compact('countries'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingRequest $request)
    {
        try {
            ShippingCharge::create([
                'country_name' => $request['country_name'],
                'amount' => $request['amount']
            ]);
            return redirect()->route('shipping.index')->with('success', 'Shipping charge has been added!');
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
    public function edit($id)
    {
        try {
            $shippingCharge=ShippingCharge::find($id);
            $countries = Country::orderBy('name', 'asc')->get();
            return view('admin.shipping.edit',compact('shippingCharge','countries'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingRequest $request, string $id)
    {
       try{
        ShippingCharge::where('id',$id)->update([
            'country_name'=>$request['country_name'],
            'amount'=>$request['amount']
        ]);
        return redirect()->route('shipping.index')->with('success','Shipping charge has been updated!');
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ShippingCharge::find($id)->delete();
        return response()->json(['success'=>'Shipping charge has been deleted successfully.']);
    }
}
