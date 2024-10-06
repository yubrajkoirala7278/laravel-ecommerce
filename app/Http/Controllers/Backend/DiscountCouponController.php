<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountCouponRequest;
use App\Models\DiscountCoupon;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DiscountCoupon::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('coupon_discount.edit', $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteCouponDiscount">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.coupon_discount.index');
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.coupon_discount.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountCouponRequest $request)
    {
        try {
            $startTimestamp = Carbon::createFromFormat('Y-m-d H:i', $request['starts_at']);
            $expireTimestamp = Carbon::createFromFormat('Y-m-d H:i', $request['expires_at']);
            DiscountCoupon::create([
                'code' => $request['code'],
                'name' => $request['name'],
                'description' => $request['description'],
                'max_uses' => $request['max_uses'],
                'max_uses_user' => $request['max_uses_user'],
                'type' => $request['type'],
                'discount_amount' => $request['discount_amount'],
                'min_amount' => $request['min_amount'],
                'status' => $request['status'],
                'starts_at' => $startTimestamp,
                'expires_at' => $expireTimestamp
            ]);
            return redirect()->route('coupon_discount.index')->with('success', 'Discount coupon added successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $couponDiscount=DiscountCoupon::where('id',$id)->first();
            return view('admin.coupon_discount.edit',compact('couponDiscount'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountCouponRequest $request, string $id)
    {
        try{
            $startTimestamp = Carbon::createFromFormat('Y-m-d H:i', $request['starts_at']);
            $expireTimestamp = Carbon::createFromFormat('Y-m-d H:i', $request['expires_at']);
            DiscountCoupon::where('id',$id)->update([
                'code' => $request['code'],
                'name' => $request['name'],
                'description' => $request['description'],
                'max_uses' => $request['max_uses'],
                'max_uses_user' => $request['max_uses_user'],
                'type' => $request['type'],
                'discount_amount' => $request['discount_amount'],
                'min_amount' => $request['min_amount'],
                'status' => $request['status'],
                'starts_at' => $startTimestamp,
                'expires_at' => $expireTimestamp
            ]);
            return redirect()->route('coupon_discount.index')->with('success','Discount coupon has been updated!');
           }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
           }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DiscountCoupon::find($id)->delete();
        return response()->json(['success'=>'Discount has been deleted successfully.']);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
