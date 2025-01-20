<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskManagementController;

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

// Route::get('/', function () {
//     return view('auth.register');
// });

Route::get('/', [TaskManagementController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Task management Controller
    Route::get('/dashboard', [TaskManagementController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::post('/store-task', [TaskManagementController::class, 'store'])->name('task.store');
    Route::get('/create-task', [TaskManagementController::class, 'create'])->name('task.create');
    Route::get('/edit-task/{id}', [TaskManagementController::class, 'edit'])->name('task.edit');
    Route::post('/update-task/{id}', [TaskManagementController::class, 'update'])->name('update.task');
    Route::delete('/delete-task/{id}', [TaskManagementController::class, 'destroy'])->name('task.delete');
    
});

require __DIR__.'/auth.php';
