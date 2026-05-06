<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        // return $this->user()->can('update', $this->route('task'));
        return true;
    }

    public function rules(): array
    {
        $task = $this->route('task');

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date'],
            'priority' => ['required', Rule::in(Task::PRIORITIES)],
            'status' => ['required', Rule::in(Task::STATUSES)],
            'assigned_to' => [
                'required',
                'integer',
                Rule::exists('project_user', 'user_id')->where(
                    fn ($q) => $q->where('project_id', $task->project_id)
                ),
            ],
        ];
    }
}
