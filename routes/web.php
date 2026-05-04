<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::middleware(['auth'])->group(function () {

    // Projects
    Route::resource('projects', ProjectController::class);

    Route::get('/projects/{project}/archive', [ProjectController::class, 'archive'])
        ->name('projects.archive');

    Route::get('/projects/{project}/restore', [ProjectController::class, 'restore'])
        ->name('projects.restore');

    Route::delete('/projects/{project}/force-delete', [ProjectController::class, 'forceDelete'])
        ->name('projects.forceDelete');

    Route::post('/projects/{project}/members', [ProjectController::class, 'addMember'])
        ->name('projects.members.add');

    Route::delete('/projects/{project}/members/{user}', [ProjectController::class, 'removeMember'])
        ->name('projects.members.remove');

    // Tasks
    
});

require __DIR__.'/auth.php';