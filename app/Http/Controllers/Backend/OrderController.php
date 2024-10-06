<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $orders = Order::latest();
                return DataTables::of($orders)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($order) {
                        return \Carbon\Carbon::parse($order->created_at)->format('M d, Y');
                    })
                    ->addColumn('view', function ($order) {
                        $viewUrl = route('admin.orders.view', $order->id);
                        return '<a href="' . $viewUrl . '" class="btn btn-primary btn-sm">View</a>';
                    })
                    ->rawColumns(['view'])
                    ->make(true);
            }
            return view('admin.orders.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function view($id)
    {
        try {
            $order = Order::with('order_items')->where('id', $id)->first();
            return view('admin.orders.view', compact('order'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'shipped_date' => 'required_if:status,shipped',
            'status' => 'required'
        ]);
        try {
            Order::where('id', $id)->update([
                'status' => $request->status,
                'shipped_date' => $request->shipped_date ?? null
            ]);
            return back()->with('success', 'Status updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
