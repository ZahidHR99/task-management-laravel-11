<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskManagementController;

// cache clean artisan
Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('storage:link');
    $exitCode = Artisan::call('config:cache');

    return 'Clean';
    // return what you want
});

// home page
Route::get('/', [TaskManagementController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Controller
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // edit your profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // update your profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // delete your account

    // Task management Controller
    Route::get('/dashboard', [TaskManagementController::class, 'index'])->name('dashboard'); // Retrieve all tasks
    Route::get('/create-task', [TaskManagementController::class, 'create'])->name('task.create'); // Create a task
    Route::post('/store-task', [TaskManagementController::class, 'store'])->name('task.store'); // Store a new task
    Route::get('/edit-task/{id}', [TaskManagementController::class, 'edit'])->name('task.edit'); // Edit a task
    Route::post('/update-task/{id}', [TaskManagementController::class, 'update'])->name('update.task');  // Update a task
    Route::delete('/delete-task/{id}', [TaskManagementController::class, 'destroy'])->name('task.delete'); // Delete a task
    Route::get('/tasks', [TaskManagementController::class, 'filterTask'])->name('tasks.index'); // Filter priority or status wise task
});

require __DIR__.'/auth.php';
