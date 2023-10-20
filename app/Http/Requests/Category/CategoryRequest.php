<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

    public function rules()
    {
        return match($this->method()) {
            'POST' => [
                'name' => ['required', 'unique:categories,name'],
            ],
            'PUT' => [
                'name' => ['required', \Illuminate\Validation\Rule::unique('categories')->ignore($this->category)],
            ],
        };
    }

    public function messages()
    {
        return [
            'name.unique' => 'Category has already been exist'
        ];
    }
}
