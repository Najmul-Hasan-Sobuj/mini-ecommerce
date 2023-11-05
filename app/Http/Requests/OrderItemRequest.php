<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends FormRequest
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
        return [
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'product_name' => 'required|string|max:255',
            'product_sku' => 'required|string|max:255',
            'quantity' => 'nullable|integer|min:0',
            'unit_price' => 'required|numeric|between:0,999999.99',
            'total_price' => 'required|numeric|between:0,999999.99',
            'special_instructions' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'order_id.required' => 'The order ID field is required.',
            'order_id.exists' => 'The specified order ID does not exist.',
            'product_id.required' => 'The product ID field is required.',
            'product_id.exists' => 'The specified product ID does not exist.',
            'product_name.required' => 'The product name field is required.',
            'product_name.string' => 'The product name must be a string.',
            'product_name.max' => 'The product name may not be greater than 255 characters.',
            'product_sku.required' => 'The product SKU field is required.',
            'product_sku.string' => 'The product SKU must be a string.',
            'product_sku.max' => 'The product SKU may not be greater than 255 characters.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 0.',
            'unit_price.required' => 'The unit price field is required.',
            'unit_price.numeric' => 'The unit price must be a numeric value.',
            'unit_price.between' => 'The unit price must be between 0 and 999999.99.',
            'total_price.required' => 'The total price field is required.',
            'total_price.numeric' => 'The total price must be a numeric value.',
            'total_price.between' => 'The total price must be between 0 and 999999.99.',
            'special_instructions.string' => 'The special instructions must be a string.',
        ];
    }

    /**
     * Get custom attributes for validator errors. ### -----not working
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $this->recordErrorMessages($validator);
        parent::failedValidation($validator);
    }

    /**
     * Record the error messages displayed to the user.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function recordErrorMessages(Validator $validator)
    {
        $errorMessages = $validator->errors()->all();

        foreach ($errorMessages as $errorMessage) {
            toastr()->error($errorMessage);
        }
    }
}
