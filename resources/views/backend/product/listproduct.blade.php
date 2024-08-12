@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Product List</h1>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Product
            </p>
        </div>
        <div>
            <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>SKU</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Package</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Sell Price</th>
                                    <th>Tag</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    @if ($product->inventorie_id != null)
                                        <tr>
                                            <td>
                                                @if ($product->rel_to_inventorie)
                                                    @php
                                                        $inventorie = $product->rel_to_inventorie
                                                    @endphp
                                                    @foreach ($inventorie->rel_to_attribute->take(1) as $attribute)
                                                        <img width="100" src="{{ asset('uploads/product') }}/{{ $attribute->image }}" alt="Image" />
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->rel_to_inventorie)
                                                    @if ($product->rel_to_inventorie->sku != null)
                                                        {{ $product->rel_to_inventorie->sku }}
                                                    @else
                                                        N/A
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->name != null)
                                                    {{ $product->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->category_id != null)
                                                    @if ($product->rel_to_cat != null)
                                                        {{ $product->rel_to_cat->name }}
                                                    @else
                                                        C/N/A
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->subcategory_id != null)
                                                    @if ($product->rel_to_subcat != null)
                                                        {{ $product->rel_to_subcat->name }}
                                                    @else
                                                        C/N/A
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->rel_to_inventorie)
                                                    @php
                                                        $inventorie = $product->rel_to_inventorie
                                                    @endphp
                                                    @foreach ($inventorie->rel_to_attribute as $attribute)
                                                        {{ $attribute->color_id }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->rel_to_inventorie)
                                                    @php
                                                        $inventorie = $product->rel_to_inventorie
                                                    @endphp
                                                    @foreach ($inventorie->rel_to_attribute as $attribute)
                                                        {{ $attribute->size_id }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->rel_to_inventorie)
                                                    @php
                                                        $inventorie = $product->rel_to_inventorie
                                                    @endphp
                                                    @foreach ($inventorie->rel_to_attribute as $attribute)
                                                        {{ $attribute->weight }},
                                                    @endforeach
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->brand != null)
                                                    {{ $product->brand }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->rel_to_inventorie)
                                                        @php
                                                            $inventorie = $product->rel_to_inventorie
                                                        @endphp
                                                        @foreach ($inventorie->rel_to_attribute as $attribute)
                                                            {{ $attribute->quantity }},
                                                        @endforeach
                                                    @endif

                                            </td>
                                            <td>
                                                @if ($product->rel_to_inventorie)
                                                    @php
                                                        $inventorie = $product->rel_to_inventorie
                                                    @endphp
                                                    @foreach ($inventorie->rel_to_attribute as $attribute)
                                                        {{ $attribute->price }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->rel_to_inventorie)
                                                    @php
                                                        $inventorie = $product->rel_to_inventorie
                                                    @endphp
                                                    @foreach ($inventorie->rel_to_attribute as $attribute)
                                                        {{ $attribute->sell_price }},
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->tag != null)
                                                    {{ Str::limit($product->tag, 10, '...') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <div class="badge badge-success">Active</div>
                                                @else
                                                    <div class="badge badge-danger">Deactive</div>
                                                @endif
                                            </td>
                                            <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="btn-group mb-1">
                                                    <button type="button"
                                                        class="btn btn-outline-success">Info</button>
                                                    <button type="button"
                                                        class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" data-display="static">
                                                        <span class="sr-only">Info</span>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('product.edit',  $product->id) }}" class="dropdown-item">Edit</a>
                                                        <form action="{{ route('product.destroy',  $product->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <img width="100" src="{{ asset('uploads/product') }}/{{ $product->image }}" alt="Image" />
                                            </td>
                                            <td>
                                                @if ($product->sku != null)
                                                    {{ $product->sku }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->name != null)
                                                    {{ $product->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->category_id != null)
                                                    @if ($product->rel_to_cat != null)
                                                        {{ $product->rel_to_cat->name }}
                                                    @else
                                                        C/N/A
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->subcategory_id != null)
                                                    @if ($product->rel_to_subcat != null)
                                                        {{ $product->rel_to_subcat->name }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->color_id != null)
                                                    {{ $product->color_id }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->size_id != null)
                                                    {{ $product->size_id }}
                                                @endif

                                            </td>
                                            <td>
                                                @if ($product->weight != null)
                                                    {{ $product->weight }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->brand != null)
                                                    {{ $product->brand }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->quantity != null)
                                                    {{ $product->quantity }}
                                                @else
                                                    N/A
                                                @endif

                                            </td>
                                            <td>
                                                @if ($product->price != null)
                                                    {{ $product->price }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->sell_price != null)
                                                    {{ $product->sell_price }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->tag != null)
                                                    {{ $product->tag }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <div class="badge badge-success">Active</div>
                                                @else
                                                    <div class="badge badge-danger">Deactive</div>
                                                @endif
                                            </td>
                                            <td>{{ $product->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="btn-group mb-1">
                                                    <button type="button"
                                                        class="btn btn-outline-success">Info</button>
                                                    <button type="button"
                                                        class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" data-display="static">
                                                        <span class="sr-only">Info</span>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('product.edit', $product->id) }}" class="dropdown-item">Edit</a>
                                                        <form action="{{ route('product.destroy',  $product->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this item?')">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
