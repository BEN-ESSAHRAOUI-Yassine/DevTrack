<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Project::factory(8)->create()->each(function ($project) use ($users) {

            // Assign a lead
            $lead = $users->random();
            $project->users()->attach($lead->id, ['role' => 'lead']);

            // Assign developers
            $developers = $users->where('id', '!=', $lead->id)->random(2);

            foreach ($developers as $dev) {
                $project->users()->attach($dev->id, ['role' => 'developer']);
            }
        });
    }
}