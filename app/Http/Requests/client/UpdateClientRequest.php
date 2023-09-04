<?php

namespace App\Http\Requests\client;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'client_type_id' => ['required', 'integer', 'exists:client_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'email' => ['required', 'email'],
            'mobile' => ['required', 'integer', 'digits:10'],
            'linkedin' => ['nullable'],
            'skype' => ['nullable'],
            'slack' => ['nullable'],
            'company_name' => ['nullable', 'string', 'required_if:client_type_id,1'],
            'company_country' => ['nullable', 'string', 'required_if:client_type_id,1'],
            'company_state' => ['nullable', 'string', 'required_if:client_type_id,1'],
            'business_since' => ['nullable', 'date', 'required_if:client_type_id,1'],
            // 'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'company_name.required_if' => 'The company name field is required',
            'company_country.required_if' => 'The company country field is required',
            'company_state.required_if' => 'The company state field is required',
            'business_since.required_if' => 'The businees since field is required',
        ];
    }
}
