<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirect root to admin login if guest, or dashboard if logged in
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.index');
    }
    return redirect()->route('admin.login');
});

// Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        // Color Resource Routes
        Route::resource('colors', ColorController::class)->except(['show']);
        
        // Size Resource Routes
        Route::resource('sizes', SizeController::class)->except(['show']);
        
        // Product Resource Routes
        Route::resource('products', ProductController::class);
    });
});
