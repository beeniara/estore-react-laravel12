<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'quantity',
        'price',
        'description',
        'thumbnail',
        'first_image',
        'second_image',
        'third_image',
        'status',
    ];

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class);
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)
                    ->with('user')
                    ->where('approved', true)
                    ->latest();
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
