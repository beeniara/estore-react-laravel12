@extends('admin.layouts.app')

@section('title', 'Manage Sizes')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Sizes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.sizes.create') }}" class="btn btn-sm btn-primary">
                <i class="fa-solid fa-plus"></i> Add New Size
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
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sizes as $index => $size)
                            <tr>
                                <td>{{ $sizes->firstItem() + $index }}</td>
                                <td>{{ $size->name }}</td>
                                <td>
                                    <a href="{{ route('admin.sizes.edit', $size->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteItem({{ $size->id }})">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    <form id="delete-form-{{ $size->id }}" action="{{ route('admin.sizes.destroy', $size->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No sizes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             {{-- Pagination Links --}}
            <div class="mt-3">
                {{ $sizes->links() }}
            </div>
        </div>
    </div>

@endsection 