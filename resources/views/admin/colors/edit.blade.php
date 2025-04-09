@extends('admin.layouts.app')

@section('title', 'Edit Color')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Color</h1>
         <div class="btn-toolbar mb-2 mb-md-0">
             <a href="{{ route('admin.colors.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fa-solid fa-chevron-left"></i> Back to Colors
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.colors.update', $color->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Color Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="e.g., Red" value="{{ old('name', $color->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Color</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 