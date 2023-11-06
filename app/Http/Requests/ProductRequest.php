<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $productId = $this->product;

        return [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id', // Add validation for brand_id
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Image validation
            'sku' => "nullable|string|max:255|unique:products,sku,{$productId}",
            'description' => 'required|string',
            'price' => 'required|numeric|between:0,999999.99',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|enum:products,status',
            'sizes' => 'nullable|json', // Add validation for sizes
            'colors' => 'nullable|json', // Add validation for colors
            'tags' => 'nullable|json', // Add validation for tags
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
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
            'category_id.required' => 'The Category ID field is required.',
            'category_id.exists' => 'The specified Category ID does not exist.',
            'brand_id.required' => 'The Brand ID field is required.',
            'brand_id.exists' => 'The specified Brand ID does not exist.',
            'name.required' => 'The Name field is required.',
            'name.string' => 'The Name must be a string.',
            'name.max' => 'The Name may not be greater than 255 characters.',
            'image.required' => 'The Image field is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
            'sku.string' => 'The SKU must be a string.',
            'sku.max' => 'The SKU may not be greater than 255 characters.',
            'sku.unique' => 'The SKU has already been taken.',
            'description.required' => 'The Description field is required.',
            'description.string' => 'The Description must be a string.',
            'price.required' => 'The Price field is required.',
            'price.numeric' => 'The Price must be a numeric value.',
            'price.between' => 'The Price must be between 0 and 999999.99.',
            'quantity.required' => 'The Quantity field is required.',
            'quantity.integer' => 'The Quantity must be an integer.',
            'quantity.min' => 'The Quantity must be at least 0.',
            'status.required' => 'The Status field is required.',
            'status.enum' => 'The Status field has an invalid value.',
            'sizes.json' => 'The Sizes must be a valid JSON string.',
            'colors.json' => 'The Colors must be a valid JSON string.',
            'tags.json' => 'The Tags must be a valid JSON string.',
            'created_by.exists' => 'The specified Created By ID does not exist.',
            'updated_by.exists' => 'The specified Updated By ID does not exist.',
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
