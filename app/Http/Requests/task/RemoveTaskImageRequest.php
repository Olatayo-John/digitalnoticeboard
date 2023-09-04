<?php

namespace App\Http\Requests\task;

use Illuminate\Foundation\Http\FormRequest;

class RemoveTaskImageRequest extends FormRequest
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
            'task_id' => ['required', 'integer', 'exists:tasks,id'],
            'image'=>['required','string']
        ];
    }
}
