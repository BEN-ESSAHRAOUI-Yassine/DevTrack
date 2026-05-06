<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('viewAny', [Task::class, $project]);

        $tasks = $project->tasks()
            ->with('assignedUser')
            ->latest()
            ->get();

        return view('projects.Dashboard', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        $this->authorize('create', [Task::class, $project]);

        $developers = $project->users()
            //->wherePivot('role', 'developer')
            ->orderBy('name')
            ->get();

        return view('Tasks.create', compact('project', 'developers'));
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        $project->tasks()->create($request->validated());

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task created.');
    }

    public function edit(Project $project, Task $task)
    {
        $this->authorize('update', $task);

        $developers = $project->users()
            //->wherePivot('role', 'developer')
            ->orderBy('name')
            ->get();

        return view('Tasks.edit', compact('project', 'task', 'developers'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validated());

        return redirect()
            ->route('projects.dashboard', $project)
            ->with('success', 'Task updated.');
    }

    public function updateStatus(UpdateTaskStatusRequest $request, Project $project, Task $task)
    {
        $this->authorize('updateStatus', $task);

        $current = $task->status;
        $next = $request->validated('status');

        $allowed = [
            'todo' => ['in_progress'],
            'in_progress' => ['done'],
            'done' => [],
        ];

        if (!in_array($next, $allowed[$current], true)) {
            return back()->withErrors(['status' => 'Invalid status transition.']);
        }

        $task->update(['status' => $next]);

        return redirect()
            ->route('projects.dashboard', $project)
            ->with('success', 'Task status updated.');
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task deleted.');
    }
}
