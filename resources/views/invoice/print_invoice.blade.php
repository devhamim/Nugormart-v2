<!DOCTYPE html>
<html lang="en">

    <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $setting->first()->name }}</title>
    @if($setting->first()->favicon != null)
        <link rel="shortcut icon" href="{{ asset('uploads/setting') }}/{{ $setting->first()->favicon }}">
    @endif

    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('invoice') }}/css/main-style.css">
</head>
<body class="section-bg-one">
    <main class="main-wrapper position-relative">
        <div class="modern-invoice2 w-100" id="download-section">
            <!-- invoice Top -->
            <div class="card-headers d-flex flex-wrap align-items-center justify-content-sm-between">
                <div class="left-invoice">
                    <a><img width="100px" src="{{ asset('uploads/setting') }}/{{ $setting->first()->white_logo }}"></a>
                </div>
                <div class="right-invoice">
                    <h5 class="text-25 mb-0 mt-0 text-white">{{ $setting->first()->name }}</h5>
                    <span class="status d-block text-capitalize text-white"><strong>#{{ $orders->order_id }}</strong></span>
                    <span class="status d-block text-capitalize text-white"><strong>Marchent id: </strong> 284635</span>
                    <div class="shape"></div>
                </div>
            </div>
            <div class="modern-invoice">
                <!-- invoice Description -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <div class="invoice-details mb-20">
                                <h5 class="mb-10 text-18 text-capitalize"> From:</h5>
                                <p><strong >{{ $setting->first()->name }}</strong></p>
                                <div class="invoice-details-inner mt-2">
                                    <p><strong>Address: </strong> {{ $setting->first()->address }}</p>
                                    <p><strong>Email: </strong> {{ $setting->first()->email }}</p>
                                    <p><strong>Phone: </strong> {{ $setting->first()->number_one }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-6">
                            <div class="invoice-details mb-20">
                                <h5 class="mb-10 text-18 text-capitalize"> To:</h5>
                                <p><strong >{{ $billingdetails->district }} </strong></p>
                                <div class="invoice-details-inner mt-2">
                                    <p><strong>Name: </strong> {{ $billingdetails->name }}</p>
                                    <p><strong>Address: </strong>{{ $billingdetails->address }}</p>
                                    <p><strong>Phone: </strong> {{ $billingdetails->mobile }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- invoice Table -->
                <div class="table-responsive invoice-table mb-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th class="black-bg">Unit Cost</th>
                                <th class="black-bg">Price</th>
                                <th class="black-bg">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach ($order_product as $sl=>$order)
                                <tr>
                                    <td>{{ $sl+1 }}</td>
                                    <td>{{ $order->rel_to_pro->name }}</td>
                                    <td>{{ number_format($orders->total) }}Tk</td>
                                    <td> X {{ $order->quantity }}</td>
                                    <td>{{ number_format(($orders->total) * $order->quantity) }}Tk</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-4"></div>
                    <div class="col-lg-5 col-md-6 col-sm-8 ms-auto">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong class="status">Subtotal</strong>
                                    </td>
                                    <td>{{ number_format($orders->total) }}Tk</td>
                                </tr>
                                <tr class="total-pay">
                                    <td class="border-bottom-0">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="border-bottom-0">
                                        <strong>{{ number_format($orders->total) }}Tk</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End-of Table -->
                <!-- invoice address -->
                <div class="row">
                    <div class="col-sm-12 mb-10">
                        <span class="status d-block mb-20"> <strong>Date :</strong> {{ $billingdetails->first()->created_at->format('d-M-Y') }}</span>
                        <h5 class="mb-2 text-title font-700"> Important: </h5>
                        <p>This is an electronic generated invoice so doesn't require any signature. </p>
                    </div>
                </div>
                <div class="footer-shape">
                    <svg viewBox="0 0 500 200">
                        <path d="M 0 50 C 150 50 300 0 500 80 L 500 0 L 0 0" fill="#07657E"></path>
                        <path d="M 0 50 C 150 50 330 -30 500 50 L 500 0 L 0 0" fill="#000" ></path>
                    <path d="M 0 50 C 215 50 250 0 500 100 L 500 0 L 0 0" fill="#07657E" opacity="0.1"></path>
                    </svg>
                </div>
            </div>
        </div>
        <!-- invoice Bottom  -->
        <div class="text-center modern-bill-button">
            <div class="d-print-none d-flex flex-column justify-content-center flex-wrap gap-10 mt-5">
                {{-- <a href="javascript:window.print()" class="btn-primary-fill">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"></path><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"></rect><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"></path><circle cx="392" cy="184" r="24" fill="currentColor"></circle></svg>
                </a> --}}
                <button id="bill-download" class="btn-primary-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"></path></svg>
                </button>
            </div>
        </div>
    </main>

    <!-- jquery-->
    <script src="{{ asset('invoice') }}/js/jquery-3.7.0.min.js"></script>
    <!-- Plugin -->
    <script src="{{ asset('invoice') }}/js/plugin.js"></script>
    <!-- Main js-->
    <script src="{{ asset('invoice') }}/js/mian.js"></script>
</body>
</html>
