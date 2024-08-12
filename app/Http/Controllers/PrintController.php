<?php

namespace App\Http\Controllers;

use App\Models\Billingdetails;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Setting;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    function multi_view_invoice(Request $request){
        $order_ids = explode(',', $request->print_data);
        $orders = Order::where('id', $order_ids)->get();
        return view('backend.order.multi_view_invoice_print', [
            'orders'=>$orders,
            'order_ids'=>$order_ids,
        ]);
    }

    public function excel_exportOrdersReport(Request $request)
    {
        $status = $request->input('status');
        $orderIds = explode(',', $request->input('all_ord_id'));

        $orders = Order::whereIn('id', $orderIds)->get();

        $orderDetails = [];

        $orderDetails [] = array(
            'Invoice ID',
            'Order Date',
            'Customer Name',
            'Customer Phone',
            'Customer Address',
            'Total',
        );
        foreach ($orders as $order) {
            $billingdetails = Billingdetails::where('order_id', $order->order_id)->get();
            $orderDetails[] = [
                'Invoice ID' => $order->order_id,
                'Order Date' => $order->order_date,
                'Customer Name' => $billingdetails->first()->customer_name,
                'Customer Phone' => $billingdetails->first()->customer_phone,
                'Customer Address' => $billingdetails->first()->customer_address,
                'Total' => $order->total,
            ];
        }

        $this->exportExcel($orderDetails);
    }

    // print_invoice
    function print_invoice($id){
        $orders = Order::find($id);
        $billingdetails = Billingdetails::where('order_id', $orders->order_id)->first();
        $order_product = OrderProduct::where('order_id', $orders->order_id)->get();
        $setting = Setting::all();
        return view('invoice.print_invoice', [
            'orders'=>$orders,
            'billingdetails'=>$billingdetails,
            'order_product'=>$order_product,
            'setting'=>$setting,
        ]);
    }

    // multi_order_status
    function multi_order_status(Request $request){
        $order_ids = explode(',', $request->order_data);


        foreach($order_ids as $order_id){
            $after_explode = explode(',', $request->status);
            Order::where('id', $order_id)->update([
                'status'=>$after_explode[1],
            ]);
        }
            return back()->with('success', 'Order Status Update successfully.');
    }
}
