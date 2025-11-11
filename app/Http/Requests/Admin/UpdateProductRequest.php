<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($this->route('product')), // ✅ fixed
            ],
            'description' => ['nullable', 'string', 'max:5000'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'status' => ['boolean'],
            'images' => ['nullable', 'array'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'remove_images' => ['array'],
            'remove_images.*' => ['integer', 'exists:product_images,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.unique' => 'Product name is required.', // unified message
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category does not exist.',
            'price.required' => 'Please enter the product price.',
            'price.numeric' => 'Price must be a valid number.',
            'stock.required' => 'Please enter stock quantity.',
            'stock.integer' => 'Stock must be an integer value.',
            'images.*.image' => 'Each uploaded file must be a valid image.',
            'images.*.mimes' => 'Images must be in jpeg, png, jpg, or webp format.',
            'images.*.max' => 'Each image must not exceed 2MB.',
            'remove_images.*.exists' => 'One or more images you are trying to remove do not exist.',
        ];
    }
}
