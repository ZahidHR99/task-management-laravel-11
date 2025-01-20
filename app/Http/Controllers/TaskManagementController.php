<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


class TaskManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::orderBy('id', 'desc') // Order by id in descending order
                 ->paginate(10); // Paginate results with 10 per page

        return view('pages.tasks.index', compact('tasks'));
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
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'priority' => 'nullable|in:Low,Medium,High',
                'status' => 'nullable|boolean',
            ]);

            Task::create($request->all());
            
            return redirect()->route('dashboard')->with('success', 'Task created successfully!');

        } catch (\Exception $e) {
            // If an exception occurs, return an error message
            return back()->with('error', 'Task create failed!  ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($taskManagement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $task = Task::find($request->id);
        return view('pages.tasks.add', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'priority' => 'sometimes|required|in:Low,Medium,High',
                'status' => 'sometimes|required|boolean',
            ]);

            $task = Task::find($request->id);
            $task->update($validated);

            return redirect()->route('dashboard')->with('success', 'Task updated successfully!');

        } catch (\Exception $e) {
            // If an exception occurs, return an error message
            return back()->with('error', 'Task update failed!  ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Task::find($request->id);
       
        try{
            $data->delete();
            return redirect()->route('dashboard')->with('success', 'Task Deleted Successfully');
        }catch(\Exception $e){
            return redirect()->route('dashboard')->with('error', 'Task Delete fail!: ' . $e->getMessage());
        }
    }
}
