@extends('frontend.layouts.home_app')
@section('content')
<div class="main-wrapper">
    <div class="container-xl">
    <div class="row">
        <div class="col-lg-4 " style="width: 290px;"></div>
        <div class="col-lg-8 flex-grow-1 min-h-430">
            <div id="main_carousel" class="carousel slide ps-lg-2 pt-2 h-100" data-bs-ride="carousel">
                {{-- <ol class="carousel-indicators">
                    @foreach ($banners as $banner)
                        <li data-bs-target="#main_carousel" data-bs-slide-to="{{ $banner->id }}" class="active"
                        aria-current="true" aria-label="{{ $banner->image }}"></li>
                    @endforeach
                    
                </ol> --}}
                <div class="carousel-inner h-100" role="listbox">
                    @foreach ($banners as $banner)
                        <div class="carousel-item active h-100" data-bs-interval="2000">
                            <a href="{{ $banner->banner_link }}" target="_blank">
                                <img src="{{asset('uploads/banner')}}/{{ $banner->image }}" class="w-100 d-block h-100" alt="{{ $banner->image }}" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- <div class="container-xl">
        <div class="row">
            
            <div class="col-lg-12 flex-grow-1 min-h-430">
                <div class=" mt-3 productautoplay py-2">
                    @foreach ($banners as $sl=>$banner)
                        <div class="mx-2 product">
                            <div class="image">
                                <a href="{{ $banner->banner_link }}" target="_blank">
                                    <img style="border-radius: 10px" width="100%" src="{{asset('uploads/banner')}}/{{ $banner->image }}"  alt="{{ $banner->image }}" />
                                </a>
                            </div>
     
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}
    
    <div class="container-xl">
        
        <div class="category_products category_radias py-3 text-center">
            {{-- <div class=" rounded-2 style2 header_bg">
                <div class="left">
                    <div class="title"><h3>Shop By Category</h3></div>
                </div>
            </div> --}}
            <div class="rounded-2 style2 d-flex justify-content-between align-items-center header_bg">
                <div class="text-left">
                    <div class="title ms-3"><h3>Shop By Category</h3></div>
                </div>
                <div class="right pe-3 gap-2 see_more">
                    <a href="{{ route('shop') }}" class="text-white ">See All</a>
                </div>
            </div>
            <div class="mt-3 categoryautoplay home_product_shadwo py-3">
                @foreach ($categorys as $category)
                    <div class="mx-2">
                        <div class="home_product_shadwo py-2">
                            <a href="{{ route('category.show', $category->id) }}">
                                <img width="95%" src="{{asset('uploads/category')}}/{{ $category->image }}" alt="image" class="">
                            </a>
                            <div class="mt-2">
                                <a href="{{ route('category.show', $category->id) }}">
                                    <div class="title">{{Str::limit($category->name, '25', '')}}</div>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>

        {{-- New Customer Review --}}
        <div class="category_products py-4 text-center">
            {{-- <div class=" rounded-2 style2 header_bg">
                <div class="left">
                    <div class="title"><h3>Customer Review</h3></div>
                </div>
            </div> --}}
            <div class="rounded-2 style2 d-flex justify-content-between align-items-center header_bg">
                <div class="text-left">
                    <div class="title ms-3"><h3>Customer Review</h3></div>
                </div>
                {{-- <div class="rightpe-3 gap-2 see_more">
                    <a href="{{ route('shop') }}" class="text-white ">See All</a>
                </div> --}}
            </div>

            <div class=" mt-3 bannerautoplay home_product_shadwo py-3">
                @foreach ($reviews as $review)
                    <div class="mx-2 product">
                        <div class="image home_product_shadwo py-2">
                            <a>
                                <img width="95%" src="{{asset('uploads/review')}}/{{$review->image}}" alt="Product image" class="">
                            </a>
                        </div>
 
                    </div>
                @endforeach
            </div>
        </div>
        {{-- New Arrival Products --}}
        <div class="category_products py-4 text-center">
            {{-- <div class=" rounded-2 style2 header_bg">
                <div class="left">
                    <div class="title"><h3>New Arrival Products</h3></div>
                </div>
            </div> --}}
            <div class="rounded-2 style2 d-flex justify-content-between align-items-center header_bg">
                <div class="text-left">
                    <div class="title ms-3"><h3>New Arrival Products</h3></div>
                </div>
                <div class="right pe-3 gap-2 see_more">
                    <a href="{{ route('shop') }}" class="text-white ">See All</a>
                </div>
            </div>

            <div class=" mt-3 bannerautoplay home_product_shadwo py-3">
                @foreach ($products->take(20) as $product)
                    <div class="mx-2 pb-3 product product_radias home_product_shadwo py-2">
                        <div class="image ">
                            <a href="{{route('product.details', $product->slug)}}">
                                @if ($product->inventorie_id != null)
                                    @if ($product->rel_to_inventorie)
                                        @php
                                            $inventorie = $product->rel_to_inventorie
                                        @endphp
                                        @foreach ($inventorie->rel_to_attribute->take(1) as $attribute)
                                            <img width="95%" src="{{asset('uploads/product')}}/{{ $attribute->image }}" alt="Product image" class="image_radias">
                                            {{-- <img src="{{asset('uploads/product')}}/{{ $attribute->image }}" alt="Product image" class="second"> --}}
                                        @endforeach
                                    @endif
                                @else
                                    <img width="95%" src="{{asset('uploads/product')}}/{{$product->image}}" alt="Product image" class="">
                                    {{-- <img src="{{asset('uploads/product')}}/{{$product->image}}" alt="Product image" class="second"> --}}
                                @endif
                            </a>
                            <div class="mt-3">
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
                                                    <del class="text-danger">{{$attribute->price}} Tk</del>
                                                @else
                                                    <span >{{$attribute->price}} Tk</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        @if ($product->sell_price != null)
                                            <span>{{$product->sell_price}} Tk</span>
                                            <del class="text-danger">{{$product->price}} Tk</del>
                                        @else
                                            <span>{{$product->price}} Tk</span>
                                        @endif
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="">
                            <a class="submit_button btn btn-successs d-block cart_button"
                                href="{{route('product.details', $product->slug)}}" style="width: 100%;font-size: 13px;">
                                <div class="cart_btn bangali bold text-white">Buy Now <i class="fa fa-cart-shopping cart_icon"></i></div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Top Selling Products --}}
        @if ($topSellingProducts)
            <div class="category_products py-4 text-center">
                {{-- <div class=" rounded-2 style2 header_bg">
                    <div class="left">
                        <div class="title"><h3>Top Selling Products</h3></div>
                    </div>
                </div> --}}
                <div class="rounded-2 style2 d-flex justify-content-between align-items-center header_bg">
                    <div class="text-left">
                        <div class="title ms-3"><h3>Top Selling Products</h3></div>
                    </div>
                    <div class="right pe-3 gap-2 see_more">
                        <a href="{{ route('shop') }}" class="text-white ">See All</a>
                    </div>
                </div>

                <div class=" mt-3 bannerautoplay home_product_shadwo py-3">
                    @php
                        $topSelling = $topSellingProducts->unique('product_id');
                    @endphp
                    @foreach ($topSelling as $product)
                        <div class="mx-2 pb-3 product product_radias home_product_shadwo py-2">
                            <div class="image">
                                <a href="{{route('product.details', $product->slug)}}">
                                    @if ($product->inventorie_id != null)
                                        @if ($product->rel_to_inventorie)
                                            @php
                                                $inventorie = $product->rel_to_inventorie
                                            @endphp
                                            @foreach ($inventorie->rel_to_attribute->take(1) as $attribute)
                                                <img width="95%" src="{{asset('uploads/product')}}/{{ $attribute->image }}" alt="Product image" class="image_radias">
                                                {{-- <img src="{{asset('uploads/product')}}/{{ $attribute->image }}" alt="Product image" class="second"> --}}
                                            @endforeach
                                        @endif
                                    @else
                                        <img width="95%" src="{{asset('uploads/product')}}/{{$product->image}}" alt="Product image" class="">
                                        {{-- <img src="{{asset('uploads/product')}}/{{$product->image}}" alt="Product image" class="second"> --}}
                                    @endif
                                </a>
                            </div>
                            <div class="mt-3">
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
                                                    <del class="text-danger">{{$attribute->price}} Tk</del>
                                                @else
                                                    <span >{{$attribute->price}} Tk</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        @if ($product->sell_price != null)
                                            <span>{{$product->sell_price}} Tk</span>
                                            <del class="text-danger">{{$product->price}} Tk</del>
                                        @else
                                            <span>{{$product->price}} Tk</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="">
                                <a class="submit_button btn btn-successs d-block cart_button"
                                    href="{{route('product.details', $product->slug)}}" style="width: 100%;font-size: 13px;">
                                    <div class="cart_btn bangali bold text-white">Buy Now <i class="fa fa-cart-shopping cart_icon"></i></div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @foreach ($categorys as $category)
            @php
                $categoryProducts = $products->where('category_id', $category->id);
            @endphp
            @if ($categoryProducts->isNotEmpty())
                <div class="category_products py-3">
                    <div class="rounded-2 style2 d-flex justify-content-between align-items-center header_bg">
                        <div class="text-left">
                            <div class="title ms-3"><h3>{{ $category->name }}</h3></div>
                        </div>
                        <div class="right pe-3 gap-2 see_more">
                            <a href="{{ route('category.show', $category->id) }}" class="text-white ">See All</a>
                        </div>
                    </div>

                    <div class=" mt-3 bannerautoplay row home_product_shadwo py-3">
                        @foreach ($categoryProducts as $product)
                            <div class="mx-2 pb-3 product col-lg-3 col-6 product_radias text-center home_product_shadwo py-2">
                                <div class="image">
                                    <a href="{{ route('product.details', $product->slug) }}">
                                        @if ($product->inventorie_id != null && $product->rel_to_inventorie)
                                            @foreach ($product->rel_to_inventorie->rel_to_attribute->take(1) as $attribute)
                                                <img width="95%" src="{{ asset('uploads/product') }}/{{ $attribute->image }}" alt="Product image" class="img-fluid image_radias">
                                            @endforeach
                                        @else
                                            <img width="95%" src="{{ asset('uploads/product') }}/{{ $product->image }}" alt="Product image" class="img-fluid">
                                        @endif
                                    </a>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('product.details', $product->slug) }}">
                                        <div class="title">{{ Str::limit($product->name, 25 , '') }}</div>
                                    </a>
                                    <div class="price">
                                        @if ($product->inventorie_id != null && $product->rel_to_inventorie)
                                            @foreach ($product->rel_to_inventorie->rel_to_attribute->take(1) as $attribute)
                                                @if ($attribute->sell_price != null)
                                                    <span>{{ $attribute->sell_price }} Tk</span>
                                                    <del class="text-danger">{{ $attribute->price }} Tk</del>
                                                @else
                                                    <span>{{ $attribute->price }} Tk</span>
                                                @endif
                                            @endforeach
                                        @else
                                            @if ($product->sell_price != null)
                                                <span>{{ $product->sell_price }} Tk</span>
                                                <del class="text-danger">{{ $product->price }} Tk</del>
                                            @else
                                                <span>{{ $product->price }} Tk</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="">
                                    <a class="submit_button btn btn-successs d-block cart_button"
                                        href="{{route('product.details', $product->slug)}}" style="width: 100%;font-size: 13px;">
                                        <div class="cart_btn bangali bold text-white">Buy Now <i class="fa fa-cart-shopping cart_icon"></i></div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

    

    </div>

@endsection

@section('footer_script')
<script>
    $('.bannerautoplay').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ]
        });
</script>
<script>
    $('.productautoplay').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
        });
</script>


    <script>
        $(document).ready(function(){
            $('.categoryautoplay').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
@endsection

