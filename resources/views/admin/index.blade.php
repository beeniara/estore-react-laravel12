@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        {{-- Optional: Add buttons or controls here --}}
        {{-- <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button"
                class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi">
                    <use xlink:href="#calendar3" />
                </svg>
                This week
            </button>
        </div> --}}
    </div>

    {{-- Order Summary Cards --}}
    <div class="row">
        {{-- Today's Orders --}}
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <strong>Today's Orders</strong>
                    <span class="badge bg-dark rounded-pill">{{ $todayOrders }}</span>
                </div>
                <div class="card-footer text-center bg-white">
                    {{-- Placeholder for total amount or link --}}
                    <small>Total: ${{-- Calculate Today's Total --}} 0.00</small>
                </div>
            </div>
        </div>

        {{-- Yesterday's Orders --}}
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <strong>Yesterday's Orders</strong>
                    <span class="badge bg-primary rounded-pill">{{ $yesterdayOrders }}</span>
                </div>
                <div class="card-footer text-center bg-white">
                    <small>Total: ${{-- Calculate Yesterday's Total --}} 0.00</small>
                </div>
            </div>
        </div>

        {{-- This Month's Orders --}}
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <strong>This Month's Orders</strong>
                    <span class="badge bg-danger rounded-pill">{{ $monthOrders }}</span>
                </div>
                <div class="card-footer text-center bg-white">
                     <small>Total: ${{-- Calculate Month's Total --}} 0.00</small>
                </div>
            </div>
        </div>

        {{-- This Year's Orders --}}
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <strong>This Year's Orders</strong>
                    <span class="badge bg-success rounded-pill">{{ $yearOrders }}</span>
                </div>
                <div class="card-footer text-center bg-white">
                     <small>Total: ${{-- Calculate Year's Total --}} 0.00</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Placeholder for future charts or tables --}}
    {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

    {{-- <h2>Section title</h2>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                    <th scope="col">Header</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    <td>random</td>
                    <td>data</td>
                    <td>placeholder</td>
                    <td>text</td>
                </tr>
                <tr>
                    <td>1,002</td>
                    <td>placeholder</td>
                    <td>irrelevant</td>
                    <td>visual</td>
                    <td>layout</td>
                </tr>
            </tbody>
        </table>
    </div> --}}
@endsection

{{-- @push('scripts')
    // Add page-specific scripts here if needed
    // Example: <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"></script>
@endpush --}} 