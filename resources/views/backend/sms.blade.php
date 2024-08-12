@extends('backend.layouts.app')
@section('content')
<div class="content">
    <!-- Top Statistics -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-1">
                <div class="card-body">
                    <h2 class="mb-1">{{ $smscousts->smscount }}</h2>
                    <p>Request SMS</p>
                    <span class="mdi mdi-account-arrow-left"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-2">
                <div class="card-body">
                    <h2 class="mb-1">{{ $smscousts->smscount }}</h2>
                    <p>Success SMS</p>
                    <span class="mdi mdi-account-clock"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-3">
                <div class="card-body">
                    <h2 class="mb-1">{{ $smscousts->smstotal }}</h2>
                    <p>Total</p>
                    <span class="mdi mdi-package-variant"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
            <div class="card card-mini dash-card card-4">
                <div class="card-body">
                    <h2 class="mb-1">{{ $smscousts->smscost }}</h2>
                    <p>SMS Cost</p>
                    <span class="mdi mdi-currency-usd"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
