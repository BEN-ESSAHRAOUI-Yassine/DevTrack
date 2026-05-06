<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;

class ProjectTaskApiController extends Controller
{
    public function index(Project $project)
    {
        // Only project members can access tasks.
        $this->authorize('viewAny', [Task::class, $project]);

        $tasks = $project->tasks()
            ->with('assignedUser') // Avoid N+1 queries.
            ->latest()
            ->get();

        return TaskResource::collection($tasks);
    }
}
