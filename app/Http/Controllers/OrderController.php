<?php

namespace App\Http\Controllers;

use App\Models\Billingdetails;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

            if (empty($startDate) && empty($endDate)) {
                $startDate = '';
                $endDate = '';
            }
            else {
                $endDate = Carbon::parse($endDate)->addDay();
                $endDate = $endDate->format('Y-m-d');
            }

            if(!empty($startDate) && !empty($endDate)){
                $orders = Order::with('rel_to_billing')->whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
            }
            else{
                $orders = Order::with('rel_to_billing')->orderBy('created_at', 'desc')->get();
            }
        return view('backend.order.listorder',[
            'orders'=>$orders,
            'defaultStartDate' => $startDate,
            'defaultEndDate' => $endDate,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('status', 1)->get();
        return view('backend.order.addorder',[
            'products'=>$products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $orders = Order::find($id);
        $bllingdetails = Billingdetails::where('order_id', $orders->order_id)->first();
        $orderproduct = OrderProduct::where('order_id', $orders->order_id)->get();
        return view('backend.order.editorder',[
            'orders'=>$orders,
            'bllingdetails'=>$bllingdetails,
            'orderproduct'=>$orderproduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orders = Order::find($id);
        $order_id = $orders->order_id;

        Billingdetails::where('order_id', $order_id)->delete();
        OrderProduct::where('order_id', $order_id)->delete();
        $orders->delete();

        return back()->with('warning', 'Delete Successfully');
    }

        // getProduct
        public function getProduct(Request $request) {
            $productId = $request->input('product_id');
            if (!$productId) {
                return response()->json(['error' => 'No product ID provided.']);
            }

            $product = Product::find($productId);
            if (!$product) {
                return response()->json(['error' => 'Product not found.']);
            }

            $inventory = Inventory::where('id', $product->inventorie_id)->with('rel_to_attribute')->first();
            if (!$inventory) {
                return response()->json(['error' => 'Inventory not found for the product.']);
            }

            $data = [
                'product_id' => $product->id,
                'sku' => $inventory->sku,
                'productName' => $product->name,
                'product_price' => $inventory->rel_to_attribute->sell_price ?? $inventory->rel_to_attribute->price,
                'quantity' => $inventory->rel_to_attribute->quantity,
                'sub_total' => $inventory->rel_to_attribute->sell_price ?? $inventory->rel_to_attribute->price * $inventory->rel_to_attribute->quantity,
            ];

            return response()->json($data);
        }

        // order_status_update
        function order_status_update(Request $request){
            $after_explode = explode(',', $request->status);
            Order::where('order_id', $after_explode[0])->update([
                'status'=>$after_explode[1],
            ]);
            return back()->with('success', 'Order Status Update successfully.');
        }

        // invoice_download
        public function invoice_download($id){
            $orders = Order::find($id);
            $billingdetails = Billingdetails::where('order_id', $orders->order_id)->first();
            $order_product = OrderProduct::where('order_id', $orders->order_id)->get();
            $setting = Setting::all();

            $pdf = PDF::loadView('invoice.invoice', [
                'orders'=>$orders,
                'billingdetails'=>$billingdetails,
                'order_product'=>$order_product,
                'setting'=>$setting,
            ]);

            $pdf->getDomPDF()->getOptions()->set('fontDir', public_path('invoice/font/SutonnyMJ Regular/'));
            $pdf->getDomPDF()->getOptions()->set('fontCache', public_path('invoice/font/cache/'));
            $pdf->getDomPDF()->getOptions()->set('defaultFont', 'SutonnyMJ Regular');


            return $pdf->download('invoice.pdf');
        }
}
