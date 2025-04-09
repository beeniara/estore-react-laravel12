<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
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
        $couponId = $this->route('coupon')->id;

        return [
             'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('coupons', 'name')->ignore($couponId),
            ],
            'discount' => ['required', 'integer', 'min:0'],
            'valid_until' => ['required', 'date']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'valid_until.required' => 'The coupon validity date is required.',
        ];
    }
}
