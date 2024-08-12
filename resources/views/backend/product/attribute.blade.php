@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Add Inventory</h1>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Inventory</p>
        </div>
        <div>
            <a href="{{ route('inventory.index') }}" class="btn btn-primary"> Inventory List
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add Inventory</h2>
                </div>

                <div class="card-body">
                    <form class="row g-3" action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row ec-vendor-uploads my-3">
                            <div class="col-md-4">
                                <label for="title" class="col-12 col-form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control set-slug @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sku" class="col-12 col-form-label">SKU <span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input id="sku" name="sku" class="form-control here set-slug @error('sku') is-invalid @enderror" type="text" value="{{ old('sku') }}" required>
                                    @error('sku')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="brand" class="col-12 col-form-label">Brand <span class="text-secondary">(Optional)</span></label>
                                <div class="col-12">
                                    <input id="brand" name="brand" class="form-control here set-slug" type="text" value="{{ old('brand') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row ec-vendor-uploads template mb-5">
                                <div class="col-lg-2">
                                    <div class="ec-vendor-img-upload">
                                        <div class="ec-vendor-main-img">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="image[]" class="ec-image-upload @error('image') is-invalid @enderror" value="{{ old('image') }}" required />
                                                    <label for="imageUpload">
                                                        <img src="{{ asset('backend') }}/img/icons/edit.svg" class="svg_img header_svg" alt="edit" />
                                                    </label>
                                                </div>
                                                <div class="avatar-preview ec-preview">
                                                    <div class="imagePreview ec-div-preview">
                                                        <img class="ec-image-preview" src="{{ asset('backend') }}/img/products/vender-upload-preview.jpg" alt="edit" />
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="ec-vendor-upload-detail">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <a href="javascript:void(0);" class="remove-row btn btn-danger">remove</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 my-3">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity1" name="quantity[]" value="{{ old('quantity') }}" required>
                                                @error('quantity')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 my-3">
                                                <label class="form-label">Price <span>( In BDT )</span></label>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price[]" id="price1" value="{{ old('price') }}" required>
                                                @error('price')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 my-3">
                                                <label class="form-label">Sell Price <span>( In BDT )</span></label>
                                                <input type="number" class="form-control" name="sell_price[]" value="{{ old('sell_price') }}">
                                                @error('sell_price')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 my-3">
                                                <label class="form-label">Package <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="weight[]" value="{{ old('weight') }}">
                                                @error('weight')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Color <span class="text-danger">*</span></label>
                                                <select name="color_id[]" id="color_id" class="form-select @error('color_id') is-invalid @enderror" value="{{ old('color_id') }}">
                                                    <option value="">-- Selected Color --</option>
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('color_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Size <span class="text-danger">*</span></label>
                                                <select name="size_id[]" id="size_id" class="form-select @error('size_id') is-invalid @enderror" value="{{ old('size_id') }}">
                                                    <option value="">-- Selected Color --</option>
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->name }}">{{ $size->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('size_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 offset-sm-2 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-success add-new-row">Add New</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script>
    $(document).ready(function() {
        $('.add-new-row').click(function() {
            var newRow = $('.template').clone().removeClass('template').show();
            $('.ec-vendor-uploads:last').after(newRow);
        });
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.ec-vendor-uploads').remove();
        });
    });
</script>
@endsection



