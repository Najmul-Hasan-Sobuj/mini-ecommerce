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
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
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
