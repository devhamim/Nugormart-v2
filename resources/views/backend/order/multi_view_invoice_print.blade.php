<!DOCTYPE html>
<html class="no-js" lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('invoice_assets') }}/css/style.css">

</head>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            @foreach ($order_ids as $order_id)
                @if ($order_id)
                    @php
                        $order = App\Models\Order::find($order_id);
                        $billingdetails = App\Models\Billingdetails::where('order_id', $order->order_id)->first();
                        $orderproducts = App\Models\OrderProduct::where('order_id', $order->order_id)->get();
                    @endphp
                    <div class="tm_invoice tm_style1 tm_type1 tm_invoice_in" style="height: 920px; page-break-after: always;">
                        <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center" style="margin-top: 30px">
                            <div class="tm_invoice_left">
                                <div class="tm_logo">
                                    <strong>{{ $setting->first()->name }}</strong><br>
                                    <span>#{{ $order->order_id }}</span>
                                </div>
                            </div>
                            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
                                <div class="tm_f50 tm_text_uppercase tm_white_color">
                                    <img src="{{ asset('uploads/setting') }}/{{ $setting->first()->white_logo }}" width="200px" alt="Logo">
                                </div>
                            </div>
                            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
                        </div>
                        {{-- <div class="tm_invoice_info tm_mb25">
                            <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Sta: </b>Paypal, Western Union</div>
                            <div class="tm_invoice_info_list tm_white_color">
                                <p class="tm_invoice_number tm_m0">Invoice No: <b>#{{ $order->first()->order_id }}</b></p>
                                <p class="tm_invoice_date tm_m0">Date: <b>{{ $order->created_at->format('d.m.Y') }}</b></p>
                            </div>
                            <div class="tm_invoice_seperator tm_accent_bg"></div>
                        </div> --}}
                        <div class="tm_invoice_head tm_mb10">
                            <div class="tm_invoice_left">
                                <p class="tm_mb2"><b class="tm_primary_color">From:</b></p>
                                <p>
                                    {{ $setting->first()->name }} <br>
                                    {{ $setting->first()->number_one }} <br>
                                    {{ $setting->first()->address }}
                                </p>
                            </div>
                            <div class="tm_invoice_right tm_text_right">
                                <p class="tm_mb2"><b class="tm_primary_color">To:</b></p>
                                <p>
                                    {{ $billingdetails->name }} <br>
                                    {{ $billingdetails->mobile }}<br>
                                    {{ $billingdetails->address }}
                                </p>
                            </div>
                        </div>
                        <div class="tm_table tm_style1">
                            <div class="">
                                <div class="tm_table_responsive">
                                    <table>
                                        <thead>
                                            <tr class="tm_accent_bg">
                                                <th class="tm_width_3 tm_semi_bold tm_white_color">SL#</th>
                                                <th class="tm_width_4 tm_semi_bold tm_white_color">Product(s)</th>
                                                <th class="tm_width_2 tm_semi_bold tm_white_color">Qty</th>
                                                <th class="tm_width_1 tm_semi_bold tm_white_color">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderproducts as $sl=>$orderpro)
                                            <tr>
                                                <td class="tm_width_3">{{ $sl+1 }}</td>
                                                <td class="tm_width_4">{{ $orderpro->rel_to_pro->name }}</td>
                                                <td class="tm_width_2">{{ $orderpro->quantity }}</td>
                                                <td class="tm_width_1">{{ $orders->first()->total }}Tk</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
                                <div class="tm_right_footer">
                                    <table class="tm_mb15">
                                        <tbody>
                                            <tr class="tm_gray_bg ">
                                                <td class="tm_width_3 tm_primary_color tm_bold">Subtotal</td>
                                                <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">{{ $order->sub_total }}Tk</td>
                                            </tr>
                                            <tr class="tm_accent_bg">
                                                <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total </td>
                                                <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">{{ $order->total }}Tk</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="tm_invoice_btns tm_hide_print">
            <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
                <span class="tm_btn_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                        <circle cx="392" cy="184" r="24" fill='currentColor' />
                    </svg>
                </span>
                <span class="tm_btn_text">Print</span>
            </a>
            {{-- <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
                <span class="tm_btn_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                    </svg>
                </span>
                <span class="tm_btn_text">Download</span>
            </button> --}}
        </div>
    </div>
    <script src="{{ asset('invoice_assets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('invoice_assets') }}/js/jspdf.min.js"></script>
    <script src="{{ asset('invoice_assets') }}/js/html2canvas.min.js"></script>
    <script src="{{ asset('invoice_assets') }}/js/main.js"></script>
</body>

</html>
