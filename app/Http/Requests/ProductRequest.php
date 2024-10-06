<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($this->route('product'))],
            'description' => ['required'],
            'shipping_returns'=>['required'],
            'price' => ['required'],
            'compare_price' => ['nullable'],
            'category' => ['required', 'numeric'],
            'sub_category' => ['sometimes', 'numeric'],
            'brand' => ['required', 'numeric'],
            'featured' => ['required'],
            'track_qty' => ['nullable'],
            'qty' => ['required'],
            'status' => ['required', 'in:0,1'],
            'image' => $this->getMethod() == 'POST' ? ['required', 'image'] : ['nullable', 'sometimes', 'image'],
            'images' => $this->getMethod() == 'POST' ? ['required'] : ['nullable'],
            // 'images.*' => 'array|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'max_item_add_to_cart' => 'nullable',
        ];
    }
}
