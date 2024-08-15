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
use UddoktaPay\LaravelSDK\UddoktaPay;

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

            $total = $request->sub_total+$request->delivery_charge;
            Order::insert([
                'order_id' => $order_id,
                'delivery_charge' => $request->delivery_charge,
                'sub_total' => $request->sub_total,
                'total' => $total,
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

            if($request->paying_method == 'bkash'){
                $request->session()->put('order_id', $order_id);

                $apiKey = "c3684b1473dc5b5ab83ec6c9786a4367881b2cae";
                $apiBaseURL = "https://pay.nugortechit.com/api/checkout-v2";
                $uddoktaPay = new UddoktaPay($apiKey, $apiBaseURL);

                $requestData = [
                    'full_name'     => $request->name,
                    'email'         => "test@test.com",
                    'amount'        => $total,
                    'metadata'      => [
                        'example_metadata_key' => "example_metadata_value",
                    ],
                    'redirect_url'  => route('order.success'),
                    'return_type'   => 'GET',
                    'cancel_url'    => route('service.order.cancel'),
                    'webhook_url'   => route('service.order.ipn'),
                ];

                try {
                    // Initiate payment
                    $paymentUrl = $uddoktaPay->initPayment($requestData);
                    Cookie::queue(Cookie::forget('shopping_cart'));
                    return redirect($paymentUrl);

                } catch (\Exception $e) {
                    return back()->with('error', "Initialization Error: " . $e->getMessage());
                }
            }

            Cookie::queue(Cookie::forget('shopping_cart'));

            // return redirect()->route('order.success')->withSuccess("Order has been placed successfully");

        return redirect('/order/success')->with('success', 'order has been placed successfully');
    }


    // order_success
    function order_success(Request $request){
        $order_id = $request->session()->get('order_id');
        $order_list = Order::findOrFail($order_id);
        $order_list->update(['status' => 2]);
        return view('frontend.order_success');
    }

    // service_order_cancel\
    function service_order_cancel(Request $request){
        // $service_cart_id = $request->session()->get('service_cart_id');
        // $service_cart = serviceOrderCart::findOrFail($service_cart_id);
        // $service_cart->update(['status' => 0]);
        return redirect('/');
    }
    // service_order_ipn\
    function service_order_ipn(){
        return redirect('/');
    }
}
