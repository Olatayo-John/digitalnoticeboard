<?php

namespace App\Http\Requests\designation;

use Illuminate\Foundation\Http\FormRequest;

class CreateDesignationRequest extends FormRequest
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
            'name'=>['required','string','unique:designations,name'],
            // 'reporting_manager'=>['required','integer','exists:users,id'],
            'status'=>['required','boolean'],
        ];
    }
}
