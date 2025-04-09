@extends('admin.layouts.app')

@section('title', 'Manage Colors')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Colors</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.colors.create') }}" class="btn btn-sm btn-primary">
                <i class="fa-solid fa-plus"></i> Add New Color
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
                <table class="table table-striped table-sm data-table"> {{-- Added data-table class --}}
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($colors as $index => $color)
                            <tr>
                                {{-- Use pagination item number --}}
                                <td>{{ $colors->firstItem() + $index }}</td>
                                <td>{{ $color->name }}</td>
                                <td>
                                    <a href="{{ route('admin.colors.edit', $color->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteItem({{ $color->id }})">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    <form id="delete-form-{{ $color->id }}" action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No colors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             {{-- Pagination Links --}}
            <div class="mt-3">
                {{ $colors->links() }}
            </div>
        </div>
    </div>

@endsection 