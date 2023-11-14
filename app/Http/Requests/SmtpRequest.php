<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SmtpRequest extends FormRequest
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
            'host' => 'required|string|max:255',
            'port' => 'required|string|max:255',
            'encryption' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'from_address' => 'required|string|email|max:255',
            'from_name' => 'required|string|max:255',
            'sender_email' => 'required|string|email|max:255',
            'sender_name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
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
            'host.required' => 'The host field is required.',
            'host.string' => 'The host must be a string.',
            'host.max' => 'The host may not be greater than 255 characters.',
            'port.required' => 'The port field is required.',
            'port.string' => 'The port must be a string.',
            'port.max' => 'The port may not be greater than 255 characters.',
            'encryption.required' => 'The encryption field is required.',
            'encryption.string' => 'The encryption must be a string.',
            'encryption.max' => 'The encryption may not be greater than 255 characters.',
            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a string.',
            'username.max' => 'The username may not be greater than 255 characters.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.max' => 'The password may not be greater than 255 characters.',
            'from_address.required' => 'The from address field is required.',
            'from_address.string' => 'The from address must be a string.',
            'from_address.email' => 'The from address must be a valid email address.',
            'from_address.max' => 'The from address may not be greater than 255 characters.',
            'from_name.required' => 'The from name field is required.',
            'from_name.string' => 'The from name must be a string.',
            'from_name.max' => 'The from name may not be greater than 255 characters.',
            'sender_email.required' => 'The sender email field is required.',
            'sender_email.string' => 'The sender email must be a string.',
            'sender_email.email' => 'The sender email must be a valid email address.',
            'sender_email.max' => 'The sender email may not be greater than 255 characters.',
            'sender_name.required' => 'The sender name field is required.',
            'sender_name.string' => 'The sender name must be a string.',
            'sender_name.max' => 'The sender name may not be greater than 255 characters.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
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
            'host' => 'SMTP host',
            'port' => 'SMTP port',
            'encryption' => 'encryption method',
            'username' => 'username',
            'password' => 'password',
            'from_address' => 'from address',
            'from_name' => 'from name',
            'sender_email' => 'sender email',
            'sender_name' => 'sender name',
            'status' => 'status',
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
