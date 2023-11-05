<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ShippingAndBillingAddressRequest extends FormRequest
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
            'address_type' => 'required|in:shipping,billing',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
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
            'address_type.required' => 'The Address Type field is required.',
            'address_type.in' => 'The Address Type must be either shipping or billing.',
            'street_address.required' => 'The Street Address field is required.',
            'street_address.string' => 'The Street Address must be a string.',
            'street_address.max' => 'The Street Address may not be greater than 255 characters.',
            'city.required' => 'The City field is required.',
            'city.string' => 'The City must be a string.',
            'city.max' => 'The City may not be greater than 255 characters.',
            'state.required' => 'The State field is required.',
            'state.string' => 'The State must be a string.',
            'state.max' => 'The State may not be greater than 255 characters.',
            'country.required' => 'The Country field is required.',
            'country.string' => 'The Country must be a string.',
            'country.max' => 'The Country may not be greater than 255 characters.',
            'postal_code.required' => 'The Postal Code field is required.',
            'postal_code.string' => 'The Postal Code must be a string.',
            'postal_code.max' => 'The Postal Code may not be greater than 10 characters.',
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
