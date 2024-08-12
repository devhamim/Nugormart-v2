<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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
    public function dashboard()
    {
            if(!empty($startDate) && !empty($endDate)){
                $orders = Order::with('rel_to_billing')->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC')->get();
                $total_orders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
                $total_completed = Order::whereBetween('created_at', [$startDate, $endDate])->where('status', 4)->get();
            }
            else{
                $orders = Order::orderBy('id', 'DESC')->get();
                $total_orders = Order::count();
                $total_completed = Order::where('status', 4)->get();
            }
        $total_product = Product::where('status', 1)->count();
        $total_user = User::count();
        return view('backend.dashboard',[
            'orders'=>$orders,
            'total_orders'=>$total_orders,
            'total_completed'=>$total_completed,
            'total_product'=>$total_product,
            'total_user'=>$total_user,
        ]);
    }
}
