@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Products</h4>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Colors</th>
                                    <th>Sizes</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Images</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            @foreach($product->colors as $color)
                                                <span class="badge bg-light text-dark">{{ $color->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($product->sizes as $size)
                                                <span class="badge bg-light text-dark">{{ $size->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $product->stock }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-1" style="width: 60px; height: 60px;">
                                                @if($product->first_image)
                                                    <img src="{{ asset('storage/' . $product->first_image) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-1" style="width: 60px; height: 60px;">
                                                @endif
                                                @if($product->second_image)
                                                    <img src="{{ asset('storage/' . $product->second_image) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-1" style="width: 60px; height: 60px;">
                                                @endif
                                                @if($product->third_image)
                                                    <img src="{{ asset('storage/' . $product->third_image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="width: 60px; height: 60px;">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($product->status == 1)
                                                <span class="badge bg-success">In Stock</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No products found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 