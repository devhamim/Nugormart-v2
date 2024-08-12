
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Fashion Gallery</title>
    <!-- <meta name="robots" content="noindex, follow" /> -->
    <meta name="AdsBot-Google" content="noindex follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landingpage') }}/images/favicon.png" />

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

    <link rel="stylesheet" href="{{ asset('landingpage') }}/css/vendor/icofont.min.css" />
    <link rel="stylesheet" href="{{ asset('landingpage') }}/css/vendor/line-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('landingpage') }}/css/vendor/simple-line-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vendor CSS (Bootstrap & Icon Font) -->

    <!-- Plugins CSS (All Plugins Files) -->
    <link rel="stylesheet" href="{{ asset('landingpage/css/plugins/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/css/plugins/slick.css') }}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('landingpage') }}/css/style.css" />

    <style>
        body{
            overflow-x: hidden;
        }
        .head-color{
            /* background: rgb(254,78,0);
            background: linear-gradient(90deg, rgba(254,78,0,1) 0%, rgba(0,124,234,1) 100%); */
            background: #000;
            color: #fff;
        }

        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

    </style>

    <!-- Meta Pixel Code -->
    @if($setting->first()->fbpixel != null)
    {!! $setting->first()->fbpixel !!}
@endif
{{-- <!-- End Meta Pixel Code --> --}}

<!-- googletag Code -->
@if($setting->first()->googletag != null)
    {!! $setting->first()->googletag !!}
@endif
<!-- End googletag Code -->

</head>


<body class="font-poppins text-dark text-sm leading-loose">
    <!-- Header start -->

    <header id="sticky-header" class="head-color">
        <div class="px-4 md:px-10 2xl:px-24 py-5">
            <div class="flex flex-wrap items-center justify-between">
                <div class="hidden lg:block">

                </div>
                <div>
                    <div class="text-center">
                        <h1>ফোম ছাড়া ফ্রন্ট বাটন ব্রা</h1>
                        <h3>১ পিস ৪৮০/- টাকা, ২ পিস ৮০০/- টাকা, ৩ পিস অফার মূল্য মাত্র ১১৮০/- টাকা</h3>
                        <h3 style="padding-bottom: 20px"><a href="tel:01780692446">বিশেষ প্রয়োজনেঃ 01780-692-446</a></h3>
                        <a href="#order" class="btn btn-seccess text-dark" style="font-size: 24px; padding: 10px 30px; border-radius : 101px 101px 101px 101px; background: rgb(178,124,50); background: linear-gradient(103deg, rgba(178,124,50,1) 0%, rgba(252,239,135,1) 50%, rgba(178,124,50,1) 100%); font-weight: 800">অর্ডার করতে বাটনে ক্লিক করুন</a>
                    </div>
                </div>
                <div>

                </div>
            </div>
        </div>
    </header>
    <!-- Header end -->

    <!-- Hero section start -->
    <section class="hero-section relative" style="background: #000">
        <div class="hero-slider overflow-hidden">
            <div class="swiper-container">
                <div class="">
                    <!-- swiper-slide start -->
                    <div class="responsive-iframe-container text-center">
                        <video width="50%" height="100vh" controls>
                            <source src="{{ asset('landingpage/video.mp4') }}" type="video/mp4">
                          </video>
                    </div>
                    <!-- swiper-slide end-->
                </div>
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination mb-5 md:mb-0"></div>
            <!-- swiper navigation -->
        </div>
    </section>
    <!-- Hero section end -->

    <!-- Service section Start -->
    <div class="py-24" style="background: #000; color: #fff; font-weight: 700; font-size:  18px">
        <div class="container">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <section class="relative">
                        <div class="row mb-4">
                            <div class="col-lg-6 m-auto">
                                <h2 class="text-center">ফ্রন্ট বাটন ব্রা কেন কিনবেন?</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="service_left">
                                    <ul>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt="">ফোম ছাড়া, ফ্রন্ট ওপেন বাটন ব্রা।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt="">ব্রেস্ট ফিডিং ব্রা হিসেবে ব্যবহার করা যাবে।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt="">অনেক নরম ও আরামদায়ক।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt="">উন্নত মানের কটন কাপড় দিয়ে তৈরি।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt="">বডি শেপ সুন্দর দেখাতে সাহায্য করবে।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt=""> প্রেগনেন্ট আপুরাও খুব স্বাচ্চন্দে ব্যবহার করতে পারবে
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="service_left">
                                    <ul>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt=""> প্রতিদিন ব্যবহারের জন্য খুবই আরামদায়ক।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt=""> গরমে শরীরের ঘাম ও তাপমাত্রা নিয়ন্ত্রণ করে।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt=""> ফুল কটন কাপড় হওয়ায় ঘামানোর সম্ভাবনা নেই।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt="">স্কিন, পিংক ও কফি এই ৩টি কালারে পাওয়া যাচ্ছে।
                                        </li>
                                        <li>
                                            <img style="width: 15px" src="https://s.w.org/images/core/emoji/14.0.0/svg/1f530.svg" alt="">আপনারা যারা এই গরমে আপনার শরীর বা ব্রেস্টকে একটু কমফোর্ট বা স্বস্তি দিতে চাচ্ছেন তারা আমাদের ফোম ছাড়া ফ্রন্ট বাটন ব্রাগুলো ইউজ করতে পারেন।
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- Service section End -->

    <!-- Product section start -->
    <section class="product-section pt-24 pb-24">
        <div class="">

            <div class="grid grid-rows-1 grid-flow-col gap-4">
                <div class="text-center mb-14 text-white">
                    <a href="#order" class="btn btn-seccess text-dark" style="font-size: 24px; margin-top: 30px; padding: 10px 30px; border-radius : 101px 101px 101px 101px; background: rgb(178,124,50); background: linear-gradient(103deg, rgba(178,124,50,1) 0%, rgba(252,239,135,1) 50%, rgba(178,124,50,1) 100%); font-weight: 800">অর্ডার করতে বাটনে ক্লিক করুন</a>
                </div>
            </div>
            <div class="row">
                <div class="col-ls-12">
                    <div class="autoplay">
                        <div>
                            <img src="{{ asset('landingpage/images/product/1.webp') }}" alt="">
                        </div>
                        <div>
                            <img src="{{ asset('landingpage/images/product/2.webp') }}" alt="">
                        </div>
                        <div>
                            <img src="{{ asset('landingpage/images/product/3.webp') }}" alt="">
                        </div>
                        <div>
                            <img src="{{ asset('landingpage/images/product/4.webp') }}" alt="">
                        </div>
                        <div>
                            <img src="{{ asset('landingpage/images/product/5.webp') }}" alt="">
                        </div>
                        <div>
                            <img src="{{ asset('landingpage/images/product/6.webp') }}" alt="">
                        </div>
                        <div>
                            <img src="{{ asset('landingpage/images/product/7.jpg') }}" alt="">
                        </div>
                        <div>
                            <img src="{{ asset('landingpage/images/product/8.webp') }}" alt="">
                        </div>
                      </div>

                </div>
            </div>

        </div>
    </section>
    <!-- Product section end -->


    <!-- Service section Start -->
    <div class="py-24 subject-color" style="background: #000; color: #fff; font-weight: 700; font-size:  18px">
        <div class="container">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <section class="relative">
                        <div class="row mb-4">
                            <div class="col-lg-6 m-auto">
                                <h2 class="text-center">২ টি গুরুত্বপূর্ন বিষয়</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 m-auto">
                                <div class="service_left">
                                    <ul class="text-center">
                                        <li>
                                            <i aria-hidden="true" class="fas fa-check"></i>
                                            আমরা কোনো অগ্রিম টাকা নেই না। ইনশাল্লাহ সবাই ক্যাশ অন ডেলিভারিতে পন্য রিসিভ করবেন।
                                        </li>
                                        <li>
                                            <i aria-hidden="true" class="fas fa-check"></i>
                                            অর্ডার করার পরে আমাদের কল সেন্টার থেকে ফোন করে পন্যের কালার ও সাইজ কনফার্ম করা হবে।
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- Service section End -->



    <!-- Footer section start -->
    <footer>

        <!-- News Letter section start -->
        <section class="news-letter-section bg-white py-24">
            <div class="container">
                <div class="grid gap-4">
                    <div class="col-span-12">
                        <div class="section-title text-center pb-14">
                            <a href="#order" class="btn btn-success main-btn text-dark" style="font-size: 24px; margin-top: 30px; border-radius : 101px 101px 101px 101px; background: rgb(178,124,50); background: linear-gradient(103deg, rgba(178,124,50,1) 0%, rgba(252,239,135,1) 50%, rgba(178,124,50,1) 100%); font-weight: 800; padding: 10px 30px; border: 0">সঠিক তথ্য দিয়ে নিচের ফর্মটি পূরণ করেন।</a>
                            <h5 class="mt-5">অর্ডার করতে মেসেজ করুন অথবা কল করুন
                                <h3 style="padding-bottom: 20px"><a href="tel:01780692446">বিশেষ প্রয়োজনেঃ 01780-692-446</a></h3>
                            </h5>
                        </div>
                    </div>
                    <div id="order" class="col-span-12">
                        <form action="{{route('landing.order.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5>Billing details</h5>
                                        <div class="row">
                                            <div class="col-lg-12 my-3">
                                                <label class="form-label" for="">আপনার নাম <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" placeholder="আপনার নাম" required>
                                                @error('name')
                                                    <strong class="text-danger">{{$message}}</strong>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12 my-3">
                                                <label class="form-label" for="">আপনার ঠিকানা লিখুন : <span class="text-danger">*</span></label>
                                                <input type="text" name="address" class="form-control" placeholder="গ্রাম/মহল্লা, থানা, জেলা" required>
                                                @error('address')
                                                    <strong class="text-danger">{{$message}}</strong>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12 my-3">
                                                <label class="form-label" for="">মোবাইল নাম্বার : <span class="text-danger">*</span></label>
                                                <input type="tel" name="mobile" class="form-control" placeholder="১১ ডিজিটের মোবাইল নাম্বার দিন" required>
                                                @error('mobile')
                                                    <strong class="text-danger">{{$message}}</strong>
                                                @enderror
                                                @error('mobile')
                                                    <script>
                                                        Swal.fire({
                                                        icon: "error",
                                                        title: "Oops...",
                                                        text: "Something went wrong!",
                                                        });
                                                    </script>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 my-3">
                                                <label class="form-label" for="">সাইজ : <span class="text-danger">*</span></label>
                                                <input type="text" name="size" class="form-control" placeholder="সাইজ লিখুন ( যেমন ৩২,৩৪ ইত্যাদি) *" required>
                                                @error('size')
                                                    <strong class="text-danger">{{$message}}</strong>
                                                @enderror
                                                <!--<label class="form-label" for="">সাইজ : <span class="text-danger">*</span></label>-->
                                                <!--<select class="form-select" name="size" id="">-->
                                                <!--    <option value="৩৪">৩৪</option>-->
                                                <!--    <option value="৩৬">৩৬</option>-->
                                                <!--    <option value="৩৮">৩৮</option>-->
                                                <!--    <option value="৪০">৪০</option>-->
                                                <!--    <option value="৪২">৪২</option>-->
                                                <!--    <option value="৪৪">৪৪</option>-->
                                                <!--    <option value="৪৬">৪৬</option>-->
                                                <!--</select>-->
                                            </div>
                                            <div class="col-lg-6 my-3">
                                                <label class="form-label" for="">কালার : <span class="text-danger">*</span></label>
                                                <input type="text" name="color" class="form-control" placeholder="কালার লিখুন( কফি,পিংক,স্কিন) *" required>
                                                @error('color')
                                                    <strong class="text-danger">{{$message}}</strong>
                                                @enderror
                                                <!--<label class="form-label" for="">কালার : <span class="text-danger">*</span></label>-->
                                                <!--<select class="form-select" name="color" id="">-->
                                                <!--    <option value="স্কিন">স্কিন</option>-->
                                                <!--    <option value="মিস্টি">মিস্টি</option>-->
                                                <!--    <option value="কফি">কফি</option>-->
                                                <!--</select>-->
                                            </div>
                                            <div class="col-lg-12 my-3">
                                                <label class="form-label" for="">Order notes (optional)</label>
                                                <textarea name="note" class="form-control" placeholder="এখানে লিখুন..." id="" cols="30" rows="2"></textarea>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="container">
                                        <!-- Product Options -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>কত পিস নিবেন?</h3>
                                                <!-- Product Options Table -->
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Product Row 1 -->
                                                            <tr>
                                                                <td>

                                                                    <input type="radio" name="radio_btn" value="1" checked="checked">
                                                                    <img src="{{ asset('landingpage/images/product/00.webp') }}" alt="" width="50" height="50">
                                                                    <label for="product_1">ফোম ছাড়া ফ্রন্ট বাটন ব্রা ১ পিস</label>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="product_name" value="ফোম ছাড়া ফ্রন্ট বাটন ব্রা ১ পিস" class="form-control">
                                                                    <input type="hidden" name="quantity" value="1" min="1" class="form-control">
                                                                    <input type="hidden" name="price" value="480" min="1" class="form-control">
                                                                </td>
                                                                <td>৳480.00</td>
                                                            </tr>
                                                            <!-- Product Row 2 -->
                                                            <tr>
                                                                <td>

                                                                    <input type="radio" name="radio_btn"  value="2">
                                                                    <img src="{{ asset('landingpage/images/product/00.webp') }}" alt="" width="50" height="50">
                                                                    <label for="product_2">ফোম ছাড়া ফ্রন্ট বাটন ব্রা ২ পিস</label>

                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="product_name" value="ফোম ছাড়া ফ্রন্ট বাটন ব্রা ২ পিস" class="form-control">
                                                                    <input type="hidden" name="quantity" value="2" min="1" class="form-control">
                                                                    <input type="hidden" name="price" value="800" min="1" class="form-control">
                                                                </td>
                                                                <td>৳800.00</td>
                                                            </tr>
                                                            <!-- Product Row 3 -->
                                                            <tr>
                                                                <td>

                                                                    <input type="radio" name="radio_btn" value="3">
                                                                    <img src="{{ asset('landingpage/images/product/00.webp') }}" alt="" width="50" height="50">
                                                                    <label for="product_3">ফোম ছাড়া ফ্রন্ট বাটন ব্রা ৩ পিস</label>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" name="product_name" value="ফোম ছাড়া ফ্রন্ট বাটন ব্রা ৩ পিস" class="form-control">
                                                                    <input type="hidden" name="quantity" value="3" min="1" class="form-control">
                                                                    <input type="hidden" name="price" value="1180" min="1" class="form-control">
                                                                </td>
                                                                <td>৳1,180.00</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Your order -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Your order</h3>
                                                    <!-- Order Review Table -->
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered woocommerce-checkout-review-order-table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="product-name">Product</th>
                                                                    <th class="product-total">Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Sample Product Row -->
                                                                <tr class="cart_item">
                                                                    <td class="product-name">
                                                                        <div class="wcf-product-image">
                                                                            <div class="wcf-product-thumbnail">
                                                                                <img width="50" height="50" src="{{ asset('landingpage/images/product/00.webp') }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="">
                                                                                <a href="#" rel="nofollow" class="wcf-remove-product cartflows-icon cartflows-circle-cross" data-id="138" data-item-key="013d407166ec4fa56eb1e1f8cbe183b9"></a>
                                                                            </div>
                                                                            <div class="wcf-product-name">ফোম ছাড়া ফ্রন্ট বাটন ব্রা ১ পিস</div>
                                                                        </div>
                                                                        <strong class="product-quantity"></strong>
                                                                    </td>
                                                                    <td class="product-total">
                                                                        <span class="woocommerce-Price-amount amount"><bdi>480.00<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi></span>
                                                                    </td>
                                                                </tr>
                                                                <!-- Add more product rows as needed -->
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="cart-subtotal">
                                                                    <th>Subtotal</th>
                                                                    <td>
                                                                        <input type="hidden" name="sub_total" value="480" id="">
                                                                        <span class="woocommerce-Price-amount amount"><bdi>480.00<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi></span>
                                                                    </td>
                                                                </tr>

                                                                <!-- Shipping Options -->
                                                                <tr class="woocommerce-shipping-totals shipping">
                                                                    <th>Shipping</th>
                                                                    <td data-title="Shipping">
                                                                        <!-- Shipping Methods -->
                                                                        <ul id="shipping_method" class="woocommerce-shipping-methods">
                                                                            <!-- Sample Shipping Method 1 -->
                                                                            <li>
                                                                                <input type="radio" name="shipping_cost" data-index="0" id="shipping_method_0_flat_rate2" value="70" class="shipping_method" checked="checked">
                                                                                <label for="shipping_method_0_flat_rate2">ঢাকার ভিতরে: <span class="woocommerce-Price-amount amount"><bdi>70.00<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi></span></label>
                                                                            </li>
                                                                            <!-- Sample Shipping Method 2 -->
                                                                            <li>
                                                                                <input type="radio" name="shipping_cost" data-index="0" id="shipping_method_0_local_pickup3" value="120" class="shipping_method">
                                                                                <label for="shipping_method_0_local_pickup3">ঢাকার বাহিরে: <span class="woocommerce-Price-amount amount"><bdi>120.00<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi></span></label>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                <!-- End Shipping Options -->

                                                                <!-- Order Total -->
                                                                <tr class="order-total">
                                                                    <th>Total</th>
                                                                    <td>
                                                                        <input type="hidden" name="total" value="550">
                                                                        <strong><span class="woocommerce-Price-amount amount"><bdi>550.00<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi></span></strong>
                                                                    </td>
                                                                </tr>
                                                                <!-- End Order Total -->
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        <!-- Payment Section -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="payment" class="woocommerce-checkout-payment">
                                                        <!-- Payment Methods -->
                                                        <ul class="wc_payment_methods payment_methods methods">
                                                            <!-- Cash on Delivery (COD) Method -->
                                                            <li class="wc_payment_method payment_method_cod">
                                                                <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" checked="checked" data-order_button_text="" style="display: none;">
                                                                <label for="payment_method_cod">আগে কোন টাকা দিতে হবেনা</label>
                                                                <div class="payment_box payment_method_cod">
                                                                    <p>পন্য হাতে পেয়ে মূল্য পরিশোধ করুন</p>
                                                                </div>
                                                            </li>
                                                            <!-- Add more payment methods as needed -->
                                                        </ul>

                                                        <!-- Terms and Conditions -->
                                                        <div class="form-row place-order">
                                                            <noscript>
                                                                <p>Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.</p>
                                                                <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
                                                            </noscript>

                                                            <!-- Privacy Policy -->
                                                            <div class="woocommerce-terms-and-conditions-wrapper">
                                                                <div class="woocommerce-privacy-policy-text">
                                                                    <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="https://shaharafashion.com/?page_id=3" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>.</p>
                                                                </div>
                                                            </div>

                                                            <!-- Bump Order Section -->
                                                            <div class="wcf-bump-order-grid-wrap wcf-all-bump-order-wrap wcf-after-payment" data-update-time="1707126370"></div>

                                                            <!-- Place Order Button -->
                                                            <button type="submit" class="btn btn-warning w-100 mt-3 text-dark" style="background: rgb(178,124,50); background: linear-gradient(103deg, rgba(178,124,50,1) 0%, rgba(252,239,135,1) 50%, rgba(178,124,50,1) 100%);" value="অর্ডার করুন">অর্ডার করুন</button>
                                                        </div>
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
        </section>
        <!-- News Letter section end -->


        <section>
            <div class="">
                <div class="gallery-container d-flex">
                    <div class="gallery-item">
                        <a href="{{ asset('landingpage/images/ss/1.jpg') }}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{ asset('landingpage/images/ss/1.jpg') }}" alt="">
                        </a>
                    </div>
                    <!-- Repeat the above structure for each gallery item -->
                    <!-- Example -->
                    <div class="gallery-item">
                        <a href="{{ asset('landingpage/images/ss/2.jpg') }}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{ asset('landingpage/images/ss/2.jpg') }}" alt="">
                        </a>
                    </div>
                    <!-- Example -->
                    <div class="gallery-item">
                        <a href="{{ asset('landingpage/images/ss/3.jpg') }}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{ asset('landingpage/images/ss/3.jpg') }}" alt="">
                        </a>
                    </div>
                    <!-- Add more items as needed -->
                </div>
                <div class="gallery-container d-flex">
                    <!-- Example -->
                    <div class="gallery-item">
                        <a href="{{ asset('landingpage/images/ss/4.jpg') }}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{ asset('landingpage/images/ss/4.jpg') }}" alt="">
                        </a>
                    </div>
                    <!-- Example -->
                    <div class="gallery-item">
                        <a href="{{ asset('landingpage/images/ss/5.jpg') }}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{ asset('landingpage/images/ss/5.jpg') }}" alt="">
                        </a>
                    </div>
                    <!-- Example -->
                    <div class="gallery-item">
                        <a href="{{ asset('landingpage/images/ss/6.jpg') }}" data-toggle="lightbox" data-gallery="gallery">
                            <img src="{{ asset('landingpage/images/ss/6.jpg') }}" alt="">
                        </a>
                    </div>
                    <!-- Add more items as needed -->
                </div>
            </div>
        </section>

    <!-- Vendors JS -->

    {{-- <script src="{{ asset('landingpage') }}/js/vendor/jquery-3.6.0.min.js"></script> --}}
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Plugins JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('landingpage/js/plugins/slick.min.js') }}"></script>

<!-- Your existing HTML code -->

<script>
    $(document).ready(function () {
        // Attach click event to radio buttons
        $('input[name="radio_btn"]').on('change', function () {
            // Get the selected product details
            var productName = $(this).closest('tr').find('input[name="product_name"]').val();
            var quantity = $(this).closest('tr').find('input[name="quantity"]').val();
            var price = $(this).closest('tr').find('input[name="price"]').val();

            // Update the order section
            updateOrderSection(productName, quantity, price);
        });

        // Function to update the order section
        function updateOrderSection(productName, quantity, price) {
            // Update product details in the order summary
            $('.woocommerce-checkout-review-order-table tbody').html(`
                <tr class="cart_item">
                    <td class="product-name">
                        <div class="wcf-product-image">
                            <div class="wcf-product-thumbnail">
                                <img width="50" height="50" src="{{ asset('landingpage/images/product/00.webp') }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="">
                            </div>
                            <div class="wcf-product-name">${productName} x <strong class="product-quantity">${quantity}</strong></div>

                        </div>
                    </td>
                    <td class="product-total">
                        <span class="woocommerce-Price-amount amount"><bdi>${price}<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi></span>
                    </td>
                </tr>
            `);

            // Update subtotal and total
            $('input[name="sub_total"]').val(price);
            updateTotal();
        }

        // Attach click event to shipping cost radio buttons
        $('input[name="shipping_cost"]').on('change', function () {
            updateTotal();
        });

        // Function to update the total
        function updateTotal() {
            var subTotal = parseInt($('input[name="sub_total"]').val());
            var shippingCost = parseInt($('input[name="shipping_cost"]:checked').val());
            var total = subTotal + shippingCost;

            $('input[name="total"]').val(total);

            // You can update the displayed total on the page if needed
            $('.cart-subtotal .woocommerce-Price-amount').html(`<bdi>${subTotal}<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi>`);
            $('.order-total .woocommerce-Price-amount').html(`<bdi>${total}<span class="woocommerce-Price-currencySymbol">৳&nbsp;</span></bdi>`);
        }
    });
</script>

<script type="text/javascript">
    $('.autoplay').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
  </script>

@if(session('success')) {
    <script>
        Swal.fire({
        icon: "success",
        title: "Success...",
        text: "Your order have been success",
        });
    </script>
    }
    @endif
    @if(session('error')) {
    <script>
        Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
        footer: '<a href="#">Why do I have this issue?</a>'
        });

        </script>
    }
    @endif

</body>
</html>
