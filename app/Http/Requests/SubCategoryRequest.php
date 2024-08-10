<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryRequest extends FormRequest
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
            'name'=>['required','string','max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories', 'slug')->ignore($this->route('subcategory')),
            ],
            'status' => ['required', 'in:0,1'],
            'category_id'=>['required','integer']
        ];
    }
}
