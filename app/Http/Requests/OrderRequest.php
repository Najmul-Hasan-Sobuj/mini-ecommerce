<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'address_id' => 'required|exists:addresses,id',
            'order_date' => 'required|date',
            'shipped_date' => 'nullable|date|after_or_equal:order_date',
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,return',
            'subtotal' => 'required|numeric|between:0,999999.99',
            'tax' => 'required|numeric|between:0,999999.99',
            'shipping_cost' => 'required|numeric|between:0,999999.99',
            'total_price' => 'required|numeric|between:0,999999.99',
            'return_date' => 'nullable|date|after:order_date',
            'return_reason' => 'nullable|string',
            'return_amount' => 'nullable|numeric|between:0,9999999999.99',
            'notes' => 'nullable|string',
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
            'user_id.required' => 'The User ID field is required.',
            'user_id.exists' => 'The specified User ID does not exist.',
            'address_id.required' => 'The Address ID field is required.',
            'address_id.exists' => 'The specified Address ID does not exist.',
            'order_date.required' => 'The Order Date field is required.',
            'order_date.date' => 'The Order Date must be a valid date.',
            'shipped_date.date' => 'The Shipped Date must be a valid date.',
            'shipped_date.after_or_equal' => 'The Shipped Date must be a date after or equal to the Order Date.',
            'status.required' => 'The Status field is required.',
            'status.in' => 'The Status must be either pending, processing, shipped, delivered, cancelled, or return.',
            'subtotal.required' => 'The Subtotal field is required.',
            'subtotal.numeric' => 'The Subtotal must be a numeric value.',
            'subtotal.between' => 'The Subtotal must be between 0 and 999999.99.',
            'tax.required' => 'The Tax field is required.',
            'tax.numeric' => 'The Tax must be a numeric value.',
            'tax.between' => 'The Tax must be between 0 and 999999.99.',
            'shipping_cost.required' => 'The Shipping Cost field is required.',
            'shipping_cost.numeric' => 'The Shipping Cost must be a numeric value.',
            'shipping_cost.between' => 'The Shipping Cost must be between 0 and 999999.99.',
            'total_price.required' => 'The Total Price field is required.',
            'total_price.numeric' => 'The Total Price must be a numeric value.',
            'total_price.between' => 'The Total Price must be between 0 and 999999.99.',
            'return_date.date' => 'The Return Date must be a valid date.',
            'return_date.after' => 'The Return Date must be a date after the Order Date.',
            'return_reason.string' => 'The Return Reason must be a string.',
            'return_amount.numeric' => 'The Return Amount must be a numeric value.',
            'return_amount.between' => 'The Return Amount must be between 0 and 9999999999.99.',
            'notes.string' => 'The Notes must be a string.',
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
