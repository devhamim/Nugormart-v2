@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
        <div>
            <h1>Add Product</h1>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Product</p>
        </div>
        <div>
            <a href="{{ route('product.index') }}" class="btn btn-primary"> View All
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add Product</h2>
                </div>

                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row ec-vendor-uploads">
                            <div class="col-lg-4">
                                <div class="ec-vendor-img-upload">
                                    <div class="ec-vendor-main-img attribute_image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" name="image" class="ec-image-upload @error('image') is-invalid @enderror" value="{{ old('image') }}" required />
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
                            <div class="col-lg-8">
                                <div class="ec-vendor-upload-detail">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Product name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control slug-title @error('name') is-invalid @enderror" name="name"  value="{{ old('name') }}" required>
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Attribute <span class="text-danger">*</span></label>
                                            <select name="inventorie_id" id="inventorie_id" class="form-select" value="{{ old('inventorie_id') }}" required>
                                                <option value="">-- Selected Attribute --</option>
                                                @foreach ($inventorys as $inventory)
                                                    <option value="{{ $inventory->id }}">{{ $inventory->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Categories <span class="text-danger">*</span></label>
                                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" value="{{ old('category_id') }}" required>
                                                <option value="">-- Selected Category --</option>
                                                @foreach ($categoreys as $categorey)
                                                    <option value="{{ $categorey->id }}">{{ $categorey->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Subcategories <span class="text-secondary">(Optional)</span></label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-select @error('subcategory_id') is-invalid @enderror" value="{{ old('subcategory_id') }}" required>
                                                <option value="">-- Selected Subcategory --</option>
                                            </select>
                                            @error('subcategory_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sku" class="col-12 col-form-label">SKU</label>
                                            <div class="col-12">
                                                <input id="sku" name="sku" class="form-control here  @error('sku') is-invalid @enderror" type="text" value="{{ old('sku') }}" required>
                                                @error('sku')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="brand" class="col-12 col-form-label">Brand</label>
                                            <div class="col-12">
                                                {{-- class add if need type slug-title class field auto felap set-slug field  --}}
                                                <input id="brand" name="brand" class="form-control" type="text" value="{{ old('brand') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Description</label>
                                            <textarea id="summernote" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required rows="4"></textarea>
                                            @error('description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Product Tags <span>( Type and make comma to separate tags )</span></label>
                                            <input type="text" class="form-control @error('tag') is-invalid @enderror" id="tag" name="tag" value="{{ old('tag') }}" required data-role="tagsinput" />
                                            @error('tag')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="attribute-fields">
                                            {{-- <p class="my-3">Variation</p>
                                            <hr>
                                            <div class="row">

                                                <div class="col-md-12 mb-25">
                                                    <label class="form-label">Colors</label>
                                                    <div class="form-checkbox-box">
                                                        @foreach ($colors as $color)
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" name="color_id" value="{{ $color->id }}">
                                                                <label class="inventory_color" style="background: {{ $color->code }}">{{ $color->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-25">
                                                    <label class="form-label">Size</label>
                                                    <div class="form-checkbox-box">
                                                        @foreach ($sizes as $size)
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" name="size_id" value="{{ $size->id }}">
                                                                <label>{{ $size->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Weight </label>
                                                    <input type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" id="weight">
                                                    @error('weight')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Price <span>( In BDT )</span></label>
                                                    <input type="text" class="form-control @error('price') is-invalid @enderror" required name="price" value="{{ old('price') }}"   id="price1">
                                                    @error('price')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Sell Price <span>( In BDT )</span></label>
                                                    <input type="number" class="form-control @error('sell_price') is-invalid @enderror" name="sell_price" value="{{ old('sell_price') }}"  id="sell_price">
                                                    @error('sell_price')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" required name="quantity" value="{{ old('quantity') }}"  id="quantity">
                                                    @error('quantity')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        {{-- <div class="attribute-fields">
                                            <!-- Attribute fields will be populated here -->
                                        </div> --}}
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

@section('footer_scripts')
<script>
    $(document).ready(function(){
         $('#category_id').change(function(){
             var category_id = $(this).val();

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             $.ajax({
                 type:'POST',
                 url:'/admin/getsubcategory',
                 data:{'category_id':category_id},
                 success:function(data){
                     $('#subcategory_id').html(data);
                 }
             })
         })
     });

 </script>

<script>
   $(document).ready(function(){
    $('#inventorie_id').change(function(){
        var inventorie_id = $(this).val();

        $.ajax({
            type: 'POST',
            url: '/admin/getinventorydata',
            data: {'inventorie_id': inventorie_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                $('#brand').val(data.brand);
                $('#sku').val(data.sku);

                // Clear existing attribute fields
                $('.attribute-fields').empty();
                $('.attribute_image').empty();

                // attribute_image
                if (data.attributes.length > 0) {
                    data.attributes.forEach(function(attribute, index) {
                        var attributeHtml = `
                            <div class="attribute row">
                                <div class="thumb-upload-set colo-md-4">
                                    <div class="thumb-upload">
                                        <div class="thumb-edit">
                                            <input type='file' id="thumbUpload01"  class="ec-image-upload" value="${attribute.image}" />
                                            <label for="imageUpload">
                                                <img  src="{{ asset('backend') }}/img/icons/edit.svg" class="svg_img header_svg" alt="edit" />
                                            </label>
                                        </div>
                                        <div class="thumb-preview ec-preview">
                                            <div class="image-thumb-preview">
                                                <img class="image-thumb-preview ec-image-preview" src="{{ asset('uploads/product') }}/${attribute.image}" alt="edit" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('.attribute_image').append(attributeHtml);
                    });
                };

                // Populate attribute fields
                if (data.attributes.length > 0) {
                    data.attributes.forEach(function(attribute, index) {
                        var attributeHtml = `
                            <div class="attribute">
                                <p class="my-3">Variation ${index + 1}</p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 mb-25">
                                        <label class="form-label">Colors</label>
                                        <input type="hidden" value="${attribute.color_id}">
                                        <label class="inventory_color" style="background: ${attribute.color_code}">${attribute.color_name}</label>
                                    </div>
                                    <div class="col-md-4 mb-25">
                                        <label class="form-label">Size</label>
                                        <input type="hidden" value="${attribute.size_id}">
                                        <label>${attribute.size_name}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Weight </label>
                                        <input type="text" class="form-control" value="${attribute.weight}" id="weight">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" value="${attribute.quantity}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Price <span>( In BDT )</span></label>
                                        <input type="number" class="form-control" id="price1" value="${attribute.price}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Sell Price <span>( In BDT )</span></label>
                                        <input type="number" class="form-control" id="sell_price" value="${attribute.sell_price}">
                                    </div>

                                </div>

                            </div>
                        `;
                        $('.attribute-fields').append(attributeHtml);

                        // Populate price fields based on index
                        if (index === 0) {
                            $('#price1').val(attribute.price);
                        } else {
                            $('#price' + (index + 1)).val(attribute.price);
                        }
                    });
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
@endsection
