<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskManagementAPIController;

// login for api access
Route::post('login', [TaskManagementAPIController::class, 'login']);

// API for task
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskManagementAPIController::class, 'index']);        // Retrieve all tasks
    Route::post('/tasks', [TaskManagementAPIController::class, 'store']);       // Create a task
    Route::post('/tasks/{id}', [TaskManagementAPIController::class, 'update']);  // Update a task
    Route::delete('/tasks/{id}', [TaskManagementAPIController::class, 'destroy']); // Delete a task
    Route::post('logout', [TaskManagementAPIController::class, 'logout']); // Logout 
});
