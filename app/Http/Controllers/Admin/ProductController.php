<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['colors', 'sizes'])->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.create', compact('colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        
        // Generate slug
        $data['slug'] = Str::slug($request->name);
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }
        
        // Handle additional images
        if ($request->hasFile('first_image')) {
            $data['first_image'] = $request->file('first_image')->store('products/images', 'public');
        }
        
        if ($request->hasFile('second_image')) {
            $data['second_image'] = $request->file('second_image')->store('products/images', 'public');
        }
        
        if ($request->hasFile('third_image')) {
            $data['third_image'] = $request->file('third_image')->store('products/images', 'public');
        }

        // Create product
        $product = Product::create($data);

        // Attach colors and sizes
        $product->colors()->attach($request->color_id);
        $product->sizes()->attach($request->size_id);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.edit', compact('product', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        
        // Update slug if name changed
        if ($request->name !== $product->name) {
            $data['slug'] = Str::slug($request->name);
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }

        // Handle additional images
        if ($request->hasFile('first_image')) {
            // Delete old first image
            if ($product->first_image) {
                Storage::disk('public')->delete($product->first_image);
            }
            $data['first_image'] = $request->file('first_image')->store('products/images', 'public');
        }

        if ($request->hasFile('second_image')) {
            // Delete old second image
            if ($product->second_image) {
                Storage::disk('public')->delete($product->second_image);
            }
            $data['second_image'] = $request->file('second_image')->store('products/images', 'public');
        }

        if ($request->hasFile('third_image')) {
            // Delete old third image
            if ($product->third_image) {
                Storage::disk('public')->delete($product->third_image);
            }
            $data['third_image'] = $request->file('third_image')->store('products/images', 'public');
        }

        // Update product
        $product->update($data);

        // Sync colors and sizes
        $product->colors()->sync($request->color_id);
        $product->sizes()->sync($request->size_id);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete all associated images
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        if ($product->first_image) {
            Storage::disk('public')->delete($product->first_image);
        }
        if ($product->second_image) {
            Storage::disk('public')->delete($product->second_image);
        }
        if ($product->third_image) {
            Storage::disk('public')->delete($product->third_image);
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
