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
            'payment_method_id' => 'required|exists:payment_methods,id',
            'order_date' => 'required|date',
            'shipped_date' => 'nullable|date|after_or_equal:order_date',
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,return',
            'subtotal' => 'required|numeric|between:0,999999.99',
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
            //
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

    // /**
    //  * Handle a failed validation attempt.
    //  *
    //  * @param  \Illuminate\Contracts\Validation\Validator  $validator
    //  * @return void
    //  */
    // protected function failedValidation(Validator $validator)
    // {
    //     $this->recordErrorMessages($validator);
    //     parent::failedValidation($validator);
    // }

    // /**
    //  * Record the error messages displayed to the user.
    //  *
    //  * @param  \Illuminate\Contracts\Validation\Validator  $validator
    //  * @return void
    //  */
    // protected function recordErrorMessages(Validator $validator)
    // {
    //     $errorMessages = $validator->errors()->all();

    //     foreach ($errorMessages as $errorMessage) {
    //         toastr()->error($errorMessage);
    //     }
    // }
}
