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

        return view('pages.home', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:Low,Medium,High',
            'status' => 'nullable|boolean',
        ]);

        try{
            $task = Task::create($validated);
            return response()->json(['message' => 'Task Created Successfully', 'status' => 201]);
        }catch(\Exception $e){
            return response()->json(['message' => 'Task Create fail', 'status' => 202]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'sometimes|required|in:Low,Medium,High',
            'status' => 'sometimes|required|boolean',
        ]);

        $taskManagement->update($validated);
        return response()->json($taskManagement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = Task::find($request->id);
       
        try{
            $data->delete();
            return response()->json(['message' => 'Task Deleted Successfully', 'status' => 201]);
        }catch(\Exception $e){
            return response()->json(['message' => 'Task Delete fail', 'status' => 202]);
        }
    }
}
