<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if ($setting->first()->title != null)
        <title>{{ $setting->first()->title }}</title>
    @endif
    @if ($setting->first()->favicon != null)
        <link rel="shortcut icon" href="{{ asset('uploads/setting') }}/{{ $setting->first()->favicon }}">
    @endif
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/silck/slick.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/silck/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/header.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/home.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/product.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/media.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />

    

    <!-- Meta Pixel Code -->
    @if ($setting->first()->fb_pixel != null)
        {!! $setting->first()->fb_pixel !!}
    @endif
    <!-- End Meta Pixel Code -->

    <!-- googletag Code -->
    @if ($setting->first()->google_tag != null)
        {!! $setting->first()->google_tag !!}
    @endif
    <!-- End googletag Code -->

    <style>
        body {
            color: #000;
            background-color: #f8f8f8;
        }
        .quantity_box{
        display: inline-flex;
        vertical-align: top;
        white-space: nowrap;
        font-size: 0;
        margin-bottom: 10px;
        width: 100%;
        }
        div.quantity_box button[type="button"] {
            padding: 0 5px;
            min-width: 25px;
            min-height: unset;
            height: 42px;
            border: 2px solid rgb(211, 211, 211);
            background: white;
            box-shadow: none;
            color: black;
            border-radius: 0;
        }
        div.quantity_box button[type="button"]:hover {
            color: #fff;
            background-color: orange;
            border-color: orange;
        }
        div.quantity_box input[type="text"] {
            width: 40px;
            color: black;
            border-radius: 0;
            border: 2px solid rgb(211, 211, 211);
            border-right: none;
            border-left: none;
        }
        div.quantity_box button[type="button"].minus {
            border-radius: 3px 0 0 3px;
        }
        div.quantity_box button[type="button"].plus {
            border-radius: 0 3px 3px 0;
        }
        
        .burmanRadio {
            margin-bottom: 10px;
        }
        .burmanRadio__input {
            display: none;
        }
        .burmanRadio__input:checked ~ .burmanRadio__label::after {
            opacity: 1;
            transform: scale(1);
        }
        .burmanRadio__label {
            cursor: pointer;
            line-height: 30px;
            position: relative;
            margin-left: 35px;
        }
        .burmanRadio__label::before, .burmanRadio__label::after {
            border-radius: 50%;
            position: absolute;
            top: 5px;
            left: -22px;
            transition: all 0.3s ease-out;
            z-index: 2;
        }
        .burmanRadio__label::before {
            content: "";
            border: 1.5px solid #9d9d9d;
            width: 20px;
            height: 20px;
        }
        .burmanRadio__label::after {
            font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f00c";
            background: #ffc107;
            border: 1.5px solid #ffc107;
            color: #FFF;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            width: 20px;
            height: 20px;
            transform: scale(0);
        }
        .burmanRadio__label:hover::before {
            border-color: #7BC4CA;
        }
        .main-wrapper{
            background: #f8f9fa;
        }
            
        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden;
            /* box-shadow: 0px 0px 7px 0px gray; */
        }     

        .nav_images [data-bs-target] {
            /* height: 70px;
            width: 70px;
            box-shadow: 0px 0px 3px 0px gray; */
            padding: 1px;
        }
        
        .nav_images img {
            margin-bottom: 5px;
        }
        
        .nav_images .active {
            height: 100px;
            width: 100px;
        }
        .carousel-indicators [data-bs-target]{
            border: 0;
        }
        
        .wc-tab-inner iframe{
            width: 100%;
            height: 600px;
        }
        
        @media screen and (min-width: 320px) and (max-width: 412px) {
            #product_des li button {
                font-size: 13px !important;
            }
        }
        
        @media screen and (min-width: 320px) and (max-width: 767px) {
            .btn_submit {
                display: inline !important;
            }
        }
        
        .call_now button {
            width: 100%;
        }
        
        .call_now {
            margin-top: 10px;
        }
        
        @media (min-width: 992px) {
            .img_section {
                    flex: 0 0 auto;
                    width: 46.666667% !important;
                }
        }

        .ord_btn{
            font-size: 14px;
        }
        
        .add_to_cart {
            font-size: 15px;
        }
        .nav-tabs{
            border: 1px solid #000 !important;
            padding: 0px;
            border-radius: 3px; 
            background: #EFEFEF;
        }
        
        .nav-tabs .nav-link.active {
            /* background: #000; */
            border-radius: 5px;
        }

        .navbar-nav .dropdown-menu {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
        }

        /* .category_products .slick-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        } */

        .category_radias img {
            display: block;
            margin: 0 auto;
            border-radius: 10px;
        }

        .category_products img {
            display: block;
            margin: 0 auto;
        }

        /* .category_products .title {
            text-align: center;
            margin-top: 10px;
            font-size: 1rem;
        } */
        span{
            font-size: 14px;
        }
        del{
            font-size: 14px;
        }
        .product_details_h5 h5{
            font-size: 16px;
        }
        .navbar-toggler{
            color: #fff !important;
        }

        .product_details_card {
            width: 50%;
            padding: 10px 0;
            background: #CD6727;
            color: #fff;
            font-weight: 700;
            border: 0;
            border-radius: 10px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }
        .product_details_buy {
            width: 50%;
            background: #000;
            color: #fff;
            font-weight: 700;
            border: 0;
            border-radius: 10px;
            box-shadow: rgba(255, 255, 255, 0.25) 0px 50px 100px -20px, rgba(255, 255, 255, 0.3) 0px 30px 60px -30px, rgba(255, 255, 255, 0.35) 0px -2px 6px 0px inset;
        }
        .call-btn {
            width: 100%;
            background: #22C55E;
            text-align: center;
            padding: 10px 0;
            color: #fff;
        }
        .product_details_chat {
            width: 100%;
            background: #22C55E;
            border-radius: 10px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }

        @media(min-width: 1200px) {
            .min-h-430 {
                min-height: 430px;
            }
        }

        .service-support-box a {
            color: #000;
        }

        .divide {
            padding-top: 16px;
        }
        .header_bg {
            background: #007cea;
            padding-top: 8px;
            padding-bottom: 1px;
            color: #fff;
        }

        .product_radias {
            border-radius: 10px;
            background: #fff !important;
            
        }
        .product_radias:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.116);
            
        }
        .image_radias {
            border-radius: 10px 10px 0 0;
        }
        .home_product_shadwo{
            border-radius: 10px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }
        .title h3{
            font-size: 14px;
        }
        .see_more{
            margin-top: -7;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- header Start  -->
    @include('frontend.layouts.home_header')

        @yield('content')

    @include('frontend.layouts.footer')
    
    {{-- <script src="{{ asset('frontend') }}/assets/js/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend/assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/silck/slick.min.js') }}"></script>

    <script src="{{ asset('frontend') }}/assets/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('frontend/assets/js/fancybox.umd.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('footer_script')

</body>
</html>
