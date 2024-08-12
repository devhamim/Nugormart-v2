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
            border-radius: 10px 0 0 10px;
        }
        div.quantity_box button[type="button"].plus {
            border-radius: 0 10px 10px 0;
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
            left: -30px;
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
            box-shadow: 0px 0px 7px 0px gray;
            border-radius: 10px;
        }     
        .nav_images{
            margin-top: 10px;
            display: block;
        }
        .nav_images [data-bs-target] {
            height: 70px;
            width: 70px;
            box-shadow: 0px 0px 3px 0px gray;
            padding: 5px;
        }
        
        .nav_images img {
            margin-bottom: 5px;
        }
        
        .nav_images .active {
            height: 70px;
            width: 70px;
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
            font-size: 21px;
        }
        
        .add_to_cart {
            font-size: 19px;
        }
        .nav-tabs{
            border: 1px solid #000 !important;
            padding: 0px;
            border-radius: 5px; 
        }
        
        .nav-tabs .nav-link.active {
            background: #000;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <!-- header Start  -->
    @include('frontend.layouts.home_header')

        @yield('homecontent')

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
