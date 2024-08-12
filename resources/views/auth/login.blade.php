@extends('auth.app')
@section('login_content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="ec-brand">
                    <a href="{{ url('/') }}">
                        @if($setting->first()->black_logo != null)
                            <img class="ec-brand-icon" src="{{ asset('uploads/setting') }}/{{ $setting->first()->black_logo }}" alt="" />
                        @else
                            <img class="ec-brand-icon" src="{{ asset('uploads/setting') }}/{{ $setting->first()->white_logo }}" alt="" />
                        @endif
                    </a>
                </div>
            </div>
            <div class="card-body p-5">
                <h4 class="text-dark mb-5">Sign In</h4>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12 mb-4">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12 ">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="d-flex my-2 justify-content-between">
                                <div class="d-inline-block mr-3">
                                    <div class="control control-checkbox">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                        Remember me
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mb-4">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
