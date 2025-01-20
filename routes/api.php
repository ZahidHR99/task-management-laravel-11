<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TaskManagementAPIController;

Route::apiResource('tasks', TaskManagementAPIController::class);


// API for tasks 
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/tasks', [TaskManagementAPIController::class, 'index']);        // Retrieve all tasks
//     Route::post('/tasks', [TaskManagementAPIController::class, 'store']);       // Create a task
//     Route::put('/tasks/{id}', [TaskManagementAPIController::class, 'update']);  // Update a task
//     Route::delete('/tasks/{id}', [TaskManagementAPIController::class, 'destroy']); // Delete a task
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



