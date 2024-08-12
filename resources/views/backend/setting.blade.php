@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Setting</h1>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Setting
            </p>
        </div>
    </div>
    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="profile-content-left profile-left-spacing">
                    <div class="text-center widget-profile px-0 border-0">
                        <div class="card-img mx-auto rounded-circle">
                            @if ($setting->white_logo != null || $setting->black_logo != null)
                                @if ($setting->black_logo != null)
                                    <img src="{{ asset('uploads/setting') }}/{{ $setting->black_logo }}" alt="user image">
                                @else
                                    <img src="{{ asset('uploads/setting') }}/{{ $setting->white_logo }}" alt="user image">
                                @endif
                            @else
                                <img src="{{ Avatar::create($setting->name)->toBase64(); }}" alt="user image">
                            @endif
                        </div>
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ $setting->name }}</h4>
                            <p>{{ $setting->email }}</p>
                        </div>
                    </div>

                    <hr class="w-100">

                    <div class="contact-info pt-4">
                        <h5 class="text-dark">Contact Information</h5>
                        <p class="text-dark font-weight-medium pt-24px mb-2">About</p>
                        <p>{{ $setting->about }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Email address</p>
                        <p>{{ $setting->email }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Address</p>
                        <p>
                            @if ($setting->address != null)
                                {{ $setting->address }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Phone Number (One)</p>
                        <p>
                            @if ($setting->number_one != null)
                                {{ $setting->number_one }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Phone Number (Two)</p>
                        <p>
                            @if ($setting->number_two != null)
                                {{ $setting->number_two }}
                            @else
                                N/A
                            @endif
                        </p>

                        <p class="text-dark font-weight-medium pt-24px mb-2">Title</p>
                        <p>
                            @if ($setting->title != null)
                                {{ $setting->title }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Footer</p>
                        <p>
                            @if ($setting->footer != null)
                                {{ $setting->footer }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Meta Title</p>
                        <p>
                            @if ($setting->meta_title != null)
                                {{ $setting->meta_title }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Meta Tag</p>
                        <p>
                            @if ($setting->meta_tag != null)
                                {{ $setting->meta_tag }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Meta Description</p>
                        <p>
                            @if ($setting->meta_description != null)
                                {{ $setting->meta_description }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Facebook</p>
                        <p>
                            {{ $setting->fb_link }}
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">You tube</p>
                        <p>
                            {{ $setting->youtube_link }}
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Instagram</p>
                        <p>
                            {{ $setting->insta_link }}
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">linkedin</p>
                        <p>
                            {{ $setting->linkind_link }}
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Twitter</p>
                        <p>
                            {{ $setting->tweeter_link }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xl-9">
                <div class="profile-content-right profile-right-spacing py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="settings-tab" data-bs-toggle="tab"
                                data-bs-target="#settings" type="button" role="tab"
                                aria-controls="settings" aria-selected="false">Setting</button>
                        </li>
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">
                            <div class="tab-pane-content mt-5">
                                <form action="{{ route('setting.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $setting->id }}">
                                    <div class="form-group row mb-6">
                                        <label for="coverImage"
                                            class="col-sm-4 col-lg-2 col-form-label">White Logo <p style="font-size: 13px" class="text-danger">Size max 1MB *</p></label>
                                        <div class="col-sm-4 col-lg-6">
                                            <div class="custom-file mb-1">
                                                <input type="file" class="custom-file-input" name="white_logo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                <label class="custom-file-label" for="coverImage">Choose
                                                    file...</label>
                                                <div class="invalid-feedback">Example invalid custom
                                                    file feedback</div>
                                            </div>
                                            @error('white_logo')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 col-lg-4" >
                                            <img width="100" src="{{ asset('uploads/setting') }}/{{ $setting->white_logo }}" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-6">
                                        <label for="coverImage"
                                            class="col-sm-4 col-lg-2 col-form-label">Black Logo <p style="font-size: 13px" class="text-danger">Size max 1MB *</p></label>
                                        <div class="col-sm-4 col-lg-6">
                                            <div class="custom-file mb-1">
                                                <input type="file" class="custom-file-input" name="black_logo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                <label class="custom-file-label" for="coverImage">Choose
                                                    file...</label>
                                                <div class="invalid-feedback">Example invalid custom
                                                    file feedback</div>
                                            </div>
                                            @error('black_logo')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 col-lg-4" >
                                            <img width="100" src="{{ asset('uploads/setting') }}/{{ $setting->black_logo }}" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-6">
                                        <label for="coverImage"
                                            class="col-sm-4 col-lg-2 col-form-label">Faveicon <p style="font-size: 13px" class="text-danger">Size max 1MB *</p></label>
                                        <div class="col-sm-4 col-lg-6">
                                            <div class="custom-file mb-1">
                                                <input type="file" class="custom-file-input" name="favicon" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                <label class="custom-file-label" for="coverImage">Choose
                                                    file...</label>
                                                <div class="invalid-feedback">Example invalid custom
                                                    file feedback</div>
                                            </div>
                                            @error('favicon')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 col-lg-4">
                                            <img width="100"  src="{{ asset('uploads/setting') }}/{{ $setting->favicon }}" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-6 m-auto">
                                        <div class="col-sm-8 col-lg-8 m-auto" class="text-center" style="height: 100px">
                                            <img width="100" id="blah" src="" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input ttype="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $setting->name }}">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ $setting->email }}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" required name="address" value="{{ $setting->address }}">
                                        @error('address')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="number_one">Phone One <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('number_one') is-invalid @enderror" id="number_one" required name="number_one" value="{{ $setting->number_one }}">
                                        @error('number_one')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="number_two">Phone Two <span class="text-secondary">(Optional)</span></label>
                                        <input type="number" class="form-control" id="number_two" name="number_two" value="{{ $setting->number_two }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" required id="title" name="title" value="{{ $setting->title }}">
                                        @error('title')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="footer">Footer <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('footer') is-invalid @enderror" required id="footer" name="footer" value="{{ $setting->footer }}">
                                        @error('footer')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="meta_title">Meta Title <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $setting->meta_title }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="meta_tag">Meta Tag <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="meta_tag" name="meta_tag" value="{{ $setting->meta_tag }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="meta_description">Meta Description <span class="text-secondary">(Optional)</span></label>
                                        <textarea name="meta_description" class="form-control" id="meta_description" cols="30" rows="10">{{ $setting->meta_description }}</textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="fb_link">Facebook <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="fb_link" name="fb_link" value="{{ $setting->fb_link }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="youtube_link">Youtube <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="{{ $setting->youtube_link }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="insta_link">instagram <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="insta_link" name="insta_link" value="{{ $setting->insta_link }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="linkind_link">linkedin <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="linkind_link" name="linkind_link" value="{{ $setting->linkind_link }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="tweeter_link">twitter <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="tweeter_link" name="tweeter_link" value="{{ $setting->tweeter_link }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="about">About <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('about') is-invalid @enderror" required id="about" name="about" value="{{ $setting->about }}">
                                        @error('about')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="fb_pixel">Facebook Pixel <span class="text-secondary">(Optional)</span></label>
                                        <textarea name="fb_pixel" class="form-control" id="fb_pixel" cols="30" rows="10">{{ $setting->fb_pixel }}</textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="google_tag">Google Tag <span class="text-secondary">(Optional)</span></label>
                                        <textarea name="google_tag" class="form-control" id="google_tag" cols="30" rows="10">{{ $setting->google_tag }}</textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="google_map">Google Map <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="google_map" name="google_map" value="{{ $setting->google_map }}">
                                    </div>
                                    <div class="d-flex justify-content-end mt-5">
                                        <button type="submit" class="btn btn-primary mb-2 btn-pill">
                                            Update Setting
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

