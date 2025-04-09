@extends('admin.layouts.app')

@section('title', 'Edit Coupon')

@inject('carbon', 'Carbon\Carbon')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Coupon</h1>
         <div class="btn-toolbar mb-2 mb-md-0">
             <a href="{{ route('admin.coupons.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fa-solid fa-chevron-left"></i> Back to Coupons
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.coupons.update', $coupon->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Coupon Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="e.g., SUMMER20" value="{{ old('name', $coupon->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="discount" class="form-label">Discount (%) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="e.g., 10" value="{{ old('discount', $coupon->discount) }}" required min="0">
                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="valid_until" class="form-label">Valid Until <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('valid_until') is-invalid @enderror" id="valid_until" name="valid_until" required
                                   value="{{ old('valid_until', $coupon->valid_until_formatted) }}" >
                             @error('valid_until')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 