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
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'sku' => "required|string|max:255|unique:products,sku,{$productId}",
            'description' => 'required|string',
            'price' => 'required|numeric|between:1,999999.99',
            'quantity' => 'required|integer|min:1|max:10000',
            'status' => 'required|in:active,inactive',
            'sizes' => 'required|array',
            'colors' => 'required|array',
            'tags' => 'required|array',
            'product_attachments.*.images' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
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
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'brand_id.required' => 'The brand field is required.',
            'brand_id.exists' => 'The selected brand is invalid.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'image.sometimes' => 'The image field is optional.',
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.',
            'sku.nullable' => 'The sku field is optional.',
            'sku.string' => 'The sku must be a string.',
            'sku.max' => 'The sku may not be greater than 255 characters.',
            'sku.unique' => 'The sku has already been taken.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.between' => 'The price must be between 1 and 999999.99.',
            'quantity.required' => 'The quantity field is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 1.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status field must be either active or inactive.',
            'sizes.nullable' => 'The sizes field is optional.',
            'sizes.array' => 'The sizes must be an array.',
            'colors.nullable' => 'The colors field is optional.',
            'colors.array' => 'The colors must be an array.',
            'tags.nullable' => 'The tags field is optional.',
            'tags.array' => 'The tags must be an array.',
            'product_attachments.*.images.sometimes' => 'The product attachments images field is optional.',
            'product_attachments.*.images.image' => 'The product attachments images must be an image.',
            'product_attachments.*.images.mimes' => 'The product attachments images must be a file of type: jpeg, png, jpg.',
            'product_attachments.*.images.max' => 'The product attachments images may not be greater than 2048 kilobytes.',
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
            'category_id' => 'category',
            'brand_id' => 'brand',
            'name' => 'name',
            'image' => 'image',
            'sku' => 'sku',
            'description' => 'description',
            'price' => 'price',
            'quantity' => 'quantity',
            'status' => 'status',
            'sizes' => 'sizes',
            'colors' => 'colors',
            'tags' => 'tags',
            'product_attachments.*.images' => 'product attachments images',
        ];
    }
}
