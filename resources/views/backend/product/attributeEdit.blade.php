@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Edit Inventory</h1>
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
                    <h2>Edit Inventory</h2>
                </div>

                <div class="card-body">
                    <form class="row g-3" action="{{ route('inventory.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" value="{{ $inventory->id }}" name="inventory_id">
                        <div class="row ec-vendor-uploads my-3">
                            <div class="col-md-4">
                                <label for="title" class="col-12 col-form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control set-slug @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $inventory->title) }}" required>
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sku" class="col-12 col-form-label">SKU <span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input id="sku" name="sku" class="form-control here set-slug @error('sku') is-invalid @enderror" type="text" value="{{ old('sku', $inventory->sku) }}" required>
                                    @error('sku')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="brand" class="col-12 col-form-label">Brand <span class="text-secondary">(Optional)</span></label>
                                <div class="col-12">
                                    <input id="brand" name="brand" class="form-control here set-slug" type="text" value="{{ old('brand', $inventory->brand) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-4">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1"{{ $inventory->status == 1?'selected':'' }}>Active</option>
                                        <option value="0"{{ $inventory->status == 0?'selected':'' }}>Deactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach($inventory->rel_to_attribute as $detail)
                        <div class="row ec-vendor-uploads my-3">
                            <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                            <div class="col-lg-2">
                                <div class="ec-vendor-img-upload">
                                    <div class="ec-vendor-main-img">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" name="image[]" class="ec-image-upload @error('image') is-invalid @enderror" value="{{ old('image', $detail->image) }}" />
                                                <label for="imageUpload">
                                                    <img src="{{ asset('backend') }}/img/icons/edit.svg" class="svg_img header_svg" alt="edit" />
                                                </label>
                                            </div>
                                            <div class="avatar-preview ec-preview">
                                                <div class="imagePreview ec-div-preview">
                                                    <img class="ec-image-preview" src="{{ asset('uploads/product') }}/{{ $detail->image }}" alt="edit" />
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
                                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity[]" value="{{ old('quantity', $detail->quantity) }}" required>
                                            @error('quantity')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 my-3">
                                            <label class="form-label">Price <span>( In BDT )</span></label>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price[]" value="{{ old('price', $detail->price) }}" required>
                                            @error('price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 my-3">
                                            <label class="form-label">Sell Price <span>( In BDT )</span></label>
                                            <input type="number" class="form-control" name="sell_price[]" value="{{ old('sell_price', $detail->sell_price) }}">
                                            @error('sell_price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 my-3">
                                            <label class="form-label">Package <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="weight[]" value="{{ old('weight', $detail->weight) }}">
                                            @error('weight')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Color <span class="text-danger">*</span></label>
                                            <select name="color_id[]" class="form-select @error('color_id') is-invalid @enderror">
                                                <option value="">-- Select Color --</option>
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}" {{ $color->id == $detail->color_id ? 'selected' : '' }}>{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('color_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Size <span class="text-danger">*</span></label>
                                            <select name="size_id[]" class="form-select @error('size_id') is-invalid @enderror">
                                                <option value="">-- Select Size --</option>
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->name }}" {{ $size->name == $detail->size_id ? 'selected' : '' }}>{{ $size->name }}</option>
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
                        @endforeach
                        <div class="row">
                            <div class="col-md-12 offset-sm-2 mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
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
        var rowTemplate = `
            <div class="row ec-vendor-uploads my-3">
                <input type="hidden" name="detail_id[]" value="">
                <div class="col-lg-2">
                    <div class="ec-vendor-img-upload">
                        <div class="ec-vendor-main-img">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="image[]" class="ec-image-upload" />
                                    <label>
                                        <img src="{{ asset('backend') }}/img/icons/edit.svg" class="svg_img header_svg" alt="edit" />
                                    </label>
                                </div>
                                <div class="avatar-preview ec-preview">
                                    <div class="imagePreview ec-div-preview">

                                        <img class="ec-image-preview" src="{{ asset('backend') }}/img/products/vender-upload-preview.jpg" alt="edit" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="ec-vendor-upload-detail">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <a href="javascript:void(0);" class="remove-row text-danger">remove</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 my-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity[]" required>
                            </div>
                            <div class="col-md-4 my-3">
                                <label class="form-label">Price <span>( In BDT )</span></label>
                                <input type="number" class="form-control" name="price[]" required>
                            </div>
                            <div class="col-md-4 my-3">
                                <label class="form-label">Sell Price <span>( In BDT )</span></label>
                                <input type="number" class="form-control" name="sell_price[]">
                            </div>
                            <div class="col-md-4 my-3">
                                <label class="form-label">Package <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="weight[]">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Color <span class="text-danger">*</span></label>
                                <select name="color_id[]" class="form-select">
                                    <option value="">-- Select Color --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Size <span class="text-danger">*</span></label>
                                <select name="size_id[]" class="form-select">
                                    <option value="">-- Select Size --</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $('.add-new-row').click(function() {
            $('.ec-vendor-uploads:last').after(rowTemplate);
        });

        $(document).on('click', '.remove-row', function() {
            var row = $(this).closest('.ec-vendor-uploads');
            var detailId = row.find('input[name="detail_id[]"]').val();

            if (detailId) {
                // Add the detail ID to a hidden field to handle deletion in the backend
                $('form').append('<input type="hidden" name="delete_detail_id[]" value="' + detailId + '">');
            }

            row.remove();
        });
    });
</script>
@endsection

