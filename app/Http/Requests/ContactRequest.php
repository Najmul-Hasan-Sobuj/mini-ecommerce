<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'email' => 'required|email|max:191',
            'msg' => 'required|string|min:10|max:500',
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
            'email.required' => 'The :attribute field is required.',
            'email.email' => 'Please enter a valid :attribute.',
            'email.max' => 'The :attribute must not be greater than 191 characters.',
            'msg.required' => 'The :attribute field is required.',
            'msg.string' => 'The :attribute must be text.'
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
            'email' => 'email address',
            'msg' => 'message'
        ];
    }

    //     /**
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
