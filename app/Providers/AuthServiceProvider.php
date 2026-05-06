<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Project;
use App\Models\Task;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}