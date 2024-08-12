@extends('frontend.layouts.app')
@section('content')

<div class="container-xl my-5" style="min-height: 600px">
    <div class="row g-5">
        
        <div class="col-md-12 col-lg-12 order-md-last">
            {!! $abouts->description !!}
          </div>
      
    </div>
</div>
@endsection
