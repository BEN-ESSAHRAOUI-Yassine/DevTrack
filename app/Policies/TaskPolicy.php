<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user, Project $project): bool
    {
        return $this->isMember($user, $project);
    }

    public function view(User $user, Task $task): bool
    {
        return $this->isMember($user, $task->project);
    }

    public function create(User $user, Project $project): bool
    {
        return $this->isLead($user, $project);
    }

    public function update(User $user, Task $task): bool
    {
        return $this->isLead($user, $task->project);
    }

    public function delete(User $user, Task $task): bool
    {
        return $this->isLead($user, $task->project);
    }

    public function updateStatus(User $user, Task $task): bool
    {
        return $task->assigned_to === $user->id
            && $this->isMember($user, $task->project);
    }

    private function isMember(User $user, Project $project): bool
    {
        return $project->users()->whereKey($user->id)->exists();
    }

    private function isLead(User $user, Project $project): bool
    {
        return $project->users()
            ->whereKey($user->id)
            ->wherePivot('role', 'lead')
            ->exists();
    }
}
