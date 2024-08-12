
@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>About</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>About</h2>
                </div>

                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('about.update', $abouts->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $abouts->id }}">
                        <div class="row ec-vendor-uploads">

                            <div class="col-lg-12">
                                <div class="ec-vendor-upload-detail">
                                    <div class="row g-3">
                                        {{-- <div class="col-lg-12">
                                            <div class="ec-vendor-img-upload">
                                                <div class="ec-vendor-main-img attribute_image">
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file'  name="image" class="ec-image-upload @error('image') is-invalid @enderror" value="{{ old('image') }}" />
                                                            <input type="file" class="ec-image-upload @error('image') is-invalid @enderror" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                                            <label for="imageUpload">
                                                                <img src="{{ asset('backend') }}/img/icons/edit.svg" class="svg_img header_svg" alt="edit" />
                                                            </label>
                                                        </div>
                                                        <div class="avatar-preview ec-preview">
                                                            <div class="imagePreview ec-div-preview">
                                                                <img class="ec-image-preview" src="{{ asset('uploads/about') }}/{{ $abouts->image }}" alt="edit" />
                                                            </div>
                                                        </div>
                                                        @error('image')
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-4">
                                                <label for="title">Title <span class="text-danger">*</span></label>
                                                <input type="text" id="title" class="form-control" name="title" value="{{ $abouts->title }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="summernote" name="description" required rows="4">{!! $abouts->description !!}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

