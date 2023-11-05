<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProductReviewRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'review_text' => 'nullable|string',
            'rating_value' => 'nullable|integer|min:1|max:5',  // Assuming a rating scale of 1-5
            'is_verified' => 'required|in:true,false',
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
            'product_id.required' => 'The Product ID field is required.',
            'product_id.exists' => 'The specified Product ID does not exist.',
            'user_id.required' => 'The User ID field is required.',
            'user_id.exists' => 'The specified User ID does not exist.',
            'review_text.string' => 'The Review Text must be a string.',
            'rating_value.integer' => 'The Rating Value must be an integer.',
            'rating_value.min' => 'The Rating Value must be at least 1.',
            'rating_value.max' => 'The Rating Value may not be greater than 5.',
            'is_verified.required' => 'The Is Verified field is required.',
            'is_verified.in' => 'The Is Verified field must be either true or false.',
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
