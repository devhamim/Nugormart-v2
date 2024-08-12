@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>User Profile</h1>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Profile
            </p>
        </div>
    </div>
    <div class="card bg-white profile-content">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="profile-content-left profile-left-spacing">
                    <div class="text-center widget-profile px-0 border-0">
                        <div class="card-img mx-auto rounded-circle">
                            @if ($profile->image != null)
                                <img src="{{ asset('uploads/user') }}/{{ $profile->image }}" alt="user image">
                            @else
                                <img src="{{ Avatar::create($profile->name)->toBase64(); }}" alt="user image">
                            @endif
                        </div>
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ $profile->name }}</h4>
                            <p>{{ $profile->email }}</p>
                        </div>
                    </div>

                    <hr class="w-100">

                    <div class="contact-info pt-4">
                        <h5 class="text-dark">Contact Information</h5>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Email address</p>
                        <p>{{ $profile->email }}</p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Phone Number</p>
                        <p>
                            @if ($profile->number != null)
                                {{ $profile->number }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p class="text-dark font-weight-medium pt-24px mb-2">Address</p>
                        <p>
                            @if ($profile->address != null)
                                {{ $profile->address }}
                            @else
                                N/A
                            @endif
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
                                aria-controls="settings" aria-selected="false">Profile</button>
                        </li>
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">
                            <div class="tab-pane-content mt-5">
                                <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $profile->id }}">
                                    <div class="form-group row mb-6">
                                        <label for="coverImage"
                                            class="col-sm-4 col-lg-2 col-form-label">Profile Image <p style="font-size: 13px" class="text-secondary">Size max 1MB (Optional)</p></label>
                                        <div class="col-sm-4 col-lg-6">
                                            <div class="custom-file mb-1">
                                                <input type="file" class="custom-file-input" name="image" id="coverImage" onchange="previewImage(event)">
                                                <label class="custom-file-label" for="coverImage">Choose
                                                    file...</label>
                                                <div class="invalid-feedback">Example invalid custom
                                                    file feedback</div>
                                            </div>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 col-lg-4" style="height: 100px">
                                            <img id="preview" src="#" alt="Selected Image" style="display: none; max-width: 200px; max-height: 200px;">
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input ttype="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $profile->name }}">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ $profile->email }}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="number">Phone <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="number" name="number" value="{{ $profile->number }}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="address">Address <span class="text-secondary">(Optional)</span></label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $profile->address }}">
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="oldPassword">Old password</label>
                                        <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword" name="oldPassword">
                                        @error('oldPassword')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="newPassword">New password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" name="password">
                                        @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="conPassword">Confirm password</label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="conPassword" name="password_confirmation">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end mt-5">
                                        <button type="submit" class="btn btn-primary mb-2 btn-pill">
                                            Update Profile
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

