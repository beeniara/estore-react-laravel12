<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $colors = Color::latest()->paginate(10);
        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request): RedirectResponse
    {
        Color::create($request->validated());
        return redirect()->route('admin.colors.index')
                         ->with('success', 'Color added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color): View
    {
        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $color): RedirectResponse
    {
        $color->update($request->validated());
        return redirect()->route('admin.colors.index')
                         ->with('success', 'Color updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color): RedirectResponse
    {
        $color->delete();
        return redirect()->route('admin.colors.index')
                         ->with('success', 'Color deleted successfully.');
    }
}
