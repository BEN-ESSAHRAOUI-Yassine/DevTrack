<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    // Check membership
    public function view(User $user, Project $project): bool
    {
        return $project->users->contains($user);
    }

    // Only lead can update
    public function update(User $user, Project $project): bool
    {
        return $project->users()
            ->where('user_id', $user->id)
            ->wherePivot('role', 'lead')
            ->exists();
    }

    public function delete(User $user, Project $project): bool
    {
        return $this->update($user, $project);
    }

    public function archive(User $user, Project $project): bool
    {
        return $this->update($user, $project);
    }

    public function restore(User $user, Project $project): bool
    {
        return $this->update($user, $project);
    }

    public function forceDelete(User $user, Project $project): bool
    {
        return $this->update($user, $project);
    }

    public function manageMembers(User $user, Project $project): bool
    {
        return $this->update($user, $project);
    }
}