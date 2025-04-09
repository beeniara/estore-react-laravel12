<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assuming admin guard handles authorization via middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $colorId = $this->route('color')->id; // Get color ID from route model binding

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('colors', 'name')->ignore($colorId),
            ]
        ];
    }
}
