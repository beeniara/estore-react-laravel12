<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
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
} 