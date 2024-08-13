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
                                                <button name="status" value="{{ $orders->first()->order_id .','. '4' }}" class="dropdown-item status">Confirmed</button>
                                            </li>
                                            <li>
                                                <button name="status" value="{{ $orders->first()->order_id .','. '5' }}" class="dropdown-item status">Cancel Order</button>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </form>
                        </div>
                        {{-- <div class="mx-3">
                            <form action="{{ route('orders.export') }}" method="post" id="all_exal_form">
                                @csrf
                                <input type="hidden" name="exal_data" id="checked_value">
                                <div class="form-group">
                                    <button type="submit" id="bulk_exal_btn" class="btn btn-info">Exal</button>
                                </div>
                            </form>
                        </div> --}}
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
                    <div class="col-lg-9 pt-1">
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
        <!-- Top Statistics -->
        <div class="row">
            <div class="col-xl-2 col-sm-6 p-b-15 lbl-card cursor-pointer">
                <div id="total-orders" class="card card-mini dash-card card-1">
                    <div class="card-body">
                        <h2 class="mb-1">{{ $total_orders }}</h2>
                        <p>Total Order</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 p-b-15 lbl-card cursor-pointer">
                <div id="pending-orders" class="card card-mini dash-card card-2">
                    <div class="card-body">
                        <h2 class="mb-1">{{ $pending_orders }}</h2>
                        <p>Total Pending</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 p-b-15 lbl-card cursor-pointer">
                <div id="confirm-orders" class="card card-mini dash-card card-3">
                    <div class="card-body">
                        <h2 class="mb-1">{{ $confirm_orders }}</h2>
                        <p>Total Confirm</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 p-b-15 lbl-card cursor-pointer">
                <div id="hold-orders" class="card card-mini dash-card card-3">
                    <div class="card-body">
                        <h2 class="mb-1">{{ $hold_orders }}</h2>
                        <p>Total Hold</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 p-b-15 lbl-card cursor-pointer">
                <div id="cancel-orders" class="card card-mini dash-card card-3">
                    <div class="card-body">
                        <h2 class="mb-1">{{ $cancel_orders }}</h2>
                        <p>Total Cancel</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 p-b-15 lbl-card">
                <div class="card card-mini dash-card card-4">
                    <div class="card-body">
                        @php
                            $total_revineu = 0;
                            foreach ($total_completed as $completed) {
                                $total_revineu += $completed->total;
                            }
                        @endphp
                        <h2 class="mb-1">{{ number_format($total_revineu) }} Tk</h2>
                        <p>Revenue</p>
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
                                        <td class="image_copy">
                                            @foreach ($order->rel_to_orderpro->take(1) as $OrderProduct)
                                                @if ($OrderProduct != null)
                                                    @if ($OrderProduct->rel_to_attribute != null)
                                                    {{-- {{ $OrderProduct->rel_to_attribute->image }} --}}
                                                        <img  width="100" src="{{ asset('uploads/product') }}/{{ $OrderProduct->rel_to_attribute->image }}" alt="Image" />
                                                    @elseif ($OrderProduct->rel_to_pro)
                                                        {{-- <img width="100" src="{{ asset('uploads/product') }}/{{ $OrderProduct->rel_to_pro->image }}" alt="Image" /> --}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $order->order_id }}</td>
                                        <td>
                                            <span>{{ $order->rel_to_billing ? $order->rel_to_billing->name : 'No Billing Details' }}</span>
                                            <br>
                                            <a href="tel: {{ $order->rel_to_billing ? $order->rel_to_billing->mobile : 'No Billing Details' }}">
                                                <span>{{ $order->rel_to_billing ? $order->rel_to_billing->mobile : 'No Billing Details' }}</span>
                                            </a>
                                            <br>
                                            <span>{{ $order->rel_to_billing ? $order->rel_to_billing->address : 'No Billing Details' }}</span>
                                            <br>
                                            <span>{{ $order->rel_to_billing ? $order->rel_to_billing->district : 'No Business Name' }}</span><br>
                                            @if ($order->status == 4)
                                                <button class="badge badge-primary order_copy" data-order-id="{{ $order->id }}">P.Slip</button>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($order->rel_to_orderpro as $OrderProduct)
                                                @if ($OrderProduct != null)
                                                    @if ($order->landing == 1)
                                                        <span>{{ $OrderProduct->rel_to_pro->name??'' }} <br> <span class="quantity_copy">
                                                            {{ $OrderProduct->quantity }}</span> x {{ $OrderProduct->price }},
                                                            @if ($order->color != null)
                                                                Color: {{ $order->color }}
                                                            @endif
                                                            @if ($order->size)
                                                                Size: {{ $order->size }}
                                                            @endif
                                                        </span><hr>
                                                    @else
                                                        @if ($OrderProduct->rel_to_attribute != null)
                                                            <span>{{ $OrderProduct->rel_to_pro->name??'' }} <br> {{ $OrderProduct->quantity }} x {{ $OrderProduct->price }},
                                                                @if ($OrderProduct->rel_to_attribute->weight != null)
                                                                    Package: {{ $OrderProduct->rel_to_attribute->weight }}
                                                                
                                                                @else
                                                                    Color: {{ optional($OrderProduct->rel_to_attribute->rel_to_color)->name ?? 'N/A' }}
                                                                    Size: {{ optional($OrderProduct->rel_to_attribute->rel_to_size)->name ?? 'N/A' }}
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
                                                <div class="badge badge-info">On Hold</div>
                                            @elseif ($order->status == 2)
                                                <div class="badge badge-primary">Processing Order</div>
                                            @elseif ($order->status == 3)
                                                <div class="badge badge-warning">On Delivery</div>
                                            @elseif ($order->status == 4)
                                                <div class="badge badge-success">Confirmed</div>
                                            @else
                                                <div class="badge badge-danger">Cancel</div>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d-m-Y h:i:s') }}</td>
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

<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Order details will be dynamically populated here -->
                <pre id="orderDetailsContent"></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="copyOrderDetails">Copy</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer_scripts')

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Order details copied to clipboard!');
            }, function() {
                alert('Failed to copy order details.');
            });
        }

        document.querySelectorAll('.order_copy').forEach(function(button) {
            button.addEventListener('click', function() {
                var orderId = this.getAttribute('data-order-id');
                console.log('Copy button clicked for order ID:', orderId);

                var orderRow = this.closest('tr');
                var order = {
                    order_id: orderRow.querySelector('td:nth-child(4)').textContent.trim(),
                    name: orderRow.querySelector('td:nth-child(5) span').textContent.trim(),
                    address: orderRow.querySelectorAll('td:nth-child(5) span')[2].textContent.trim(),
                    phone: orderRow.querySelector('td:nth-child(5) a').textContent.trim(),
                    color: orderRow.querySelector('td:nth-child(6) span:nth-child(1)').textContent.split(':')[1].trim(),
                    quantity: orderRow.querySelector('.quantity_copy').textContent.trim(),
                    bill: orderRow.querySelector('td:nth-child(9)').textContent.trim(),
                };

                var orderDetailsText = `
Order NO: ${order.order_id}
Name: ${order.name}
Address: ${order.address}
Phone: ${order.phone}
Color: ${order.color}
Quantity: ${order.quantity}
Bill: ${order.bill}
                `;
                console.log('Order details to copy:', orderDetailsText);
                copyToClipboard(orderDetailsText.trim());
            });
        });
    });
</script>

{{-- <script type="text/javascript">
    $(document).ready(function () {
        var start_date = '{{ $defaultStartDate }}';
        var end_date = '{{ $defaultEndDate }}';

        if (start_date && end_date) {
            start_date = moment(start_date, 'YYYY-MM-DD');
            end_date = moment(end_date, 'YYYY-MM-DD');
        } else {
            start_date = 'moment().subtract(6, 'days')';
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

        function navigateToOrders(status) {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var url = '{{ url("admin/orders") }}' + '?status=' + status + '&start_date=' + start_date + '&end_date=' + end_date;
            window.location.href = url;
        }

        document.getElementById('total-orders').addEventListener('click', function() {
            navigateToOrders('');
        });

        document.getElementById('pending-orders').addEventListener('click', function() {
            navigateToOrders('pending');
        });

        document.getElementById('confirm-orders').addEventListener('click', function() {
            navigateToOrders('confirm');
        });

        document.getElementById('hold-orders').addEventListener('click', function() {
            navigateToOrders('hold');
        });

        document.getElementById('cancel-orders').addEventListener('click', function() {
            navigateToOrders('cancel');
        });
    });
</script> --}}


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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('total-orders').addEventListener('click', function() {
            window.location.href = '{{ url("admin/orders") }}';
        });

        document.getElementById('pending-orders').addEventListener('click', function() {
            window.location.href = '{{ url("admin/orders") }}?status=pending';
        });

        document.getElementById('confirm-orders').addEventListener('click', function() {
            window.location.href = '{{ url("admin/orders") }}?status=confirm';
        });

        document.getElementById('hold-orders').addEventListener('click', function() {
            window.location.href = '{{ url("admin/orders") }}?status=hold';
        });

        document.getElementById('cancel-orders').addEventListener('click', function() {
            window.location.href = '{{ url("admin/orders") }}?status=cancel';
        });
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
