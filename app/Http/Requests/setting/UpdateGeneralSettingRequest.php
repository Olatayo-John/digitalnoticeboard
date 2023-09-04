<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSettingRequest extends FormRequest
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
            'site_name' => ['required', 'string'],
            'site_keywords' => ['required', 'string'],
            'site_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'about_us' => ['required', 'string'],
            'terms_condition' => ['required', 'string'],
            'privacy_policy' => ['required', 'string']
        ];
    }
}
