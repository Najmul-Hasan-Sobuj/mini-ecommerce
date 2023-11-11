<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $couponId = $this->route('coupon'); // Accessing the coupon ID from the route parameter, if applicable.

        return [
            'code' => 'required|string|max:50|unique:coupons,code,' . $couponId,
            'type' => 'required|in:fixed,percentage',
            'max_uses' => 'required|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'status' => 'required|in:active,expired,used',
            'description' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.required' => 'The coupon code is required.',
            'code.max' => 'The coupon code may not be greater than 50 characters.',
            'code.unique' => 'This coupon code has already been taken.',
            'type.required' => 'You must select a coupon type.',
            'type.in' => 'The selected coupon type is invalid.',
            'max_uses.required' => 'The maximum uses field is required.',
            'max_uses.integer' => 'The maximum uses must be an integer.',
            'max_uses.min' => 'The maximum uses must be at least 1.',
            'valid_from.date' => 'The valid from date is not a valid date.',
            'valid_until.date' => 'The valid until date is not a valid date.',
            'valid_until.after_or_equal' => 'The valid until date must be a date after or equal to valid from date.',
            'status.required' => 'The status is required.',
            'status.in' => 'The selected status is invalid.',
            'description.required' => 'The description is required.',
            'description.max' => 'The description may not be greater than 255 characters.',
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'code' => 'coupon code',
            'type' => 'coupon type',
            'max_uses' => 'maximum uses',
            'valid_from' => 'valid from date',
            'valid_until' => 'valid until date',
            'status' => 'status',
            'description' => 'description',
        ];
    }
}
