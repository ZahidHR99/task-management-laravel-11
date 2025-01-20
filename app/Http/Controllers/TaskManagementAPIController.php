<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskManagementAPIController extends Controller
{
    // Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'email' => 'required|string',
             'password' => 'required|string',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid Email'], 201);
        }
 
        $user = User::where('email', $request->email)->first();
 
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 201);
        }
 
        try {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token
             ], 200);
         } catch (\Exception $e) {
             return response()->json(['error' => $e->getMessage()], 500);
         }
    }

    // logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    // Fetch all tasks belonging to the authenticated user
    public function index()
    {
        $user = auth()->user();
 
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401); // 401 Unauthorized
        }

        // Retrieve tasks belonging to the authenticated user
        $tasks = Task::where('user_id', $user->id)->get();

        return response()->json([
            'message' => 'Tasks retrieved successfully',
            'tasks' => $tasks
        ], 200); // 200 OK
    }

    // Create a new task
    public function store(Request $request)
    {
        $user = auth()->user();
  
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401); // 401 Unauthorized
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:Low,Medium,High',
            'status' => 'nullable|boolean',
        ]);

        $validated['user_id'] = $user->id;

        $task = Task::create($validated);
        return response()->json(['message' => 'Task created successfully!', 'task' => $task], 200);
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $user = auth()->user();
  
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401); // 401 Unauthorized
        }

        $task = Task::where('id', $id)->where('user_id', $user->id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found or unauthorized'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
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
        $user = auth()->user();
  
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401); // 401 Unauthorized
        }

        $task = Task::where('id', $id)->where('user_id', $user->id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found or unauthorized'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully!'], 200);
    }
}
