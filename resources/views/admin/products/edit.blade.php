@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Quantity</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color_id" class="form-label">Colors</label>
                            <select class="form-select @error('color_id') is-invalid @enderror" id="color_id" name="color_id[]" multiple>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}" {{ collect(old('color_id', $product->colors->pluck('id')))->contains($color->id) ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('color_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="size_id" class="form-label">Sizes</label>
                            <select class="form-select @error('size_id') is-invalid @enderror" id="size_id" name="size_id[]" multiple>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ collect(old('size_id', $product->sizes->pluck('id')))->contains($size->id) ? 'selected' : '' }}>
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('size_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail Image</label>
                            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                            <div class="mt-2">
                                <img id="thumbnail-preview" src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail Preview" class="img-fluid rounded" style="width: 100px; height: 100px;">
                            </div>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="first_image" class="form-label">First Image</label>
                            <input type="file" class="form-control @error('first_image') is-invalid @enderror" id="first_image" name="first_image" accept="image/*">
                            <div class="mt-2">
                                @if($product->first_image)
                                    <img id="first-image-preview" src="{{ asset('storage/' . $product->first_image) }}" alt="First Image Preview" class="img-fluid rounded" style="width: 100px; height: 100px;">
                                @else
                                    <img id="first-image-preview" src="#" alt="First Image Preview" class="img-fluid rounded d-none" style="width: 100px; height: 100px;">
                                @endif
                            </div>
                            @error('first_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="second_image" class="form-label">Second Image</label>
                            <input type="file" class="form-control @error('second_image') is-invalid @enderror" id="second_image" name="second_image" accept="image/*">
                            <div class="mt-2">
                                @if($product->second_image)
                                    <img id="second-image-preview" src="{{ asset('storage/' . $product->second_image) }}" alt="Second Image Preview" class="img-fluid rounded" style="width: 100px; height: 100px;">
                                @else
                                    <img id="second-image-preview" src="#" alt="Second Image Preview" class="img-fluid rounded d-none" style="width: 100px; height: 100px;">
                                @endif
                            </div>
                            @error('second_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="third_image" class="form-label">Third Image</label>
                            <input type="file" class="form-control @error('third_image') is-invalid @enderror" id="third_image" name="third_image" accept="image/*">
                            <div class="mt-2">
                                @if($product->third_image)
                                    <img id="third-image-preview" src="{{ asset('storage/' . $product->third_image) }}" alt="Third Image Preview" class="img-fluid rounded" style="width: 100px; height: 100px;">
                                @else
                                    <img id="third-image-preview" src="#" alt="Third Image Preview" class="img-fluid rounded d-none" style="width: 100px; height: 100px;">
                                @endif
                            </div>
                            @error('third_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>In Stock</option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function readURL(input, imageId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(imageId).classList.remove('d-none');
                document.getElementById(imageId).setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('thumbnail').addEventListener('change', function() {
        readURL(this, 'thumbnail-preview');
    });

    document.getElementById('first_image').addEventListener('change', function() {
        readURL(this, 'first-image-preview');
    });

    document.getElementById('second_image').addEventListener('change', function() {
        readURL(this, 'second-image-preview');
    });

    document.getElementById('third_image').addEventListener('change', function() {
        readURL(this, 'third-image-preview');
    });
</script>
@endpush
@endsection 