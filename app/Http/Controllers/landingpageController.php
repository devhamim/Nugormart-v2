<?php

namespace App\Http\Controllers;

use App\Models\Billingdetails;
use App\Models\customers;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class landingpageController extends Controller
{


    //cloth
    function anayatourstravels(){
        return view('landingpage.secondpage');
    }

    // landing_order_store
    function landing_order_store(Request $request){
            $request->validate([
                'name' => 'required',
                'mobile' => 'required|min:11|max:11',
                'address' => 'required',
            ]);
            if($request->district == 'Dhaka'){
                $delivery_charge = 50;
            }
            if($request->district == 'Outside Dhaka'){
                $delivery_charge = 100;
            }

            $order_id = Str::random(5).'-'.rand(10000000,99999999);
                Billingdetails::insert([
                    'order_id' => $order_id,
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'district' => $request->district,
                    'created_at' => Carbon::now(),
                ]);
                if($request->radio_btn == 1){
                    $price = 1280;
                    $product_name = 'Premium Mabroom Moriom';
                    $quantity = 1;
                }
                if($request->radio_btn == 2){
                    $price = 2450;
                    $product_name = 'Premium Mabroom Moriom';
                    $quantity = 2;
                }
                if($request->radio_btn == 3){
                    $price = 3450;
                    $product_name = 'Premium Mabroom Moriom';
                    $quantity = 3;
                }
                if($request->radio_btn == 4){
                    $price = 5250;
                    $product_name = 'Premium Mabroom Moriom';
                    $quantity = 4;
                }

                Order::insert([
                    'order_id' => $order_id,
                    'sub_total' => $price,
                    'delivery_charge' => $delivery_charge,
                    'total' => $price+$delivery_charge,
                    'landing' => 1,
                    'created_at' => Carbon::now(),
                ]);
                OrderProduct::create([
                    'order_id' => $order_id,
                    'product_id' => $product_name,
                    'quantity' => $quantity,
                    'price' => $price,
                    'created_at' => Carbon::now(),
                ]);
                return back()->with("success","Order has been placed successfully");
    }
}
