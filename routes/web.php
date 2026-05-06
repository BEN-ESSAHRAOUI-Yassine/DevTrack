<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('projects.index');
})->name('dashboard');

Route::get('/dashboard', function () {
    return redirect()->route('projects.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Projects
    Route::get('/projects/{project}/dashboard', [ProjectController::class, 'Dashboard'])
        ->name('projects.dashboard');
    Route::get('/projects/archived', [ProjectController::class, 'archived'])
        ->name('projects.archived');

    Route::get('/projects/mine', [ProjectController::class, 'mine'])
        ->name('projects.mine');

    Route::resource('projects', ProjectController::class);

    Route::get('/projects/{project}/archive', [ProjectController::class, 'destroy'])
        ->name('projects.archive');

    Route::post('/projects/{project}/restore', [ProjectController::class, 'restore'])
        ->name('projects.restore');

    Route::delete('/projects/{project}/force-delete', [ProjectController::class, 'forceDelete'])
        ->name('projects.forceDelete');

    Route::post('/projects/{project}/members', [ProjectController::class, 'addMember'])
        ->name('projects.members.add');

    Route::delete('/projects/{project}/members/{user}', [ProjectController::class, 'removeMember'])
        ->name('projects.members.remove');

    // Tasks
    Route::scopeBindings()->group(function () {
        Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
        Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])->name('projects.tasks.create');
        Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
        Route::get('/projects/{project}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('projects.tasks.edit');
        Route::put('/projects/{project}/tasks/{task}', [TaskController::class, 'update'])->name('projects.tasks.update');
        Route::patch('/projects/{project}/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('projects.tasks.updateStatus');
        Route::delete('/projects/{project}/tasks/{task}', [TaskController::class, 'destroy'])->name('projects.tasks.destroy');
    });
});

require __DIR__.'/auth.php';
