<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Project::with('users')->get()->each(function (Project $project): void {
            $developers = $project->users->filter(
                fn ($user) => $user->pivot->role === 'developer'
            );

            if ($developers->isEmpty()) {
                return;
            }

            Task::factory(rand(4, 8))->create([
                'project_id' => $project->id,
                'assigned_to' => $developers->random()->id,
            ]);
        });
    }
}
