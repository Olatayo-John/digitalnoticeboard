<?php

namespace App\Http\Requests\project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'priority' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'members' => ['required', 'array'],
            'members.*' => ['required', 'integer', 'exists:users,id'],
            'start_date' => ['required', 'date'],
            'due_date' => ['required', 'date','after_or_equal:start_date'],
            'objective' => ['nullable', 'string'],
            'url' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'credentials' => ['nullable', 'string'],
        ];
    }
}
