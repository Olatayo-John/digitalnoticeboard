<?php

namespace App\Http\Requests\task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'assigned_to' => ['required', 'integer', 'exists:users,id'],
            'assigned_by' => ['required', 'integer', 'exists:users,id'],
            'status' => ['required', 'integer'],
            'priority' => ['required', 'integer'],
            'start_date_time' => ['required', 'date'],
            'end_date_time' => ['required', 'date', 'after_or_equal:start_date_time'],
            'description' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'billable' => ['nullable', 'boolean'],
            'file' => ['nullable', 'array'],
            'file.*' => ['required', 'mimes:jpg,jpeg,png,doc,docx,xls,xlsx,pdf,txt', 'max:2048'],
            'created_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
