@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
        <h1>Order Detail</h1>
        <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Home</a></span>
            <span><i class="mdi mdi-chevron-right"></i></span>Orders
        </p>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-odr-dtl card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2 class="ec-odr">Order Detail<br>
                        <form action="{{ route('order.status.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $orders->id }}">
                            <div class="dropdown">
                                <button class="border-0 bg-body" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                    @php
                                    if($orders->status == 0){
                                        echo '<span class="btn btn-secondary">Pending</span>';
                                    }
                                    elseif ($orders->status == 1) {
                                        echo '<span class="btn btn-info">Confirmed Order</span>';
                                    }
                                    elseif ($orders->status == 2) {
                                        echo '<span class="btn btn-primary">Processing Order</span>';
                                    }
                                    elseif ($orders->status == 3) {
                                        echo '<span class="btn btn-warning ">On Delivery</span>';
                                    }
                                    elseif ($orders->status == 4) {
                                        echo '<span class="btn btn-success">Product Delivered</span>';
                                    }
                                    else {
                                        echo '<span class="btn btn-danger">Cancel Order</span>';
                                    }
                                @endphp
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                  <li>
                                        <button name="status" value="{{ $orders->order_id .','. '0' }}" class="dropdown-item status">Pending</button>
                                    </li>
                                    {{-- <li>
                                        <button name="status" value="{{ $orders->order_id .','. '1' }}" class="dropdown-item status">Confirmed Order</button>
                                    </li>
                                    <li>
                                        <button name="status" value="{{ $orders->order_id .','. '2' }}" class="dropdown-item status">Processing Order</button>
                                    </li>
                                    <li>
                                        <button name="status" value="{{ $orders->order_id .','. '3' }}" class="dropdown-item status">On Delivery</button>
                                    </li> --}}
                                    <li>
                                        {{-- <button name="status" value="{{ $orders->order_id .','. '4' }}" class="dropdown-item status">Product Delivered</button> --}}
                                        <button name="status" value="{{ $orders->order_id .','. '4' }}" class="dropdown-item status">Confirmed Order</button>
                                    </li>
                                    <li>
                                        <button name="status" value="{{ $orders->order_id .','. '5' }}" class="dropdown-item status">Cancel Order</button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                        {{-- <a href="{{ route('invoice.download',$orders->id ) }}" class="btn btn-success">Download Invoice</a> --}}
                        <a href="{{ route('print.invoice',$orders->id ) }}" class="btn btn-success">Download Invoice</a>
                        <span class="small">Order ID: #{{ $orders->order_id }}</span>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <address class="info-grid">
                                <div class="info-title"><strong>Shipped To:</strong></div><br>
                                <div class="info-content">
                                    {{ $bllingdetails->name }}<br>
                                    {{ $bllingdetails->address }}<br>
                                    <abbr title="Phone">P:</abbr> {{ $bllingdetails->mobile }}
                                </div>
                            </address>
                        </div>
                        {{-- <div class="col-xl-4 col-lg-4">
                            <address class="info-grid">
                                <div class="info-title"><strong>Note:</strong></div><br>
                                <div class="info-content">
                                    {{ $bllingdetails->note }}
                                </div>
                            </address>
                        </div> --}}
                        <div class="col-xl-6 col-lg-6">
                            <address class="info-grid">
                                <div class="info-title"><strong>Order Date:</strong></div><br>
                                <div class="info-content">
                                    {{ $orders->created_at->format('h:i:s') }}<br>
                                    {{ $orders->created_at->format('d M Y') }}
                                </div>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="tbl-title">PRODUCT SUMMARY</h3>
                            <div class="table-responsive">
                                <table class="table table-striped o-tbl">
                                    <thead>
                                        <tr class="line">
                                            <td><strong>#</strong></td>
                                            {{-- <td class="text-center"><strong>IMAGE</strong></td> --}}
                                            <td class="text-center"><strong>PRODUCT</strong></td>
                                            <td class="text-center"><strong>QUANTITY</strong></td>
                                            <td class="text-center"><strong>CHARGE</strong></td>
                                            <td class="text-center"><strong>PRICE/UNIT</strong></td>
                                            <td class="text-right"><strong>SUBTOTAL</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->rel_to_orderpro as $key => $OrderProduct)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                {{-- <td>
                                                    <img class="product-img"
                                                        src="{{ asset('uploads/product') }}/{{ $product->rel_to_attribute->image }}" alt="" />
                                                </td> --}}
                                                <td>
                                                    <strong>{{ $OrderProduct->product_id }}</strong><br>
                                                </td>
                                                <td class="text-center">{{ $OrderProduct->quantity }}</td>
                                                <td class="text-center">{{ number_format($orders->delivery_charge) }} Tk</td>
                                                <td class="text-center">{{ number_format($orders->total) }} Tk</td>
                                                <td class="text-right">{{ number_format($orders->total) }} Tk</td>

                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4">
                                            </td>
                                            <td class="text-right"><strong>Total</strong></td>
                                            <td class="text-right"><strong>{{ number_format($orders->total) }} Tk</strong></td>
                                        </tr>

                                        {{-- <tr>
                                            <td colspan="4">
                                            </td>
                                            <td class="text-right"><strong>Payment Status</strong></td>
                                            <td class="text-right"><strong>PAID</strong></td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tracking Detail -->
            <div class="card mt-4 trk-order">
                <div class="p-4 text-center text-white text-lg bg-dark rounded-top">
                    <span class="text-uppercase">Tracking Order No - </span>
                    <span class="text-medium">{{ $orders->order_id }}</span>
                </div>
                {{-- <div
                    class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                    <div class="w-100 text-center py-1 px-2"><span class="text-medium">Shipped
                            Via:</span> UPS Ground</div>
                    <div class="w-100 text-center py-1 px-2"><span class="text-medium">Status:</span>
                        Checking Quality</div>
                    <div class="w-100 text-center py-1 px-2"><span class="text-medium">Expected
                            Date:</span> DEC 09, 2021</div>
                </div> --}}
                <div class="card-body mt-5">
                    <div
                        class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                        <div class="step {{ $orders->status != 5 ? 'completed':'' }}">
                            <div class="step-icon-wrap">
                                <div class="step-icon"><i class="mdi mdi-gift"></i></div>
                            </div>
                            <h4 class="step-title">Pending</h4>
                        </div>
                        <div class="step {{ $orders->status >= 1 && $orders->status != 5 ? 'completed':'' }}">
                            <div class="step-icon-wrap">
                                <div class="step-icon"><i class="mdi mdi-cart"></i></div>
                            </div>
                            <h4 class="step-title">Confirmed Order</h4>
                        </div>
                        <div class="step {{ $orders->status >= 2 && $orders->status != 5 ? 'completed':'' }}">
                            <div class="step-icon-wrap">
                                <div class="step-icon"><i class="mdi mdi-tumblr-reblog"></i></div>
                            </div>
                            <h4 class="step-title">Processing Order</h4>
                        </div>

                        <div class="step {{ $orders->status >= 3 && $orders->status != 5 ? 'completed':'' }}">
                            <div class="step-icon-wrap">
                                <div class="step-icon"><i class="mdi mdi-truck-delivery"></i></div>
                            </div>
                            <h4 class="step-title">On Delivery</h4>
                        </div>
                        <div class="step {{ $orders->status >= 4 && $orders->status != 5 ? 'completed':'' }}">
                            <div class="step-icon-wrap">
                                <div class="step-icon"><i class="mdi mdi-hail"></i></div>
                            </div>
                            <h4 class="step-title">Product Delivered</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Content -->
@endsection
