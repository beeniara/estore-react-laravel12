<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'color_id' => 'required|array',
            'color_id.*' => 'exists:colors,id',
            'size_id' => 'required|array',
            'size_id.*' => 'exists:sizes,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'third_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name may not be greater than 255 characters.',
            'description.required' => 'The product description is required.',
            'description.string' => 'The product description must be a string.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a number.',
            'price.min' => 'The product price must be at least 0.',
            'stock.required' => 'The product stock is required.',
            'stock.integer' => 'The product stock must be an integer.',
            'stock.min' => 'The product stock must be at least 0.',
            'color_id.required' => 'At least one color must be selected.',
            'color_id.array' => 'The colors must be an array.',
            'color_id.*.exists' => 'One or more selected colors are invalid.',
            'size_id.required' => 'At least one size must be selected.',
            'size_id.array' => 'The sizes must be an array.',
            'size_id.*.exists' => 'One or more selected sizes are invalid.',
            'thumbnail.required' => 'The thumbnail image is required.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'The thumbnail may not be greater than 2MB.',
            'first_image.image' => 'The first image must be an image.',
            'first_image.mimes' => 'The first image must be a file of type: jpeg, png, jpg, gif.',
            'first_image.max' => 'The first image may not be greater than 2MB.',
            'second_image.image' => 'The second image must be an image.',
            'second_image.mimes' => 'The second image must be a file of type: jpeg, png, jpg, gif.',
            'second_image.max' => 'The second image may not be greater than 2MB.',
            'third_image.image' => 'The third image must be an image.',
            'third_image.mimes' => 'The third image must be a file of type: jpeg, png, jpg, gif.',
            'third_image.max' => 'The third image may not be greater than 2MB.',
        ];
    }
}
