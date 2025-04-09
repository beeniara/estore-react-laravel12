@extends('admin.layouts.app')

@section('title', 'Manage Coupons')

@inject('carbon', 'Carbon\Carbon')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Coupons</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-sm btn-primary">
                <i class="fa-solid fa-plus"></i> Add New Coupon
            </a>
        </div>
    </div>

    {{-- Display Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm data-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Discount (%)</th>
                            <th scope="col">Validity</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coupons as $index => $coupon)
                            <tr>
                                <td>{{ $coupons->firstItem() + $index }}</td>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->discount }}</td>
                                <td>
                                    @if ($coupon->checkIsValid())
                                        <span class="badge bg-success border border-dark p-1 text-white">Valid until {{ $carbon::parse($coupon->valid_until)->diffForHumans() }}</span>
                                    @else
                                        <span class="badge bg-danger border border-dark p-1 text-white">Expired</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteItem({{ $coupon->id }})">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    <form id="delete-form-{{ $coupon->id }}" action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No coupons found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             {{-- Pagination Links --}}
            <div class="mt-3">
                {{ $coupons->links() }}
            </div>
        </div>
    </div>

@endsection 