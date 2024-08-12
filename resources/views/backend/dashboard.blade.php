@extends('backend.layouts.app')
@section('content')
<div class="content">
    <!-- Top Statistics -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-1">
                <div class="card-body">
                    <h2 class="mb-1">{{ $total_user }}</h2>
                    <p>Total User</p>
                    <span class="mdi mdi-account-arrow-left"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-2">
                <div class="card-body">
                    <h2 class="mb-1">{{ $total_product }}</h2>
                    <p>Total Products</p>
                    <span class="mdi mdi-account-clock"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-3">
                <div class="card-body">
                    <h2 class="mb-1">{{ $total_orders }}</h2>
                    <p>Total Order</p>
                    <span class="mdi mdi-package-variant"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-4">
                <div class="card-body">
                    @php
                        $total_revineu = 0;
                        foreach ($total_completed as $completed) {
                            $total_revineu += $completed->total;
                        }
                    @endphp
                    <h2 class="mb-1">{{ $total_revineu }} Tk</h2>
                    <p>Revenue</p>
                    <span class="mdi mdi-currency-usd"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-md-12 p-b-15">
            <!-- Sales Graph -->
            <div id="user-acquisition" class="card card-default">
                <div class="card-header">
                    <h2>Sales Report</h2>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-style-border justify-content-between justify-content-lg-start border-bottom"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#todays" role="tab"
                                aria-selected="true">Today's</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#monthly" role="tab"
                                aria-selected="false">Monthly </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#yearly" role="tab"
                                aria-selected="false">Yearly</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="salesReport">
                        <div class="tab-pane fade show active" id="source-medium" role="tabpanel">
                            <div class="mb-6" style="max-height:247px">
                                <canvas id="acquisition" class="chartjs2"></canvas>
                                <div id="acqLegend" class="customLegend mb-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-12 p-b-15">
            <!-- Doughnut Chart -->
            <div class="card card-default">
                <div class="card-header justify-content-center">
                    <h2>Orders Overview</h2>
                </div>
                <div class="card-body">
                    <canvas id="doChart"></canvas>
                </div>
                <div class="card-footer d-flex flex-wrap bg-white p-0">
                    <div class="col-6">
                        <div class="p-20">
                            <ul class="d-flex flex-column justify-content-between">
                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #4c84ff"></i>Order Completed</li>
                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #80e1c1 "></i>Order Unpaid</li>
                                <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #ff7b7b "></i>Order returned</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 border-left">
                        <div class="p-20">
                            <ul class="d-flex flex-column justify-content-between">
                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #8061ef"></i>Order Pending</li>
                                <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #ffa128"></i>Order Canceled</li>
                                <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2"
                                        style="color: #7be6ff"></i>Order Broken</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 p-b-15">
            <!-- Recent Order Table -->
            <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                    <h2>Recent Orders</h2>
                    {{-- <div class="date-range-report">
                        <span></span>
                    </div> --}}
                </div>
                <div class="card-body pt-0 pb-5">
                    <table class="table card-table table-responsive table-responsive-large"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product Name</th>
                                <th class="d-none d-lg-table-cell">Subtotal</th>
                                <th class="d-none d-lg-table-cell">Charge</th>
                                <th class="d-none d-lg-table-cell">Total</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders->take(5) as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>
                                        @foreach ($order->rel_to_orderpro as $OrderProduct)
                                                @if ($OrderProduct != null)
                                                    @if ($OrderProduct->rel_to_attribute != null)
                                                        <span>{{ $OrderProduct->rel_to_pro->name??'' }} <br> {{ $OrderProduct->quantity }} x {{ $OrderProduct->rel_to_attribute ? $OrderProduct->rel_to_attribute->sell_price : $OrderProduct->rel_to_attribute->price }},
                                                            @if ($OrderProduct->rel_to_attribute->weight != null)
                                                                Package: {{ $OrderProduct->rel_to_attribute->weight }}
                                                            @else
                                                                Color: {{ $OrderProduct->rel_to_attribute->color_id }}
                                                                Size: {{ $OrderProduct->rel_to_attribute->size_id }}
                                                            @endif
                                                        </span><hr>
                                                    @elseif ($OrderProduct->rel_to_pro != null)
                                                        <span>{{ $OrderProduct->rel_to_pro->name }} <br> {{ $OrderProduct->quantity }} x {{ $OrderProduct->rel_to_pro ? $OrderProduct->rel_to_pro->sell_price : $OrderProduct->rel_to_pro->price }},
                                                            @if ($OrderProduct->rel_to_pro->weight != null)
                                                                Package: {{ $OrderProduct->rel_to_pro->weight }}
                                                            @else
                                                                Color: {{ $OrderProduct->rel_to_pro->color_id }}
                                                                Size: {{ $OrderProduct->rel_to_pro->size_id }}
                                                            @endif
                                                        </span><hr>
                                                    @endif
                                                @endif
                                            @endforeach
                                    </td>
                                    <td>{{ $order->sub_total }}Tk</td>
                                    <td>{{ $order->delivery_charge }}Tk</td>
                                    <td>{{ $order->total }}Tk</td>
                                    <td>
                                        @if ($order->status == 0)
                                            <div class="badge badge-secondary">Pending</div>
                                        @elseif ($order->status == 1)
                                            <div class="badge badge-info">Confirmed Order</div>
                                        @elseif ($order->status == 2)
                                            <div class="badge badge-primary">Processing Order</div>
                                        @elseif ($order->status == 3)
                                            <div class="badge badge-warning">On Delivery</div>
                                        @elseif ($order->status == 4)
                                            <div class="badge badge-success">Product Delivered</div>
                                        @else
                                            <div class="badge badge-danger">Cancel</div>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('orders.edit',  $order->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
