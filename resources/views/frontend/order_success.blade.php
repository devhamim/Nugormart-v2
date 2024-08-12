@extends('frontend.layouts.app')
@section('content')
<div class="page-content mt-3">
    <div class="col-lg-6 m-auto mt-5">
        <div class="summary summary-cart text-center">
            <h3 class="text-success">Thanks for your order.</h3><!-- End .summary-title -->
            <p class="ft-regular fs-md text-success">We will call you to inform about order details(at 10:00 AM to 10:00 PM)</p>
            <p class="ft-regular fs-md text-success">If you have any query</p>
            <a class="btn btn-success mt-2 border-0" href="{{ url('/') }}">Home</a>
        </div><!-- End .summary -->
    </div>
</div>
@endsection



