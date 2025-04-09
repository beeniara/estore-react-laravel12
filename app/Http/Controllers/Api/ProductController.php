<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get all products with their relationships
     */
    public function index()
    {
        $products = Product::with(['colors', 'sizes', 'reviews'])
            ->latest()
            ->get();

        return ProductResource::collection($products)->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
        ]);
    }

    /**
     * Get product by slug
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load(['colors', 'sizes', 'reviews']));
    }

    /**
     * Filter products by color
     */
    public function filterProductsByColor(Color $color)
    {
        $products = $color->products()
            ->with(['colors', 'sizes', 'reviews'])
            ->latest()
            ->get();

        return ProductResource::collection($products)->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
        ]);
    }

    /**
     * Filter products by size
     */
    public function filterProductsBySize(Size $size)
    {
        $products = $size->products()
            ->with(['colors', 'sizes', 'reviews'])
            ->latest()
            ->get();

        return ProductResource::collection($products)->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
        ]);
    }

    /**
     * Search products by term
     */
    public function searchProductsByTerm(Request $request)
    {
        $searchTerm = $request->input('term');
        
        $products = Product::where('name', 'like', "%{$searchTerm}%")
            ->with(['colors', 'sizes', 'reviews'])
            ->latest()
            ->get();

        return ProductResource::collection($products)->additional([
            'colors' => Color::has('products')->get(),
            'sizes' => Size::has('products')->get(),
        ]);
    }
} 