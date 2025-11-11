<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // ✅ Allow request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string|max:5000',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    /**
     * Custom validation messages (optional)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.unique' => 'This product name already exists.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category does not exist.',
            'price.required' => 'Please enter the product price.',
            'price.numeric' => 'Price must be a valid number.',
            'stock.required' => 'Please enter stock quantity.',
            'images.required' => 'Please upload at least one product image.',
            'images.min' => 'You must upload at least one image.',
            'images.*.image' => 'Each file must be a valid image.',
        ];
    }
}
