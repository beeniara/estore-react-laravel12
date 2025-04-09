<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\CouponController;
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
Route::prefix('admin')->name('admin.')->group(function () {
    // Login Routes (Guest Only)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login');
        Route::post('/auth', [AdminController::class, 'auth'])->name('auth');
    });

    // Authenticated Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Color Resource Routes
        Route::resource('colors', ColorController::class)->except(['show']);

        // Size Resource Routes
        Route::resource('sizes', SizeController::class)->except(['show']);

        // Coupon Resource Routes
        Route::resource('coupons', CouponController::class)->except(['show']);
    });
});
