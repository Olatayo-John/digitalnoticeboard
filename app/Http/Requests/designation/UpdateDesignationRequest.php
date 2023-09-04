<?php

namespace App\Http\Requests\designation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDesignationRequest extends FormRequest
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
            'id'=>['required', 'integer', 'exists:designations,id'],
            'name' => ['required', 'string'],
            // 'reporting_manager' => ['required', 'integer', 'exists:users,id'],
            'status' => ['required', 'boolean'],
        ];
    }
}
