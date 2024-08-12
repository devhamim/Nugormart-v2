<div class="container-fluid divide">
    <hr />
</div>
{{-- <div class="container-xl">


    <div class="row service-support-box" style="margin-left:3%; margin-right:3%;padding-top:23px;">

        <div class="col-lg-3 col-md-6 col-12 border-end mb-3">
            <div class="support service-support-single d-flex align-items-center ps-4">
                <img width="40" height="40" src="https://img.icons8.com/ios/40/marker--v1.png" alt="marker--v1"/>
                <div class="" style="margin: 5px;padding: 0px;">
                    <h6 style="margin:0px"><strong>Free Delivery</strong></h6>
                    <p class="font-13 m-0">
                        On all order above BDT 5000
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 border-end mb-3">
            <div class="support service-support-single d-flex align-items-center ps-4">
                <img width="30" height="30" src="https://img.icons8.com/ios/30/return.png" alt="return"/>
                <div class="" style="margin: 5px;padding: 0px;">
                    <h6 style="margin:0px"><strong>Easy 7 days return</strong></h6>
                    <p class="font-13 m-0">
                        7 days Easy return Guaranty
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 border-end mb-3">
            <div class="support service-support-single d-flex align-items-center ps-4">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/geography--v1.png" alt="geography--v1"/>
                <div class="" style="margin: 5px;padding: 0px;">
                    <h6 style="margin:0px"><strong>International Warranty</strong></h6>
                    <p class="font-13 m-0">
                        1 year official warranty
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="support service-support-single d-flex align-items-center ps-4">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/private2.png" alt="private2"/>
                <div class="" style="margin: 5px;padding: 0px;">
                    <h6 style="margin:0px"><strong>private2 100% secure checkout</strong></h6>
                    <p class="font-13 m-0">
                        COD/Mobile banking/visa
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="row service-support-box" style="margin-left:3%; margin-right:3%;padding:33px 0px;">
        <div class="col-lg-3 col-md-6 col-12 border-end mb-3">
            <div class="support service-support-single d-flex align-items-center ps-4">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/about.png" alt="about"/>
                <div class="" style="margin: 5px;padding: 0px;">
                    <a href="{{ route('about.us') }}">
                        <h6 style="margin:0px"><strong>About SoftitGlobal</strong></h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 border-end mb-3">
            <div class="support service-support-single d-flex align-items-center ps-4">
                <img width="40" height="40" src="https://img.icons8.com/ios/40/marker--v1.png" alt="marker--v1"/>
                <div class="" style="margin: 5px;padding: 0px;">
                    <a href="{{ route('privacy.policy') }}">
                        <h6 style="margin:0px"><strong>Delivery Policy</strong></h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 border-end mb-3">
            <div class="support service-support-single d-flex align-items-center ps-4">
                <img width="40" height="40" src="https://img.icons8.com/dotty/40/term.png" alt="term"/>
                <div class="" style="margin: 5px;padding: 0px;">
                    <a href="{{ route('terms.condition') }}">
                        <h6 style="margin:0px"><strong>Terms &amp; Condition</strong></h6>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="support service-support-single d-flex align-items-center ps-4">
                <img width="30" height="30" src="https://img.icons8.com/ios/30/return.png" alt="return"/>
                <div class="" style="margin: 5px;padding: 0px;">
                    <a href="{{ route('privacy.policy') }}">
                        <h6 style="margin:0px"><strong>Return Policy</strong></h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="product_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true"></div>
</div>
<footer class="pt-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
                @if($setting->first()->white_logo != null)
                    <img width="30%" src="{{ asset('uploads/setting') }}/{{ $setting->first()->white_logo }}" alt="" class="img-fluid">
                @else
                    <img width="30%" src="{{ asset('uploads/setting') }}/{{ $setting->first()->black_logo }}" alt="" class="img-fluid">
                @endif
                @if($setting->first()->about != null)
                    <p>{{ $setting->first()->about }}</p>
                @endif
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
                <h4 class="regular">Quick Links</h4>
                <ul class="navbar-nav">
                    {{-- <li class="nav-item"><a href="" class="nav-link">Contact Us</a></li> --}}
                    <li class="nav-item"><a href="{{ route('about.us') }}" class="nav-link text-white">About Us</a></li>
                    <li class="nav-item"><a href="{{ route('terms.condition') }}" class="nav-link text-white">Terms & Conditions</a></li>
                    <li class="nav-item"><a href="{{ route('privacy.policy') }}" class="nav-link text-white">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
                <h4 class="regular">Contact Us</h4>
                
                    @if($setting->first()->number_one != null)
                        <p class="font-13 mb-1 d-flex align-items-center"><i class="fa fa-mobile col-1"></i> 
                            <span class="ps-2 col-11">Phone: {{ $setting->first()->number_one }}</span>
                        </p>
                    @endif
                    @if($setting->first()->email != null)
                        <p class="font-13 mb-1 d-flex align-items-center"><i class="fa fa-envelope col-1"></i> 
                            <span class="ps-2 col-11">Email: {{ $setting->first()->email }}</span>
                        </p>
                    @endif
                    @if($setting->first()->address != null)
                        <p class="font-13 mb-1 d-flex align-items-center"><i class="fa fa-location col-1"></i> 
                            <span class="ps-2 col-11">{{ $setting->first()->address }}</span>
                        </p>
                    @endif
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
                <h4 class="regular">Follow Us</h4>
                <div class="socials">

                    @if ($setting->first()->fb_link)
                        <a href="{{ $setting->first()->fb_link }}" class="btn btn-primary">
                            <i class="fab fa-facebook"></i>
                        </a>
                    @endif
                    @if ($setting->first()->youtube_link)
                        <a href="{{ $setting->first()->youtube_link }}" class="btn btn-danger">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                    @if ($setting->first()->insta_link)
                        <a href="{{ $setting->first()->insta_link }}" style="background: #f83fab;" class="btn btn-danger">
                            <i class="fa-brands fa-instagram" ></i>
                        </a>
                    @endif
                    @if ($setting->first()->linkind_link)
                        <a href="{{ $setting->first()->linkind_link }}" style="background: #467ad2;" class="btn btn-danger">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    @endif
                    @if ($setting->first()->tweeter_link)
                        <a href="{{ $setting->first()->tweeter_link }}" style="background: #2ee7ff;" class="btn btn-danger">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    @endif

                </div>
            </div>

        </div>
    </div>
    <hr>

    <style>
        @media (min-width: 320px) and (max-width: 575px) {
            .top_socials {
                text-align: center;
            }

            footer .socials {
                margin-top: 0px;
                margin-bottom: 13px;
            }
        }
    </style>


    <div class="container">
        <div class="pb-2 d-flex justify-content-lg-between justify-content-center flex-wrap">
            <div class="mb-3 mb-lg-0 mt-1">
                @if($setting->first()->footer != null)
                        <small><span class="bold">{{ $setting->first()->footer }}</small>
                    @endif
                     | Design and Development By <a class="text-primary" href="https://www.boguraweb.com/" target="_blank">Boguraweb</a>
            </div>
            {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-12 top_socials">
                <div class="socials">

                    <a href="{{ $setting->first()->fb_link }}" class="btn btn-primary">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a href="{{ $setting->first()->youtube_link }}" class="btn btn-danger">
                        <i class="fab fa-youtube"></i>
                    </a>


                    <a href="{{ $setting->first()->insta_link }}" class="btn btn-success">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="{{ $setting->first()->linkind_link }}" class="btn btn-success">
                        <i class="fab fa-linkedin"></i>
                    </a>


                    <a href="{{ $setting->first()->tweeter_link }}" class="btn btn-success">
                        <i class="fab fa-twitter"></i>
                    </a>


                </div>
            </div> --}}
            <div class="mb-3 mb-lg-0">
                @if($setting->first()->name != null)
                    <a class="text-white" href="{{ url('/') }}">{{ $setting->first()->name }}</a>
                @endif
            </div>
        </div>
    </div>

</footer>
