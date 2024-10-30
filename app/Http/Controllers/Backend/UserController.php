<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('customer_address')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
                    return $btn;
                })->addColumn('phone', function ($row) {
                    return $row->customer_address ? $row->customer_address->phone : 'N/A';
                })
                ->addColumn('address', function ($row) {
                    return $row->customer_address ? $row->customer_address->address : 'N/A';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function destroy($id){
        User::find($id)->delete();
        return response()->json(['success'=>'User has been deleted successfully.']);
    }
}
