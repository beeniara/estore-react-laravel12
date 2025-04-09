# API Implementation Documentation

## Overview
This document details the implementation of the Product API endpoints for the e-commerce application. The API provides endpoints for retrieving, filtering, and searching products.

## API Structure

### 1. ProductController (Api/ProductController.php)
The API controller handles all product-related requests with the following methods:

#### Index Method
```php
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
```
- Returns all products with their relationships
- Includes additional data: colors and sizes that have products
- Orders products by latest first

#### Show Method
```php
public function show(Product $product)
{
    return new ProductResource($product->load(['colors', 'sizes', 'reviews']));
}
```
- Returns a single product by slug
- Loads all related data (colors, sizes, reviews)

#### Filter Methods
```php
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
```
- Filters products by color
- Returns products with the specified color
- Includes all related data

```php
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
```
- Filters products by size
- Returns products with the specified size
- Includes all related data

#### Search Method
```php
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
```
- Searches products by name
- Uses LIKE query for partial matches
- Returns matching products with all related data

### 2. ProductResource (Http/Resources/ProductResource.php)
The resource class formats the product data for API responses:

```php
public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'slug' => $this->slug,
        'description' => $this->description,
        'price' => $this->price,
        'stock' => $this->stock,
        'thumbnail' => $this->thumbnail ? asset('storage/' . $this->thumbnail) : null,
        'first_image' => $this->first_image ? asset('storage/' . $this->first_image) : null,
        'second_image' => $this->second_image ? asset('storage/' . $this->second_image) : null,
        'third_image' => $this->third_image ? asset('storage/' . $this->third_image) : null,
        'status' => $this->status,
        'colors' => $this->whenLoaded('colors'),
        'sizes' => $this->whenLoaded('sizes'),
        'reviews' => $this->whenLoaded('reviews'),
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
}
```
- Formats all product data
- Handles image URLs using asset helper
- Conditionally includes relationships when loaded

### 3. API Routes (routes/api.php)
The API routes are defined as follows:

```php
// Product Routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/products/color/{color}', [ProductController::class, 'filterProductsByColor']);
Route::get('/products/size/{size}', [ProductController::class, 'filterProductsBySize']);
Route::get('/products/search', [ProductController::class, 'searchProductsByTerm']);
```

### 4. Authentication Setup
The User model has been updated to support API authentication:

```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // ...
}
```

## API Endpoints

1. **Get All Products**
   - URL: `GET /api/products`
   - Response: List of all products with relationships

2. **Get Product by Slug**
   - URL: `GET /api/products/{product}`
   - Response: Single product with all relationships

3. **Filter Products by Color**
   - URL: `GET /api/products/color/{color}`
   - Response: Products with specified color

4. **Filter Products by Size**
   - URL: `GET /api/products/size/{size}`
   - Response: Products with specified size

5. **Search Products**
   - URL: `GET /api/products/search?term={term}`
   - Response: Products matching search term

## Response Format
All endpoints return data in the following format:
```json
{
    "data": [
        {
            "id": 1,
            "name": "Product Name",
            "slug": "product-name",
            "description": "Product description",
            "price": 99.99,
            "stock": 10,
            "thumbnail": "http://example.com/storage/products/thumbnails/image.jpg",
            "first_image": "http://example.com/storage/products/images/image1.jpg",
            "second_image": "http://example.com/storage/products/images/image2.jpg",
            "third_image": "http://example.com/storage/products/images/image3.jpg",
            "status": true,
            "colors": [...],
            "sizes": [...],
            "reviews": [...],
            "created_at": "2024-03-19T12:00:00.000000Z",
            "updated_at": "2024-03-19T12:00:00.000000Z"
        }
    ],
    "colors": [...],
    "sizes": [...]
}
```

## Next Steps
1. Implement API authentication
2. Add rate limiting
3. Add request validation
4. Implement caching for better performance
5. Add API documentation using tools like Swagger/OpenAPI 