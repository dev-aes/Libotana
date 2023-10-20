<?php

namespace App\Http\Requests\Destination;

use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
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
        return match ($this->method()) {

            'POST' => [
                'title' => ['required', 'unique:destinations,title'],
                'address' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'history' => ['required'],
                'featured_photo' => ['required'],
            ],
            'PUT' => [
                'title' => ['required', \Illuminate\Validation\Rule::unique('destinations')->ignore($this->destination)],
                'address' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'history' => ['required'],
                'featured_photo' => ['sometimes'],
            ]
        };
    }

    public function messages()
    {
        return [
            'title.unique' => 'The title already existing.',
            'featured_photo.required' => 'Please upload atleast one featured photo', 
        ];
    }
}