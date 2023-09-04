<?php

namespace App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserTechnologyRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'technology_id' => ['required', 'array'],
            'technology_id.*' => ['required', 'integer', 'exists:technologies,id'],
            'experience' => ['required', 'array'],
            'experience.*' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            'technology_id.required' => 'The technology field is required',
            'experience.required' => 'The experience field is required',
            'technology_id.*.required' => 'The technology field is required',
            'experience.*.required' => 'The experience field is required'
        ];
    }
}
