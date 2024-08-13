@extends('frontend.layouts.app')
@section('content')

<body>

    <div class="main-wrapper">
        <style>
            /*.product {*/
            /*    width: calc(25% - -146px) !important;*/
            /*}*/

            .sidebar-main {
                width: 340px;
                background: rgba(255, 255, 255, 0);
                height: 100%;
                max-height: auto;
                padding: 20px;
            }

            .sidebar {
                min-height: 600px;
                border: 0px solid black;
                padding: 10px;
                font-family: 'Poppins', sans-serif;
                height: 100%;
            }

            .sidebar_dismiss {
                position: absolute;
                top: 20px;
                right: 20px;
            }

            @media (max-width: 1200px) {
                .sidebar-main {
                    width: 300px;
                    background: white;
                    position: fixed;
                    left: -300px;
                    top: 0;
                    visibility: hidden;
                    opacity: 0;
                    height: 100%;
                    z-index: 999;
                    max-height: 100vh;
                    overflow-y: auto;
                    padding: 20px;
                }

                .sidebar-main.active {
                    visibility: visible;
                    opacity: 1;
                    left: 0;
                }
            }

            ul.categories {
                position: relative;
                width: 100%;
                padding-top: 10px;
                padding-left: 10px;
            }

            ul li {
                list-style: none;
            }

            .categories .category .checkbox {
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                margin-bottom: 0;
                padding: 5px;
                display: flex;
                align-items: center;
                margin-top: 0;
            }

            .categories .category>.checkbox {
                color: #00aeef;
            }

            .categories .category .checkbox input:focus {
                border: none;
                outline: none;
            }

            .categories .category .checkbox .shop_checkbox {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                background-color: rgba(65, 66, 71, 0.08);
                border: none;
                height: 1.5rem;
                margin: 0;
                margin-right: 0.5rem;
                position: relative;
                width: 1.5rem;
                margin-top: -1px;
            }

            .categories .category .checkbox .shop_checkbox::after {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                background-color: rgba(65, 66, 71, 0.08);
                border: none;
                height: 1rem;
                margin: 0;
                margin-right: 0.5rem;
                position: relative;
                width: 1rem;
                margin-top: -1px;
            }

            .categories .category .sub_categories {
                padding-left: 20px;
            }

            .categories .category .sub_cateogries>.checkbox {
                font-weight: 700;
            }

            .categories .category .checkbox .badge {
                position: absolute;
                right: 10px;
                background: rgba(65, 66, 71, 0.08);
                color: black;
            }

            .categories .category .checkbox.active .shop_checkbox {
                background-color: #ffc107;
                position: relative;
            }

            .categories .category .checkbox.active .shop_checkbox::after {
                background-color: #fff;
                border-radius: 4px;
                content: '';
                height: 4px;
                left: 50%;
                position: absolute;
                top: 50%;
                transform: translateX(-2px) translateY(-1px);
                width: 4px;
            }

            @media (min-width: 1200px) {
                .shop_products {
                    width: calc(100% - 350px);
                    align-items: flex-start;
                }

                .shop_products .product {
                    width: calc(25% - 10px);
                }
            }

            .price-input {
                width: 100%;
                display: flex;
                margin: 10px 0 10px;
            }

            .price-input .field {
                display: flex;
                width: 100%;
                height: 45px;
                align-items: center;
            }

            .price-input .field .price_symbol {
                font-size: 18px;
                margin: 0;
            }

            .field input {
                width: 100%;
                height: 25px;
                outline: none;
                font-size: 16px;
                margin-left: 5px;
                border-radius: 5px;
                text-align: center;
                border: 1px solid #dfdfdf;
                -moz-appearance: textfield;
            }

            .price-input .field span {
                font-weight: 500;
                font-size: 14px;
            }

            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
                -webkit-appearance: none;
            }

            .price-input .separator {
                width: 50px;
                display: flex;
                font-size: 19px;
                align-items: center;
                justify-content: center;
            }

            .slider {
                height: 5px;
                position: relative;
                background: #ddd;
                border-radius: 5px;
                margin-top: 20px;
            }

            .slider .progress {
                height: 100%;
                left: 4%;
                right: 25%;
                position: absolute;
                border-radius: 5px;
                background: #ff5f02;
            }

            .range-input {
                position: relative;
            }

            .range-input input {
                position: absolute;
                width: 100%;
                height: 5px;
                top: -5px;
                background: none;
                pointer-events: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }

            input[type="range"]::-webkit-slider-thumb {
                height: 17px;
                width: 17px;
                border-radius: 50%;
                background: #ff5f02;
                pointer-events: auto;
                -webkit-appearance: none;
                box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
            }

            input[type="range"]::-moz-range-thumb {
                height: 17px;
                width: 17px;
                border: none;
                border-radius: 50%;
                background: #ff5f02;
                pointer-events: auto;
                -moz-appearance: none;
                box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
            }

        </style>

        <div class="container-xl">
            <div class="">
                <div class="products shopProducts mt-3">
                    <div class="products mt-3 row">
                        @foreach ($products as $product)
                            <div class="product col-lg-2 product_radias mx-2 home_product_shadwo my-3">
                                <a href="{{route('product.details', $product->slug)}}">
                                    <div class="image">
                                        @if ($product->inventorie_id != null)
                                            @if ($product->rel_to_inventorie)
                                                @php
                                                    $inventorie = $product->rel_to_inventorie
                                                @endphp
                                                @foreach ($inventorie->rel_to_attribute->take(1) as $attribute)
                                                    <img src="{{asset('uploads/product')}}/{{ $attribute->image }}" alt="Product image" class="first">
                                                    <img src="{{asset('uploads/product')}}/{{ $attribute->image }}" alt="Product image" class="second">
                                                @endforeach
                                            @endif
                                        @else
                                            <img src="{{asset('uploads/product')}}/{{$product->image}}" alt="Product image" class="first">
                                            <img src="{{asset('uploads/product')}}/{{$product->image}}" alt="Product image" class="second">
                                        @endif
                                    </div>
                                </a>

                                {{-- <div class="labels d-none">
                                    <div class="tag bg-dark text-light">
                                        -39%
                                    </div>
                                    <div class="tag bg-danger text-light">
                                        Sold Out
                                    </div>
                                </div> --}}
                                <div class="content">
                                    <a href="{{route('product.details', $product->slug)}}">
                                        <div class="title">{{Str::limit($product->name, '25', '')}}</div>
                                    </a>
                                    
                                    <div class="price my-2">
                                        @if ($product->inventorie_id != null)
                                            @if ($product->rel_to_inventorie)
                                                @php
                                                    $inventorie = $product->rel_to_inventorie
                                                @endphp
                                                @foreach ($inventorie->rel_to_attribute->take(1) as $attribute)
                                                    @if ($attribute->sell_price != null)
                                                        <span>{{$attribute->sell_price}} Tk</span>
                                                        <del>{{$attribute->price}} Tk</del>
                                                    @else
                                                        <span >{{$attribute->price}} Tk</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @else
                                            @if ($product->sell_price != null)
                                                <span>{{$product->sell_price}} Tk</span>
                                                <del>{{$product->price}} Tk</del>
                                            @else
                                                <span>{{$product->price}} Tk</span>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="">
                                        <a class="submit_button btn btn-successs d-block cart_button"
                                            href="{{route('product.details', $product->slug)}}" style="width: 100%;font-size: 13px;">
                                            <div class="cart_btn bangali bold text-white">Buy Now <i class="fa fa-cart-shopping cart_icon"></i></div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="my-3 text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

