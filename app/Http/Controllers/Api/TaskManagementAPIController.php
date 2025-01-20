<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskManagementAPIController extends Controller
{
    // Fetch all tasks belonging to the authenticated user
    public function index()
    {
        dd('dd');
        $tasks = Task::where('user_id', Auth::id())->paginate(10);
        return response()->json($tasks, 200);
    }

    // Create a new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:Low,Medium,High',
            'status' => 'nullable|boolean',
        ]);

        $validated['user_id'] = Auth::id();

        $task = Task::create($validated);
        return response()->json(['message' => 'Task created successfully!', 'task' => $task], 201);
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found or unauthorized'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:Low,Medium,High',
            'status' => 'nullable|boolean',
        ]);

        $task->update($validated);
        return response()->json(['message' => 'Task updated successfully!', 'task' => $task], 200);
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found or unauthorized'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully!'], 200);
    }
}
