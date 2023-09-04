<?php

namespace App\Http\Requests\bloodGroup;

use Illuminate\Foundation\Http\FormRequest;

class CreateBloodGroupRequest extends FormRequest
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
            'name'=>['required','string','unique:blood_groups,name'],
            'status'=>['required','string']
        ];
    }
}
