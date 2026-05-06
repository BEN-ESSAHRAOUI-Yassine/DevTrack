<?php

use App\Http\Controllers\Api\ProjectTaskApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/projects/{project}/tasks', [ProjectTaskApiController::class, 'index'])
        ->name('api.projects.tasks.index');
});
