<?php

namespace App\Http\Requests\users;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CreatUserRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'gender' => ['nullable', 'string'],
            'dob' => ['nullable', 'date'],
            'blood_group' => ['nullable', 'integer', 'exists:blood_groups,id'],
            'email' => ['required', 'email', 'unique:users,email'],
            'contact_mobile' => ['required', 'integer', 'digits:10'],
            'current_address' => ['nullable', 'string'],
            'permanent_address' => ['nullable', 'string'],
            'emp_code' => ['required', 'unique:users,emp_code'],
            'resume' => ['required', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:2048'],
            'qualification' => ['nullable', 'string'],
            'designation' => ['required', 'integer', 'exists:designations,id'],
            'reporting_manager' => ['required', 'integer', 'exists:users,id'],
            'official_email' => ['nullable', 'email', 'unique:users,official_email'],
            'ctc' => ['nullable', 'integer'],
            'joining_date' => ['nullable', 'date'],
            'leaving_date' => ['nullable', 'date', 'after:joining_date'],
            'fandf_date' => ['nullable', 'date'],
            'personal_linkedin' => ['nullable', 'string'],
            'personal_github' => ['nullable', 'string'],
            'personal_slack' => ['nullable', 'string'],
            'personal_skype' => ['nullable', 'string'],
            'official_linkedin' => ['nullable', 'string'],
            'official_github' => ['nullable', 'string'],
            'official_slack' => ['nullable', 'string'],
            'official_skype' => ['nullable', 'string'],
            'contact_one_name' => ['nullable', 'string'],
            'contact_one_mobile' => ['nullable', 'integer', 'digits:10'],
            'contact_one_relationship' => ['nullable', 'string'],
            'contact_two_name' => ['nullable', 'string'],
            'contact_two_mobile' => ['nullable', 'integer', 'digits:10'],
            'contact_two_relationship' => ['nullable', 'string'],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
