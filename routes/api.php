<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\ProjectTaskApiController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/projects/{project}/tasks', [ProjectTaskApiController::class, 'index'])
        ->name('api.projects.tasks.index');
    Route::get('/projects', [ProjectApiController::class, 'index'])
        ->name('api.projects.index');
});
