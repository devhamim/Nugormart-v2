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
            background: #ffffff !important;
        }

        .ord_bt {
            color: #ffffff !important;
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
        .nav_bg{
            background: #007cea !important;
        }
    </style>
    <div class="">
        <div class="">
            <nav class="navbar navbar-expand-lg top_nav navbar-light bg-light nav_bg">
                <div class="container-xl">
                    <button class="navbar-toggler side_menu_toggler display_sm border-0 font-22 btn" type="button">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="text-center">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            @if($setting->first()->black_logo != null)
                                <img src="{{ asset('uploads/setting') }}/{{ $setting->first()->black_logo }}" width="115" alt="Logo">
                            @else
                                <img src="{{ asset('uploads/setting') }}/{{ $setting->first()->white_logo }}" width="115" alt="Logo">
                            @endif
                        </a>
                    </div>

                    <div class="icon_cart semi me-lg-0 pe-lg-0 display_sm">
                        <a href="{{ route('checkout') }}">
                            <div class=" badge2 px-0">
                                <h5 class="fa fa-bag-shopping"></h5>
                                    <span class="badge bg-warning rounded-circle">{{ $totalItemsInCart }}</span>
                            </div>
                        </a>
                    </div>
                    <form class="d-flex header_search" id="search_form" action="{{ route('shop') }}" method="GET">
                        <input class="form-control" type="text" placeholder="Search" name="q" id="search_input" required value="{{@$_GET['q']}}" />
                        <button class="btn btn-warning my-sm-0 text-light" id="search_btn" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <div class="display_lg">
                        <div class="d-lg-flex d-none align-items-center gap-2 ps-lg-3">
                            @if($setting->first()->number_one != null)
                                <a href="tel:{{ $setting->first()->number_one }}" class="font-22" style="font-size: 20px;color: #ffffff">
                                    <i class="fa fa-phone" style="color: #ffffff;"></i>
                                    {{ $setting->first()->number_one }}
                                </a>
                            @endif

                            <div class="icon_cart semi ms-3 me-lg-0 pe-lg-0">
                                <a href="{{ route('checkout') }}">
                                    <div class=" badge2 px-0">
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
                    <div class="d-lg-flex align-items-center justify-content-center">
                        <ul class="navbar-nav ms-2">
                            {{-- <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link semi font-14">HOME</a>
                            </li> --}}
                            @foreach ($categorys->take(8) as $category)
                                <li class="nav-item dropdown">
                                    <a href="{{ route('category.show', $category->id) }}" class="nav-link font-14 dropdown-toggle" id="navbarDropdown{{ $category->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $category->name }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $category->id }}">
                                        @foreach ($subcategorys as $subcategory)
                                            @if ($category->id == $subcategory->category_id)
                                                <li><a class="dropdown-item" href="{{ route('subcategory.show', $subcategory->id) }}">{{ $subcategory->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
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

{{-- <div class="overlay"></div> --}}
    <div class="menu_sidebar">

        <style>
            .nav_mobile {
                max-height: calc(100vh - 86px);
                overflow-y: auto;
            }
            .navbar-nav {
                list-style-type: none;
                padding: 0;
                margin: 0;
                display: flex;
                justify-content: flex-start;
            }

            .nav-item {
                position: relative;
            }

            .nav-link {
                display: block;
                padding: 10px 15px;
                text-decoration: none;
                color: #333;
            }

            .nav-link:hover {
                background-color: #f0f0f0;
            }

            /* Submenu */
            .submenu {
                display: none;
                position: absolute;
                top: 100%;
                right: 0;
                background-color: #fff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                padding-right: 20px;
                
            }

            .nav-item:hover .submenu {
                display: block;
            }

            .submenu li {
                display: block;
            }

            .submenu a {
                padding: 10px 15px;
                color: #333;
                text-decoration: none;
                display: block;
            }

            .submenu a:hover {
                background-color: #f0f0f0;
            }

        </style>
        <ul class="navbar-nav nav_mobile">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link active">Home</a>
            </li>
            @foreach ($categorys->take(8) as $category)
                <li class="nav-item has-submenu">
                    <a class="nav-link" href="{{ route('category.show', $category->id) }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $category->name }}</a>
                    <!-- Submenu Structure -->
                    <ul class="submenu">
                        @foreach ($subcategorys as $subcategory)
                                @if ($category->id == $subcategory->category_id)
                            <li>
                                <a href="{{ route('subcategory.show', $subcategory->id) }}">{{ $subcategory->name }}</a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>        
     
        {{-- <script>
            $('i.fa-close').click(function() {
                $('.menu_sidebar').removeClass('active');
                $('.overlay').hide();
            })
        </script> --}}
    </div>