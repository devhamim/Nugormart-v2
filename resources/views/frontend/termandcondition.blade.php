@extends('frontend.layouts.app')
@section('content')
<div class="container">
    <div class="border-bottom mb-4">
        <div class="breadcrumbs row align-items-center justify-content-between d-none d-md-flex">
            <div class="col-12">
                <ul class="breadcrumbs_content list-unstyled">

                    <li><span>Terms & Condition</span></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="container-xl my-5" style="min-height: 600px">
        <div class="row g-5">
            
            <div class="col-md-12 col-lg-12 order-md-last">
                {!! $termscondition->description !!}
              </div>
          
        </div>
    </div>
</div>
@endsection
