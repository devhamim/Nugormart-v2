@extends('frontend.layouts.app')
@section('content')
    <style>
        .fixed-cart-whats {
            position: fixed;
            bottom: 14rem;
            right: 35px;
            border-radius: 12px;
            cursor: pointer;
            text-align: center;
            align-items: center;
            justify-content: center;
            transition: 0.5s;
            z-index: 9999;
        }

        .fixed-cart-bottom {
            position: fixed;
            bottom: 9rem;
            right: 35px;
            background: #000000;
            border-radius: 12px;
            height: 54px;
            width: 60px;
            cursor: pointer;
            box-shadow: 2px 2px 8px gray;
            text-align: center;
            align-items: center;
            justify-content: center;
            transition: 0.5s;
            z-index: 9999;
        }

        .navbar-brand {
            width: 290px;
        }


        @media(max-width: 575px) {
            .header_search .form-control {
                width: 100% !important;
            }
        }



        @media(max-width: 768px) {
            .navbar-brand {
                width: auto;
            }
        }

        @media(min-width: 1600px) {
            .fixed-cart-bottom {
                right: 10%;
            }
        }

        @media(min-width: 2000px) {
            .fixed-cart-bottom {
                right: 20%;
            }
        }

        .cart_button {
            background: #00276C !important;
        }

        .ord_bt {
            color: #00276C !important;
        }

        .cart_icon {
            color: #ffffff !important;
        }

        .products {
            align-content: flex-start;
        }

        .fa-bag-shopping:before,
        .fa-shopping-bag:before {
            content: "\f290";
            color: #ffffff;
        }
    </style>

<div class="container-xl my-5">
    @if (isset($cart_data))
        @if(Cookie::get('shopping_cart'))
            @php $total = 0; @endphp
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 order-md-last order-last">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Cart </h5>
                            </div>
                            <div class="card-body">
                                <div class="table">
                                    <table class="table table-strip">
                                        <thead>
                                            <tr>
                                                <th scope="col">Image</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart_data as $data)
                                                <tr class="table-shadow" style="border-style: hidden">
                                                    <td style="padding-right: 10px; width: 15%;">
                                                        <img width="100%" src="{{ asset('uploads/product') }}/{{ $data['item_image'] }}" alt="">
                                                    </td>
                                                    <td>
                                                        <style>
                                                            .product_info p{
                                                                margin-bottom: 0;
                                                                font-weight: 400;
                                                            }
                                                        </style>
                                                        <div class="product_info">
                                                            <p><a style="font-weight: 500;" href="{{ route('product.details', $data['item_slug']) }}">{{ urldecode($data['item_name']) }}</a></p>
                                                            @if (isset($data['item_weight']) && $data['item_weight'] !== null)
                                                                <p>Package: {{ urldecode($data['item_weight']) }}</p>
                                                            @endif
                                                            @if (isset($data['item_color']) && $data['item_color'] !== null)
                                                                <p>Color: {{ urldecode($data['item_color']) }}</p>
                                                            @endif
                                                            @if (isset($data['item_size']) && $data['item_size'] !== null)
                                                                <p>Size: {{ urldecode($data['item_size']) }}</p>
                                                            @endif
                                                            <p>Tk <span class="product-price" style="display: inline">
                                                                {{ isset($data['item_price']) ? $data['item_price'] : $data['product_price'] }}
                                                            </span></p>
                                                        </div>
                                                        <div class="cart-product-quantity">
                                                            <input type="hidden" class="product-id" value="{{ $data['item_id'] }}">
                                                            <span class="subtotal d-none">Tk {{ ($data['item_quantity'] ?? 1) * ($data['item_price'] ?? $data['product_price']) }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="ps-3 text-center pro_details_ico" style="padding-top: 15px; justify-content: center; width: 20%; margin: 0 auto">
                                                        <div class="cart-bottom mb-3">
                                                            <button type="button" class="btn btn-danger clear_cart" data-item-id="{{ $data['item_id'] }}">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" name="quantity[{{ $data['item_id'] }}]" class="qty-input form-control" value="{{ $data['item_quantity'] }}" min="1" max="100" step="1" data-decimals="0" required>
                                                    </td>
                                                </tr>
                                                @php
                                                    if ($data['item_price'] != null) {
                                                        $total = $total + ($data["item_quantity"] * $data["item_price"]);
                                                    } else {
                                                        $total = $total + ($data["item_quantity"] * $data["product_price"]);
                                                    }
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-strip">
                                        <tbody>
                                            <tr class="summary-total checkout_bottom_border">
                                                <td  style="width: 60%;">Sub Total</td>
                                                <td class="grand_total_price text-end">Tk {{ $total }}</td>
                                            </tr>
                                            <tr class="summary-total delivery-charge-row checkout_bottom_border" style="display: none;">
                                                <td style="width: 60%;">Shipping Charge</td>
                                                <td class="text-end">
                                                    <span id="delivery-charge"></span>
                                                    <input type="hidden" name="delivery_charge" id="delivery-charge-input">
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="">
                                                <td style="width: 60%;">Payable Amount</td>
                                                <td class="grand_total text-end">
                                                    <span class="grand_span">Tk {{ $total }}</span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <input type="hidden" name="sub_total" value="{{ $total }}">
                                            <input type="hidden" name="total" value="{{ $total }}">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>



                    </div>

                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4 class="mb-3">Place Your Order</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                        <div class="col-sm-12">
                                            <label for="firstName" class="form-label">Name</label>
                                            <input type="text" class="form-control p-2" placeholder="Full Name"
                                                value="{{ old('name') }}" name="name">
                                        </div>
                                        @error('name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror

                                        <div class="col-sm-12">
                                            <label for="firstName" class="form-label">Mobile Number</label>
                                            <input type="tel" class="form-control"
                                                placeholder="01xxx-xxxxx" maxlength="11" minlength="11"
                                                value="{{ old('mobile') }}" name="mobile">
                                        </div>
                                        @error('mobile')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                        <div class="col-12">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control p-4" placeholder="Full Address" name="address"
                                                value="{{ old('address') }}">
                                        </div>
                                        @error('address')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror

                                        <div class="col-12">
                                            <label>District <span class="text-danger">*</span></label>
                                            <select name="district" id="district" class="form-control" required>
                                                <option value="">-- Select --</option>
                                                <option value="dhaka">Dhaka</option>
                                                <option value="faridpur">Faridpur</option>
                                                <option value="gazipur">Gazipur</option>
                                                <option value="gopalganj">Gopalganj</option>
                                                <option value="jamalpur">Jamalpur</option>
                                                <option value="kishoreganj ">Kishoreganj </option>
                                                <option value="madaripur">Madaripur</option>
                                                <option value="manikganj">Manikganj</option>
                                                <option value="munshiganj">Munshiganj</option>
                                                <option value="mymensingh">Mymensingh</option>
                                                <option value="narayanganj">Narayanganj</option>
                                                <option value="Norshingdi">Norshingdi</option>
                                                <option value="Netrokona">Netrokona</option>
                                                <option value="Rajbari">Rajbari</option>
                                                <option value="Shariatpur">Shariatpur</option>
                                                <option value="Sherpur">Sherpur</option>
                                                <option value="Tangail">Tangail</option>
                                                <option value="Bagerhat">Bagerhat</option>
                                                <option value="Chuadanga">Chuadanga</option>
                                                <option value="Jessore">Jessore</option>
                                                <option value="Jhenaidah">Jhenaidah</option>
                                                <option value="Khulna">Khulna</option>
                                                <option value="Kushtia">Kushtia</option>
                                                <option value="Magura">Magura</option>
                                                <option value="Meherpur">Meherpur</option>
                                                <option value="Narail">Narail</option>
                                                <option value="Satkhira">Satkhira</option>
                                                <option value="Bogra">Bogra</option>
                                                <option value="Chapai-Nawabganj">Chapai Nawabganj</option>
                                                <option value="Joypurhat">Joypurhat</option>
                                                <option value="Naogaon">Naogaon</option>
                                                <option value="Natore">Natore</option>
                                                <option value="Pabna">Pabna</option>
                                                <option value="Rajshahi">Rajshahi</option>
                                                <option value="Sirajganj">Sirajganj </option>
                                                <option value="Habiganj">Habiganj</option>
                                                <option value="Moulvibazar">Moulvibazar</option>
                                                <option value="Sunamganj">Sunamganj </option>
                                                <option value="Sylhet">Sylhet </option>
                                                <option value="Barguna">Barguna </option>
                                                <option value="Barisal">Barisal</option>
                                                <option value="Bhola">Bhola</option>
                                                <option value="Jhalokathi">Jhalokathi</option>
                                                <option value="Patuakhali">Patuakhali</option>
                                                <option value="Perojpur">Perojpur</option>
                                                <option value="Bandarban">Bandarban</option>
                                                <option value="Brahmanbaria">Brahmanbaria</option>
                                                <option value="Chandpur">Chandpur</option>
                                                <option value="Chittagong">Chittagong</option>
                                                <option value="comilla">Comilla</option>
                                                <option value="coxs-bazar">Cox's Bazar</option>
                                                <option value="Feni">Feni</option>
                                                <option value="Khagrachari">Khagrachari</option>
                                                <option value="Laksmipur">Laksmipur</option>
                                                <option value="Noakhali">Noakhali</option>
                                                <option value="Rangamati">Rangamati</option>
                                                <option value="Dinajpur">Dinajpur</option>
                                                <option value="Gaibandha">Gaibandha</option>
                                                <option value="Kurigram">Kurigram</option>
                                                <option value="Lalmonirhat">Lalmonirhat</option>
                                                <option value="Nilphamari">Nilphamari</option>
                                                <option value="Panchagarh">Panchagarh</option>
                                                <option value="Rangpur">Rangpur</option>
                                                <option value="Thakurgaon">Thakurgaon</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="state" class="form-label">Payment Method</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="paying_method"
                                                    id="cash_on_delivery" value="cash_on_delivery" checked>
                                                <label class="form-check-label" for="cash_on_delivery">
                                                    Cash On Delivery
                                                </label>
                                            </div>
                                            {{-- <div class="form-check">
                                                <input class="form-check-input" type="radio" name="paying_method"
                                                    id="bkash" value="bkash">
                                                <label class="form-check-label" for="bkash">
                                                    Online Payment
                                                </label>
                                            </div> --}}

                                        </div>


                                        <hr class="my-4">

                                        <button class="w-100 btn btn-warning btn-lg sub_btn" type="submit">Place Order</button>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    @else
        <h2 class="text-danger m-auto text-center mt-5">No product added for checkout</h2>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css" />
@endsection
@section('footer_script')
<script>
    $(document).ready(function () {
        $('.clear_cart').click(function (e) {
            e.preventDefault();
    
            var itemId = $(this).data('item-id');
    
            $.ajax({
                url: '/clear-cart/' + itemId,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    window.location.reload();
                    alertify.set('notifier','position','top-right');
                    alertify.success(response.status);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alertify.error('Failed to clear cart.');
                }
            });
    
        });
    });
    </script>
    

<script>
    $(document).ready(function () {
        $(".qty-input").on("change", function () {
            var $row = $(this).closest("tr");
            var quantity = parseInt($(this).val());
            var price = parseFloat($row.find(".product-price").text().replace('Tk ', ''));
            var subtotal = quantity * price;

            $row.find(".subtotal").text("Tk " + subtotal);
            updateTotalPrice();
            updateGrandTotalPrice();
        });

        $('#district').change(function() {
            var district = $(this).val();
            var subtotal = parseFloat($('.grand_total_price').text().replace('Tk ', ''));
            var deliveryCharge = 0;
            if (district === 'dhaka') {
                deliveryCharge = {{ $delevarychareg->where('id', 1)->first()->charge }};
            } else {
                deliveryCharge = {{ $delevarychareg->where('id', 2)->first()->charge }};
            }
            var grandTotal = subtotal + deliveryCharge;

            $('#delivery-charge').text('Tk ' + deliveryCharge);
            $('#delivery-charge-input').val(deliveryCharge);
            $('.summary-total.delivery-charge-row').show();
            $('.grand_total').text('Tk ' + grandTotal).show();
            updateGrandTotalPrice();
        });

        function updateTotalPrice() {
            var totalPrice = 0;
            $(".subtotal").each(function () {
                var subtotal = parseFloat($(this).text().replace('Tk ', ''));
                totalPrice += subtotal;
            });
            $(".grand_total_price").text("Tk " + totalPrice);
            $("input[name='sub_total']").val(totalPrice);
        }

        function updateGrandTotalPrice() {
            var grandTotal = 0;
            $(".subtotal").each(function () {
                var subtotal = parseFloat($(this).text().replace('Tk ', ''));
                grandTotal += subtotal;
            });

            var district = $('#district').val();
            var deliveryCharge = 0;
            if (district === 'dhaka') {
                deliveryCharge = {{ $delevarychareg->where('id', 1)->first()->charge }};
            } else {
                deliveryCharge = {{ $delevarychareg->where('id', 2)->first()->charge }};
            }
            grandTotal += deliveryCharge;
            $(".grand_total").text("Tk " + grandTotal);
            $("input[name='total']").val(grandTotal);
        }
    });

    function removeProduct(button) {
        var row = button.closest('tr');
        row.remove();
        updateTotalPrice();
        updateGrandTotalPrice();
    }
</script>


<script>
    $('.apply_coupon_btn').click(function(e) {
        e.preventDefault();
        var coupon_code = $('.coupon_code').val();

        if($.trim(coupon_code).length == 0) {
            error_coupon = "Please enter valid coupon";
            $('#error_coupon').text(error_coupon);

        } else {
            error_coupon = '';
            $('#error_coupon').text(error_coupon);
        }


        if(error_coupon != '') {
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/check-coupon-code",
            data: {
                'coupon_code': coupon_code
            },
            success: function(response) {
                if(response.error_status == 'error') {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.status);
                    $('.coupon_code').val('');
                } else {
                    $('.grand_total_price').text(response.grand_total_price);
                    $('.discount_price').text(response.discount_price);
                    $('.coupon_code').text(response.coupon_code);
                }
            }
        })
    })
</script>

@endsection
