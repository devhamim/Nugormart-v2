@extends('frontend.layouts.app')
@section('content')
<div class="container-xl mt-5">
    <div class="row justify-content-between">
        <div class="col-lg-5 col-md-6 col-sm-6 col-12 m-auto d-flex" style="border: 1px solid #E5E7EB;">
            @if ($products->first()->inventorie_id != null)
                @php
                    $inventorie = $products->first()->rel_to_inventorie;
                @endphp
                <div class="row">
                    
                    <div class="col-lg-9 order-lg-2 pt-3 order-1 m-auto">
                        <div id="product" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @if ($products->first()->rel_to_inventorie)
                                    @foreach ($inventorie->rel_to_attribute->take(3) as $sl => $attribute)
                                        <div class="carousel-item {{ $sl == 0 ? 'active' : '' }} shadow-lg">
                                            <div class="easyzoom easyzoom--overlay w-100">
                                                <a href="{{ asset('uploads/product') }}/{{ $attribute->image }}"
                                                    target="_blank" data-fancybox="gallery" class="fancybox">
                                                    <img src="{{ asset('uploads/product') }}/{{ $attribute->image }}"
                                                        class="w-100" alt="First slide" />
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                
                            <button class="carousel-control-prev" type="button" data-bs-target="#product" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#product" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class=" order-2 pt-2 m-auto">
                        <div class="carousel-indicators nav_images position-relative text-end" id="nav_images">
                            @foreach ($inventorie->rel_to_attribute->take(3) as $sl => $attribute)
                                <img src="{{ asset('uploads/product') }}/{{ $attribute->image }}"
                                    alt="" width="100" data-bs-target="#product" data-bs-slide-to="{{ $sl }}" class="{{ $sl == 0 ? 'active' : '' }}"
                                    aria-current="true">
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <figure class="product-main-image">
                    <img id="product-zoom"
                        src="{{ asset('uploads/product') }}/{{ $products->first()->image }}"
                        data-zoom-image="{{ asset('uploads/product') }}/{{ $products->first()->image }}"
                        alt="product image">
                    <a href="" id="btn-product-gallery" class="btn-product-gallery">
                        <i class="icon-arrows"></i>
                    </a>
                </figure>
            @endif
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 product_details_h5" style="border: 1px solid #E5E7EB;">
            <div class="my-3">
                <h3 class="title" style="font-size: 22px; color: #000; font-weight: 600">{{ $products->first()->name }}</h3>

                @if ($products->first()->rel_to_inventorie)
                    @php
                        $inventorie = $products->first()->rel_to_inventorie
                    @endphp
                    
                    {{-- <div class="my-3">
                        Brand: {{ $products->first()->rel_to_inventorie->brand }}
                    </div> --}}
                    @foreach ($inventorie->rel_to_attribute->take(1) as $attribute)
                        @if ($attribute->sell_price != null)
                            <div class="pro_price d-flex">
                                <h2>{{ $attribute->sell_price }} Tk</h2> <del style="color: #A9ACAD"> <h4 style="margin-left: 5px; color: #A9ACAD">{{ $attribute->price }} Tk</h4></del>
                            </div>
                        @else
                            <h2>{{ $attribute->sell_price }} Tk</h2>
                        @endif
                    @endforeach
                @endif

                <div class="my-3">
                    SKU: <span>{{ $products->first()->rel_to_inventorie->sku }}</span>
                </div>
                <div class="size_chart mt-3 d-none">
                    <img src="{{ asset('frontend') }}/assets/image/size.png" alt="" class="img-fluid">
                </div>


                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" class="product_id" value="{{ $products->first()->id }}">

                    <div class="">
                        @if ($products->first()->rel_to_inventorie)
                            <input type="hidden" name="inventory_id" class="inventorie_id" value="{{ $products->first()->inventorie_id }}">
                            @php
                                $inventorie = $products->first()->rel_to_inventorie;
                            @endphp
                            @if ($inventorie->rel_to_attribute->where('weight', '!=', null)->isNotEmpty())
                            <div class="d-flex">
                                <h5 class="pop">Packag:</h5>
                                <div class="sizes d-flex flex-wrap align-items-centerx">
                                    @foreach ($inventorie->rel_to_attribute as $sl => $attribute)
                                        @if($attribute->weight)
                                            <div class="burmanRadio me-2">
                                            <input type="radio" class="burmanRadio__input size" id="size{{ $sl+1 }}" name="attribute_id" value="{{ $attribute->id }}" required>
                                            <label for="size{{ $sl+1 }}" class="burmanRadio__label"> {{ $attribute->weight }} </label>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if ($inventorie->rel_to_attribute->where('rel_to_color', '!=', null)->isNotEmpty())
                                @if ($available_colors->isNotEmpty())
                                <div class="">
                                    @php
                                        $color = null;
                                    @endphp
                                    <div class="d-flex">
                                        <h5 class="pop">color:</h5>
                                        <div class="sizes d-flex flex-wrap align-items-center">
                                            @foreach ($available_colors as $colorId => $colorAttributes)
                                                @php
                                                    $color = $colorAttributes->first()->rel_to_color;
                                                @endphp
                                                @if ($color)
                                                    <div class="burmanRadio me-2">
                                                        <input type="radio" class="burmanRadio__input color_id" id="size-{{ $colorId }}" 
                                                            name="color_id" value="{{ $color->id }}" required>
                                                        <label for="size-{{ $colorId }}" class="burmanRadio__label"> {{ $color->name }} </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @error('color_id')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="sizes d-flex flex-wrap align-items-center" id="size_id">

                                    </div>
                                    @error('attribute_id')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror

                                </div>
                                @endif
                            @endif
                            <div id="productDetails">
                                <!-- Display dynamic content here (image, price, quantity) -->
                            </div>
                        @endif
                    </div>

                    <div class="align-items-center flex-wrap mt-4 col-lg-12">

                        <div class="quantity_box">
                            <button type="button" class="minus btn">-</button>
                            <input type="text" class="quantity_value placeholder_black form-control" name="quantity"
                                value="1" min="1" max="12" required>
                            <button type="button" class="plus btn">+</button>
                        </div>
                        <div class="btn_submit " style="border-top: 2px solid #E5E7EB; padding-top: 10px; display: flex; width: 100%">
                            <button type="submit" class="mx-1 btn btn-secondary mt-lg-0 mt-3 text-cap product_details_card ord_btn" name="btn" value="1">
                                {{-- <img width="35" height="35" src="../../img.icons8.com/windows/40/shopping-cart.png" alt="shopping-cart" /> --}}
                                Add To Cart
                            </button>
                            <button type="submit" class="mx-1 btn btn-warning mt-lg-0 mt-3 text-cap product_details_buy add_to_cart" name="btn" value="2">
                                {{-- <img width="35" height="35" src="../../img.icons8.com/windows/40/add-shopping-cart.png" alt="add-shopping-cart" /> --}}
                                Order Now
                            </button>
                        </div>
                        <div class="call_now call-btn product_details_chat">
                            <a target="_blank" href="tel: {{$setting->first()->number_one}}"
                                class="btn btn-warning mt-lg-0 mt-3 semi text-cap col-lg-6 col-md-6 col-12 add_to_cart w-100"
                                style="background: #22C55E; color: #ffffff;border: none;"><i class="fas fa-phone"
                                    style="padding-right: 7px;"></i>{{$setting->first()->number_one}}</a>
                        </div>
                        <div class="call_now call-btn product_details_chat">
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=8801604702965&amp;text=Hello%20there,%20I%20found%20you%20on%20website!%20i%20would%20like%20to%20talk%20about%20your%20Premium Medjul Dates%20service."
                                class="btn btn-warning mt-lg-0 mt-3 semi text-cap col-lg-6 col-md-6 col-12 add_to_cart w-100"
                                style="background: #22C55E; color: #ffffff;border: none;"><i class="fas fa-phone"
                                    style="padding-right: 7px;"></i>WhatsApp</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="description_tab mt-4">
        <div class="container-xl">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs justify-content-start border-0 gap-3" id="product_des" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active border-0" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                        aria-selected="true">
                        Product Details
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link border-0" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">
                        Terms &amp; Condition
                    </button>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content my-5">
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! $products->first()->description !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="">
                                {!! $termscondition->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container-xl">
        <div class="rounded-2 style2 d-flex justify-content-center align-items-center">
            <div class="text-center">
                <div class="title"><h3>Related Products</h3></div>
            </div>
        </div>
        <div class=" bannerautoplay row mt-3">
            @foreach ($related_product->take(20) as $related)
                <div class="product mx-2 col-lg-3 product_radias home_product_shadwo">
                    <a href="{{route('product.details', $related->slug)}}">
                        <div class="image">
                            @if ($related->inventorie_id != null)
                                @if ($related->rel_to_inventorie)
                                    @php
                                        $inventorie = $related->rel_to_inventorie
                                    @endphp
                                    @foreach ($inventorie->rel_to_attribute->take(1) as $attribute)
                                        <img width="100%" src="{{asset('uploads/product')}}/{{ $attribute->image }}" alt="Product image" class="first">
                                        {{-- <img src="{{asset('uploads/product')}}/{{ $attribute->image }}" alt="Product image" class="second"> --}}
                                    @endforeach
                                @endif
                            @else
                                <img width="100%" src="{{asset('uploads/product')}}/{{$product->image}}" alt="Product image" class="first">
                                {{-- <img src="{{asset('uploads/product')}}/{{$product->image}}" alt="Product image" class="second"> --}}
                            @endif
                        </div>
                    </a>
                    <div class="content mx-3 py-3">
                        <a href="{{route('product.details', $related->slug)}}">
                            <div class="title">{{Str::limit($related->name, '25', '')}}</div>
                        </a>
                        <div class="price">
                            @if ($related->inventorie_id != null)
                                @if ($related->rel_to_inventorie)
                                    @php
                                        $inventorie = $related->rel_to_inventorie
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
                                @if ($related->sell_price != null)
                                    <span>{{$related->sell_price}} Tk</span>
                                    <del>{{$related->price}} Tk</del>
                                @else
                                    <span>{{$related->price}} Tk</span>
                                @endif
                            @endif
                        </div>

                        <div class="">
                            <a class="submit_button btn btn-successs d-block cart_button"
                                href="{{route('product.details', $related->slug)}}" style="width: 100%;font-size: 13px;">
                                <div class="cart_btn bangali bold text-white">Buy Now <i class="fa fa-cart-shopping cart_icon"></i></div>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <br><br>
</div>
@endsection


@section('footer_script')

<script>
    $('.color_id').click(function(){
        var color_id = $(this).val();
        var inventorie_id = '{{  $products->first()->inventorie_id }}';
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: 'POST',
            url: '/getsize',
            data: { 'color_id': color_id, 'inventorie_id': inventorie_id },
            success: function(data){
                console.log(data); 
                $('#size_id').html(data.html);  
            }
        });
    });
</script>

<script>
    $(document).on('click', '.size_id', function () {
        var attribute_id = $(this).val();
        var inventorie_id = '{{  $products->first()->inventorie_id }}';

        $.ajax({
            url: '{{ route("getProductDetails") }}',
            method: 'GET',
            data: { attribute_id: attribute_id, inventorie_id: inventorie_id},
            success: function(response) {
                updateProductDetails(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>

    <script>
        $('input[name="attribute_id"]').on('click', function() {
            var attribute_id = $(this).val();
            var inventorie_id = '{{  $products->first()->inventorie_id }}';
            $.ajax({
                url: '{{ route("getProductDetails") }}',
                method: 'GET',
                data: { attribute_id: attribute_id, inventorie_id: inventorie_id},
                success: function(response) {
                    updateProductDetails(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
                    // <p>Quantity: ${response.quantity}</p>
        function updateProductDetails(response) {
            $('.productDetailsImageemptey').empty();
            $('#productDetails').html(`
                <figure>
                    <del style="font-size:22px; font-weight:600; color:#9d9d9d; margin-right:10px">${response.price} Tk </del>
                    <span style="font-size:22px; font-weight:600; color:#000"> ${response.sell_price} Tk </span>
                    <input type="hidden" name="price" value="${response.sell_price}" >
                </figure>
            `);
            $('#productDetailsImage').html(`
                <img id="product-zoom" src="{{ asset('uploads/product') }}/${response.image}" data-zoom-image="{{ asset('uploads/product') }}/${response.image}" alt="product image">

                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                    <i class="icon-arrows"></i>
                </a>
            `);
        }
    </script>

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
@endsection