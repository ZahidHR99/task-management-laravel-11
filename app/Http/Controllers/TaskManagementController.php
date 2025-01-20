<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::id()) {
            $user_id = Auth::id(); // Get the authenticated user ID

            $tasks = Task::where('user_id', $user_id)->orderBy('id', 'desc') // Order by id in descending order
                 ->paginate(10); // Paginate results with 10 per page

            return view('pages.tasks.index', compact('tasks'));
        }else{
            return abort(403, 'Unauthorized access to this task');
        }
    }

    /**
     * Filter task using priority or status.
     */
    public function filterTask(Request $request)
    {
        if (Auth::id()) {
            // Get filter parameters
            $priority = $request->get('priority');
            $status = $request->get('status');
            $user_id = Auth::id(); // Get the authenticated user ID
        
            // Query the tasks based on filters and user ownership
            $tasks = Task::where('user_id', $user_id); // Ensure tasks belong to the authenticated user
        
            if ($priority) {
                $tasks->where('priority', $priority);
            }
        
            if ($status !== null) { // Check for both '0' and '1'
                $tasks->where('status', $status);
            }
        
            // Paginate results with 10 per page
            $tasks = $tasks->paginate(10);
        
            return view('pages.tasks.index', compact('tasks'));
        } else {
            return abort(403, 'Unauthorized access to this task');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tasks.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::id()) {
            try {
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'priority' => 'nullable|in:Low,Medium,High',
                    'status' => 'nullable|boolean',
                ]);

                $user_id = Auth::id(); // Get the authenticated user ID

                // Merge the user_id into the validated data
                $taskData = array_merge($validated, ['user_id' => $user_id]);

                Task::create($taskData);
                
                return redirect()->route('dashboard')->with('success', 'Task created successfully!');

            } catch (\Exception $e) {
                // If an exception occurs, return an error message
                return back()->with('error', 'Task create failed!  ' . $e->getMessage());
            }

        }else{
            return abort(403, 'Unauthorized access to this task');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if (Auth::id()) {
            $user_id = Auth::id(); // Get the authenticated user ID
        
            $task = Task::find($request->id);
        
            if (!$task) {
                return redirect()->route('dashboard')->with('error', 'Task not found!');
            }
        
            // Check if the task belongs to the authenticated user
            if ($task->user_id !== $user_id) {
                return abort(403, 'Unauthorized access to this task');
            }
        
            return view('pages.tasks.add', compact('task'));
        } else {
            return abort(403, 'Unauthorized access to this task');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::id()) {
            try {
                $validated = $request->validate([
                    'title' => 'sometimes|required|string|max:255',
                    'description' => 'nullable|string',
                    'priority' => 'sometimes|required|in:Low,Medium,High',
                    'status' => 'sometimes|required|boolean',
                ]);
        
                $user_id = Auth::id(); // Get the authenticated user ID
                
                $task = Task::find($request->id);
        
                if (!$task) {
                    return back()->with('error', 'Task not found!');
                }
        
                // Ensure the authenticated user is authorized to update the task
                if ($task->user_id !== $user_id) {
                    return abort(403, 'Unauthorized access to this task');
                }
        
                // Merge the validated data with user_id
                $taskData = array_merge($validated, ['user_id' => $user_id]);
        
                $task->update($taskData);
        
                return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
            } catch (\Exception $e) {
                // If an exception occurs, return an error message
                return back()->with('error', 'Task update failed! ' . $e->getMessage());
            }
        } else {
            return abort(403, 'Unauthorized access to this task');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Auth::id()) {
            $data = Task::find($request->id);
        
            if (!$data) {
                return redirect()->route('dashboard')->with('error', 'Task not found!');
            }
        
            $user_id = Auth::id(); // Get the authenticated user ID
        
            // Check if the task belongs to the authenticated user
            if ($data->user_id !== $user_id) {
                return abort(403, 'Unauthorized access to this task');
            }
        
            try {
                $data->delete();
                return redirect()->route('dashboard')->with('success', 'Task Deleted Successfully');
            } catch (\Exception $e) {
                return redirect()->route('dashboard')->with('error', 'Task Delete failed!: ' . $e->getMessage());
            }
        } else {
            return abort(403, 'Unauthorized access to this task');
        }
        
    }
}
