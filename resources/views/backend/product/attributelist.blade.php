@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Attribute List</h1>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Attribute
            </p>
        </div>
        <div>
            <a href="{{ route('inventory.create') }}" class="btn btn-primary">Add Attribute</a>
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
                                    <th>Title</th>
                                    <th>SKU</th>
                                    <th>Brand</th>
                                    <th>Inventory</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($inventorys as $inventory)
                                    <tr>
                                        <td>
                                            @if ($inventory->rel_to_attribute->isNotEmpty() && $inventory->rel_to_attribute->first()->image)
                                            <img width="100" src="{{ asset('uploads/product') }}/{{ $inventory->rel_to_attribute->first()->image }}" alt="Image" />
                                            @else
                                                No image available
                                            @endif
                                        </td>
                                        <td>{{ $inventory->title }}</td>
                                        <td>{{ $inventory->sku }}</td>
                                        <td>
                                            @if ($inventory->brand != null)
                                                {{ $inventory->brand }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($inventory->rel_to_attribute as $attribute)
                                                @if ($attribute->color_id)
                                                    color: {{  $attribute->color_id }},
                                                @endif
                                                @if ($attribute->size_id)
                                                    size: {{  $attribute->size_id }},
                                                @endif
                                                @if ($attribute->weight)
                                                    Package: {{  $attribute->weight }},
                                                @endif
                                                Price: {{  $attribute->price }}, Sell Price: {{  $attribute->sell_price }}, Quantity: {{  $attribute->quantity }},<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($inventory->status == 1)
                                                <div class="badge badge-success">Active</div>
                                            @else
                                                <div class="badge badge-danger">Deactive</div>
                                            @endif
                                        </td>
                                        <td>{{ $inventory->created_at->format('d-m-Y') }}</td>
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
                                                    <a class="dropdown-item" href="{{ route('inventory.edit', $inventory->id) }}">Edit</a>
                                                    <form action="{{ route('inventory.destroy',  $inventory->id) }}" method="POST">
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
