<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Billingdetails;
use App\Models\DelevaryCharge;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\sms;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Str;
use Log;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    //checkout
    function checkout(){
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        $delevarychareg = DelevaryCharge::all();
        return view('frontend.checkout',[
            'cart_data'=> $cart_data,
            'delevarychareg'=> $delevarychareg,
        ]);
    }

    // order_store
    function order_store(Request $request){
        $request->validate([
            'name' => 'required|max:225',
            'mobile' => 'required|min:11|max:11',
            'address' => 'required|max:225',
            'district' => 'required',
        ]);

            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $items_in_cart = $cart_data;

            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $order_id = Str::random(5).'-'.rand(10000000,99999999);

            Billingdetails::insert([
                'order_id' => $order_id,
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'district' => $request->district,
                'note' => $request->note,
                'created_at' => Carbon::now(),
            ]);

            Order::insert([
                'order_id' => $order_id,
                'delivery_charge' => $request->delivery_charge,
                'sub_total' => $request->sub_total,
                'total' => $request->sub_total+$request->delivery_charge,
                'created_at' => Carbon::now(),
            ]);
            $quantities = $request->quantity;

            $items_in_cart = $cart_data;

            foreach ($items_in_cart as $key => $itemdata) {
                if(isset($itemdata['item_attribute']) && $itemdata['item_attribute'] !== null){
                    $productId = $itemdata['item_id'];
                    $attribute_id = $itemdata['item_attribute'];
                    $inventory_id = $itemdata['item_inventory'];

                    if (isset($quantities[$productId])) {
                        $quantity = $quantities[$productId];

                        OrderProduct::create([
                            'order_id' => $order_id,
                            'product_id' => $productId,
                            'quantity' => $quantity,
                            'attribute_id' => $attribute_id,
                            'inventory_id' => $inventory_id,
                            'created_at' => Carbon::now(),
                        ]);

                        Attribute::where('id', $attribute_id)
                            ->decrement('quantity', $quantity);
                    }
                }
                else{
                    $productId = $itemdata['item_id'];
                    if (isset($quantities[$productId])) {
                        $quantity = $quantities[$productId];

                        OrderProduct::create([
                            'order_id' => $order_id,
                            'product_id' => $productId,
                            'quantity' => $quantity,
                            'created_at' => Carbon::now(),
                        ]);

                        Product::where('id', $productId)
                            ->decrement('quantity', $quantity);
                    }
                }

            }

            Cookie::queue(Cookie::forget('shopping_cart'));

            // return redirect()->route('order.success')->withSuccess("Order has been placed successfully");

        return redirect('/order/success')->with('success', 'order has been placed successfully');
    }


    // order_success
    function order_success(){
        return view('frontend.order_success');
    }
}
