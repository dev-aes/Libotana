<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
        return match($this->method()) {
            
            'POST' => [
                'category_id' => ['required'],
                'name' => ['required', 'unique:vehicles,name'],
                'routes' => ['required'],
            ],
            'PUT' => [
                'category_id' => ['required'],
                'name' => ['required', \Illuminate\Validation\Rule::unique('vehicles')->ignore($this->vehicle)],
                'routes' => ['required'],

            ],
        };
    }

    public function messages()
    {
        return [
            'name.required' => 'The model name field is required.',
            'category_id.required' => 'The category field is required.',
            'featured_photo.required' => 'Please upload a featured photo.',
            'name.unique' => 'The name already existing.',
        ];
    }
}