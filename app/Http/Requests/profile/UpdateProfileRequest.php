<?php

namespace App\Http\Requests\profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'mobile' => ['required', 'integer', 'digits:10'],
            'gender' => ['nullable', 'string'],
            'dob' => ['nullable', 'date'],
            'blood_group' => ['nullable', 'integer', 'exists:blood_groups,id'],
            'current_address' => ['nullable', 'string'],
            'permanent_address' => ['nullable', 'string'],
        ];
    }
}
