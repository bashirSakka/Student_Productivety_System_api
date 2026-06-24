<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', $request->user()->id)->get();
        return response()->json($tasks);
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
            'title'        => ['required', 'string'],
            'description'  => ['nullable', 'string'],
            'due_at'       => ['nullable', 'date'],
            'priority'     => ['required', 'in:low,medium,high'],
            'status'       => ['required', 'in:pending,in_progress,completed'],
            'completed_at' => ['nullable', 'date'],
        ]);

        $task = Task::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'        => ['sometimes', 'string'],
            'description'  => ['nullable', 'string'],
            'due_at'       => ['nullable', 'date'],
            'priority'     => ['sometimes', 'in:low,medium,high'],
            'status'       => ['sometimes', 'in:pending,in_progress,completed'],
            'completed_at' => ['nullable', 'date'],
        ]);

        $task->update($validated);

        return response()->json($task->fresh());
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
