<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $order_counts=Order::count();
        $customers_count=User::count();
        $total_sale=Order::where('status','delivered')->sum('total_charge');
        return view('admin.home.index',compact('order_counts','customers_count','total_sale'));
    }
}
