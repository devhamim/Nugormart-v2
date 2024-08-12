@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-6">
                        <div>
                            <h1>Orders List</h1>
                            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                                <span><i class="mdi mdi-chevron-right"></i></span>Orders
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-6 d-flex">
                        <div class="mx-3">
                            <form action="{{ route('multi.order.status') }}" method="post" id="all_order_form">
                                @csrf
                                <input type="hidden" name="order_data" id="checked_order_value">
                                <div class="dropdown">
                                    <button class="border-0 bg-body" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="btn btn-success">Status</span>
                                    </button>

                                    @if ($orders->first() != null)
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <li>
                                                <button name="status" value="{{ $orders->first()->order_id .','. '0' }}" class="dropdown-item status">Pending</button>
                                            </li>
                                            <li>
                                                <button name="status" value="{{ $orders->first()->order_id .','. '4' }}" class="dropdown-item status">Confirmed Order</button>
                                            </li>
                                            <li>
                                                <button name="status" value="{{ $orders->first()->order_id .','. '5' }}" class="dropdown-item status">Cancel Order</button>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div >
                            <form action="{{ route('multi.view.invoice') }}" method="post" id="all_print_form">
                                @csrf
                                <input type="hidden" name="print_data" id="checked_value">
                                <div class="form-group">
                                    <button type="submit" id="bulk_print_btn" class="btn btn-info">Print Invoice</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="filter row">
                    <div class="col-lg-9 pt-3">
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                         </div>
                    </div>
                    <div class="col-lg-3">
                        <form action="{{ route('orders.index') }}" method="GET">
                            <input type="hidden" name="start_date" id="start_date" value="{{ $defaultStartDate }}">
                            <input type="hidden" name="end_date" id="end_date" value="{{ $defaultEndDate }}">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>sl</th>
                                    <th>Image</th>
                                    <th>Invoice No.</th>
                                    <th>Customer Info</th>
                                    <th>Product</th>
                                    <th>Subtotal</th>
                                    <th>Charge</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $sl=>$order)
                                    <tr id="tr_{{ $order->id }}">
                                        <td>
                                            <input type="checkbox" name="checkbox" class="sub_chk" data-id="{{ $order->id }}">
                                        </td>
                                        <td>{{ $sl+1 }}</td>
                                        <td>
                                            @foreach ($order->rel_to_orderpro->take(1) as $OrderProduct)
                                                @if ($OrderProduct != null)
                                                    @if ($OrderProduct->rel_to_attribute != null)
                                                        <img width="100" src="{{ asset('uploads/product') }}/{{ $OrderProduct->rel_to_attribute->image }}" alt="Image" />
                                                    @elseif ($OrderProduct->rel_to_pro)
                                                        <img width="100" src="{{ asset('uploads/product') }}/{{ $OrderProduct->rel_to_pro->image }}" alt="Image" />
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $order->order_id }}</td>
                                        <td>
                                            <span>{{ $order->rel_to_billing ? $order->rel_to_billing->name : 'No Billing Details' }}</span>
                                            <br>
                                            <a href="tel: {{ $order->rel_to_billing ? $order->rel_to_billing->mobile : 'No Billing Details' }}"><span>{{ $order->rel_to_billing ? $order->rel_to_billing->mobile : 'No Billing Details' }}</span></a>
                                            <br>
                                            <span>{{ $order->rel_to_billing ? $order->rel_to_billing->address : 'No Billing Details' }}</span>
                                            <br>
                                            <span>{{ $order->rel_to_billing ? $order->rel_to_billing->district : 'No Busines Name' }}</span>
                                        </td>
                                        <td>
                                            @if($order->landing == 1)
                                                @foreach ($order->rel_to_orderpro as $OrderProduct)
                                                    <span>{{ $OrderProduct->product_id }} <br> {{ $OrderProduct->quantity }} x {{ $OrderProduct->price }}
                                                </span>
                                                @endforeach
                                            @else
                                                @foreach ($order->rel_to_orderpro as $OrderProduct)
                                                    @if ($OrderProduct != null)
                                                        @if ($OrderProduct->rel_to_attribute != null)
                                                            <span>{{ $OrderProduct->rel_to_pro->name??'' }} <br> {{ $OrderProduct->quantity }} x {{ $OrderProduct->rel_to_attribute ? $OrderProduct->rel_to_attribute->sell_price : $OrderProduct->rel_to_attribute->price }},
                                                                @if ($OrderProduct->rel_to_attribute->weight != null)
                                                                    Package: {{ $OrderProduct->rel_to_attribute->weight }}
                                                                @endif
                                                                @if ($OrderProduct->rel_to_attribute->color_id != null)
                                                                    Color: {{ $OrderProduct->rel_to_attribute->rel_to_color->name }}
                                                                @endif
                                                                @if ($OrderProduct->rel_to_attribute->size_id != null)
                                                                    Size: {{ $OrderProduct->rel_to_attribute->size_id }}
                                                                @endif
                                                            </span><hr>
                                                        @elseif ($OrderProduct->rel_to_pro != null)
                                                            <span>{{ $OrderProduct->rel_to_pro->name }} <br> {{ $OrderProduct->quantity }} x {{ $OrderProduct->rel_to_pro ? $OrderProduct->rel_to_pro->sell_price : $OrderProduct->rel_to_pro->price }},
                                                                @if ($OrderProduct->rel_to_pro->weight != null)
                                                                    Package: {{ $OrderProduct->rel_to_pro->weight }}
                                                                @endif
                                                                @if ($OrderProduct->rel_to_attribute->color_id != null)
                                                                    Color: {{ $OrderProduct->rel_to_pro->color_id }}
                                                                @endif
                                                                @if ($OrderProduct->rel_to_attribute->size_id != null)
                                                                    Size: {{ $OrderProduct->rel_to_pro->size_id }}
                                                                @endif
                                                            </span><hr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                            
                                        </td>
                                        <td>{{ $order->sub_total }}Tk</td>
                                        <td>{{ $order->delivery_charge }}Tk</td>
                                        <td>{{ $order->total }}Tk</td>
                                        <td>
                                            @if ($order->status == 0)
                                                <div class="badge badge-secondary">Pending</div>
                                            @elseif ($order->status == 1)
                                                <div class="badge badge-info">Product Delivered</div>
                                            @elseif ($order->status == 2)
                                                <div class="badge badge-primary">Processing Order</div>
                                            @elseif ($order->status == 3)
                                                <div class="badge badge-warning">On Delivery</div>
                                            @elseif ($order->status == 4)
                                                <div class="badge badge-success">Confirmed Order</div>
                                            @else
                                                <div class="badge badge-danger">Cancel</div>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="btn-group mb-1">
                                                <button type="button"
                                                    class="btn btn-outline-success">Info</button>
                                                <button type="button"
                                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static">
                                                    <span class="sr-only">Info</span>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <a href="{{ route('orders.edit',  $order->id) }}" class="dropdown-item">Edit</a>
                                                    <form action="{{ route('orders.destroy',  $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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
</div>
@endsection

@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function () {
        var start_date = '{{ $defaultStartDate }}';
        var end_date = '{{ $defaultEndDate }}';

        if (start_date && end_date) {
            start_date = moment(start_date, 'YYYY-MM-DD');
            end_date = moment(end_date, 'YYYY-MM-DD');
        } else {
            start_date = moment().subtract(6, 'days');
            end_date = moment();
        }

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
            startDate: start_date,
            endDate: end_date,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        cb(start_date, end_date);
    });
</script>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('.sub_chk');
        let checked_value = document.getElementById('checked_value');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var checkedIDs = [];
                var checkedCheckboxes = document.querySelectorAll('.sub_chk:checked');

                checkedCheckboxes.forEach(function(checkedCheckbox) {
                    checkedIDs.push(checkedCheckbox.getAttribute('data-id'));
                });

                checked_value.value = checkedIDs.join(', ');
            });
        });
    });
</script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('.sub_chk');
        let checked_value = document.getElementById('all_ord_id');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var checkedIDs = [];
                var checkedCheckboxes = document.querySelectorAll('.sub_chk:checked');

                checkedCheckboxes.forEach(function(checkedCheckbox) {
                    checkedIDs.push(checkedCheckbox.getAttribute('data-id'));
                });

                checked_value.value = checkedIDs.join(', ');
            });
        });
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('.sub_chk');
        let checked_order_value = document.getElementById('checked_order_value');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var checkedIDs = [];
                var checkedCheckboxes = document.querySelectorAll('.sub_chk:checked');

                checkedCheckboxes.forEach(function(checkedCheckbox) {
                    checkedIDs.push(checkedCheckbox.getAttribute('data-id'));
                });

                checked_order_value.value = checkedIDs.join(',');
            });
        });
    });
</script>
<script>
    $('.print').on('click', function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        });

        $.ajax({
            url: '/getprints',
            type: 'POST',
            data: {_token: CSRF_TOKEN, id: $(this).data('id')},
            success: function (data) {
                newWin = window.open("");
                newWin.document.write(data);
                newWin.document.close();
            }
        });
    });
</script>

<script>
    //courier export
    $('#steadfast_csv').on('click', function (e) {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });

        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {
            $('#all_ord_id').val(allVals);
            $('#courier_status').val(1);
            $('#all_courier_csv').submit();
        }
    });

    $('#redex_csv').on('click', function (e) {
        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });

        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {
            $('#all_ord_id').val(allVals);
            $('#courier_status').val(2);
            $('#all_courier_csv').submit();
        }
    });
</script>
