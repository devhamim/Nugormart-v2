@extends('backend.layouts.app')
@section('content')
{{-- <div class="content">
    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Add Order</h1>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Order</p>
        </div>
        <div>
            <a href="{{ route('orders.index') }}" class="btn btn-primary"> All Order
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add Order</h2>
                </div>

                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row ec-vendor-uploads">
                            <div class="col-lg-6">
                                <h5 class="pb-3">Customer Details</h5>
                                <div class="ec-vendor-img-upload">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Product name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control slug-title @error('name') is-invalid @enderror" name="name"  value="{{ old('name') }}" required>
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h5 class="pb-3">Order Details</h5>
                                <div class="ec-vendor-upload-detail">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Product name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control slug-title @error('name') is-invalid @enderror" name="name"  value="{{ old('name') }}" required>
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2>Create Order</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Order</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->

            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('orders.index') }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-angle-double-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <form action="{{ route('orders.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    {{-- @php
                                        $firstOrder = $order_id->first();
                                        $invoiceId = $firstOrder ? (int)$firstOrder->invoice_id + 1 : 1;
                                    @endphp
                                        <input type="hidden" class="form-control" id="invoice_id" name="invoice_id" value="{{ $invoiceId }}" readonly required> --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label for="name">Customer Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                                        @error('name')
                                            <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="mobile">Customer Mobile <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="mobile" id="mobile" value="{{old('mobile')}}" required>
                                        @error('mobile')
                                            <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="district">District <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="district" name="district" value="{{old('district')}}" required>
                                        @error('district')
                                            <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="address">Customer Address <span class="text-secondery">Optional</span></label>
                                        <textarea name="address" id="address" class="form-control" required>{{old('address')}}</textarea>
                                        @error('address')
                                            <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label for="note">Order Note <span class="text-danger"></span></label>
                                        <textarea name="note" id="note" class="form-control" placeholder="Order Note">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="card">
                            <h4 class="card-header">Product Info</h4>
                            <div class="card-body">
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="prod_row">
                                        </tbody>
                                        <tbody>
                                        <tr>
                                            <td colspan="5">
                                                <div class="form-row">
                                                    <div class="form-group col-12 text-left">
                                                        <select id="product" class="form-control select2" required>
                                                                <option value="">Select A Product</option>
                                                            @foreach ($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group row" style="padding: 6px 0;">
                                    <label for="sub_total" class="offset-md-6 col-md-2 col-form-label text-right">Total</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="sub_total" name="sub_total" min="0" value="0" readonly>
                                    </div>
                                </div>

                                <div class="form-group row" style="padding: 6px 0;">
                                    <label for="discount" class="offset-md-6 col-md-2 col-form-label text-right">Discount</label>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" id="discount" min="0" name="discount" value="0">
                                    </div>
                                </div>

                                <div class="form-group row" style="padding: 6px 0;">
                                    <label for="paid" class="offset-md-6 col-md-2 col-form-label text-right">Paid</label>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" id="paid" min="0" name="paid" value="0">
                                    </div>
                                </div>

                                <div class="form-group row" style="padding: 6px 0;">
                                    <label for="due" class="offset-md-6 col-md-2 col-form-label text-right">Due</label>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" id="due" min="0" name="due" value="0.00" readonly>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <input type="submit" value="Save" class="btn btn-success w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
{{-- <script>

    $(document).ready(function () {
        $('.select2').select2();
    });
</script> --}}

<script>
    $(document).ready(function () {
    $('#product').on('change', function () {
        var product_id = $(this).val();

        $.ajax({
            url: '/getProduct',
            type: 'POST',
            data: {'product_id': product_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var newRowHtml = '<tr>' +
                    '<td>' + (data.sku ? data.sku : 'null') + '</td>' +
                    '<td>' +
                    '<input type="hidden" name="product_id[]" value="' + (data.product_id ? data.product_id : '') + '">' +
                    '<input type="text" class="form-control" value="' + (data.productName ? data.productName : '') + '" readonly>' +
                    '</td>' +
                    '<td>' +
                    '<input style="width: 60px; border: 1px solid #ddd;" min="1" type="number" class="form-control qty" name="quantity[]" value="1">' +
                    '<input type="hidden" name="price[]" class="price" value="' + (data.product_price ? data.product_price : '') + '">' +
                    '</td>' +
                    '<td class="total_price">' + ((data.product_price ? data.product_price : 0) * 1).toFixed(2) + '</td>' +
                    '<td><button class="btn btn-danger" onclick="removeProduct(this)">Remove</button></td>' +
                    '</tr>';

                $('#prod_row').append(newRowHtml);

                updateTotals();
            }
        });
    });

    $(document).on('input', '.qty', function () {
        updateRowTotal($(this));
    });

    $(document).on('input', '#discount, #paid', function () {
        updateTotals();
    });

    function updateRowTotal(input) {
        var row = input.closest('tr');
        var productPrice = parseFloat(row.find('.price').val());
        var quantity = parseFloat(input.val());
        var totalCell = row.find('.total_price');
        var newTotal = productPrice * quantity;
        totalCell.text(newTotal.toFixed(2));

        updateTotals();

        var productId = row.find('input[name="product_id[]"]').val();
        updateOrderProduct(productId, quantity);
    }

    function updateTotals() {
        var subTotal = 0;

        $('.total_price').each(function () {
            subTotal += parseFloat($(this).text());
        });

        $('#sub_total').val(subTotal.toFixed(2));

        var total = subTotal - parseFloat($('#discount').val()) - parseFloat($('#paid').val());
        $('#due').val(total.toFixed(2));

        finalCalc();
    }

    $('#paid').on('input', function () {
        updateTotals();
    });

    window.removeProduct = function (button) {

        var row = $(button).closest('tr');
        row.remove();

        updateTotals();
    };
});

</script>

{{-- <script>
    $(document).ready(function () {
        $('#customer_phone_select').change(function () {
            var customerId = $(this).val();
            $.ajax({
                url: '/getcustomerdata/' + customerId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#customer_name').val(data.name);
                    $('#busines_name').val(data.busines);
                    $('#customer_phone').val(data.phone);
                    $('#customer_email').val(data.email);
                    $('#customer_address').val(data.address);
                }
            });
        });
    });
</script> --}}

@endsection
