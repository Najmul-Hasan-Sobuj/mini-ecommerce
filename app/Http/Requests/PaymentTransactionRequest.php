<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PaymentTransactionRequest extends FormRequest
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
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric|between:0,999999.99',
            'transaction_id' => 'required|string|max:255|unique:payment_transactions,transaction_id',
            'status' => 'required|in:pending,completed,failed,refunded',
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
            'order_id.required' => 'The Order ID field is required.',
            'order_id.exists' => 'The specified Order ID does not exist.',
            'payment_method_id.required' => 'The Payment Method ID field is required.',
            'payment_method_id.exists' => 'The specified Payment Method ID does not exist.',
            'amount.required' => 'The Amount field is required.',
            'amount.numeric' => 'The Amount must be a numeric value.',
            'amount.between' => 'The Amount must be between 0 and 999999.99.',
            'transaction_id.required' => 'The Transaction ID field is required.',
            'transaction_id.string' => 'The Transaction ID must be a string.',
            'transaction_id.max' => 'The Transaction ID may not be greater than 255 characters.',
            'transaction_id.unique' => 'The Transaction ID has already been taken.',
            'status.required' => 'The Status field is required.',
            'status.in' => 'The Status must be either pending, completed, failed, or refunded.',
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
