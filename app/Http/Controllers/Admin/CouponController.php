<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request): RedirectResponse
    {
        Coupon::create($request->validated());
        return redirect()->route('admin.coupons.index')
                         ->with('success', 'Coupon added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon): View
    {
        $coupon->valid_until_formatted = Carbon::parse($coupon->valid_until)->format('Y-m-d\TH:i');
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon): RedirectResponse
    {
        $coupon->update($request->validated());
        return redirect()->route('admin.coupons.index')
                         ->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')
                         ->with('success', 'Coupon deleted successfully.');
    }
}
