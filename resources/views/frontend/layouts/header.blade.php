<header class="header">
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
            background: #fe4e00 !important;
        }

        .ord_bt {
            color: #fe4e00 !important;
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
            color: #fe4e00;
        }
    </style>
    <div class="">
        <div class="">
            <nav class="navbar navbar-expand-lg top_nav navbar-light bg-light">
                <div class="container-xl">
                    <button class="navbar-toggler side_menu_toggler display_sm border-0 font-22 btn" type="button">
                        <i class="fa fa-bars"></i>
                    </button>

                    <a class="navbar-brand m-0" href="{{ url('/') }}" >
                        @if($setting->first()->black_logo != null)
                            <img src="{{ asset('uploads/setting') }}/{{ $setting->first()->black_logo }}" width="115" alt="Logo">
                        @else
                            <img src="{{ asset('uploads/setting') }}/{{ $setting->first()->white_logo }}" width="115" alt="Logo">
                        @endif
                    </a>

                    <div class="icon_cart semi  me-lg-0 pe-lg-0 display_sm">
                        <a href="{{ route('checkout') }}">
                            <div class=" badge2 px-0">
                                <h5 class="fa fa-bag-shopping"></h5>
                                    <span class="badge bg-warning rounded-circle">{{ $totalItemsInCart }}</span>
                            </div>
                        </a>
                    </div>
                    <form class="d-flex header_search" id="search_form" action="{{ route('shop') }}" method="GET">
                        <input class="form-control" type="text" placeholder="Search" name="q" id="search_input" required value="{{@$_GET['q']}}" />
                        <button class="btn btn-warning my-2 my-sm-0 text-light" id="search_btn" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <div class="display_lg">
                        <div class="d-lg-flex d-none align-items-center gap-2 ps-lg-3">
                            @if($setting->first()->number_one != null)
                                <a href="tel:{{ $setting->first()->number_one }}" class="font-22" style="font-size: 20px;color: #fe4e00">
                                    <i class="fa fa-phone" style="color: #fe4e00;"></i>
                                    {{ $setting->first()->number_one }}
                                </a>
                            @endif

                            <div class="icon_cart semi btn me-lg-0 pe-lg-0">
                                <a href="{{ route('checkout') }}">
                                    <div class="btn badge2 px-0">
                                        <h5 class="fa fa-bag-shopping"></h5>
                                            <span class="badge bg-warning rounded-circle">{{ $totalItemsInCart }}</span>
                                    </div>
                                </a>
                                <!--<span class="ms-3 font-14">৳4,500</span>-->
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg bottom_nav navbar-light bg-light border-top border-bottom">
                <div class="container-xl display_lg">
                    <div class="d-lg-flex align-items-center">
                        <div class="dropdown category_dropdown_box shop_category_dropdown">
                            <div class="category_dropdown btn btn-warning rounded-0">
                                <i class="fa fa-bars"></i>
                                <span class="text-cap medium font-13 ms-2  nato">Browse Categories</span>
                                <i class="fa fa-angle-down ms-auto"></i>
                            </div>
                            <div class="categories dp_content">
                                @foreach ($categorys->take(8) as $category)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </div>
                        </div>


                        {{-- <div class="dropdown category_dropdown_box ">
                            <div class="category_dropdown btn btn-warning rounded-0">
                                <i class="fa fa-bars"></i>
                                <span class="text-cap medium font-13 ms-2  nato">Browse Categories</span>
                                <i class="fa fa-angle-down ms-auto"></i>
                            </div>
                            <div class="categories dp_content">
                                @foreach ($categorys->take(8) as $category)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </div>
                        </div> --}}

                        <ul class="navbar-nav ms-2">
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link text-warning semi font-14">HOME</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('shop') }}" class="nav-link text-warning semi font-14">SHOP</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </div>
    </div>

    <a href="https://api.whatsapp.com/send?phone=88{{$setting->first()->number_two}}&text=Hello%20there,%20I%20found%20you%20on%20website!%20i%20would%20like%20to%20talk%20about%20your%20Product." target="_blank" class="cart-dropdown-btn">
        <div class="fixed-cart-whats">
            <img width="48" height="48" src="{{ asset('frontend/assets/image/sm_5b321c99945a2.png') }}" alt="whatsapp--v1" />
        </div>
    </a>

</header>

<div class="overlay"></div>
    <div class="menu_sidebar">

        <ul class="navbar-nav nav_mobile">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link active">Home</a>
            </li>
            @foreach ($categorys->take(8) as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
        <style>
            .nav_mobile {
                max-height: calc(100vh - 86px);
                overflow-y: auto;
            }
        </style>

        {{-- <script>
            $('i.fa-close').click(function() {
                $('.menu_sidebar').removeClass('active');
                $('.overlay').hide();
            })
        </script> --}}
    </div>