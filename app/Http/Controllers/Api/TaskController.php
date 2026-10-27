<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display the authenticated user's tasks.
     */
    public function index(Request $request)
    {
        $tasks = $request->user()
            ->tasks()
            ->latest()
            ->get();

        return response()->json($tasks);
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task = $request->user()
            ->tasks()
            ->create($validated);

        return response()->json($task, 201);
    }

    /**
     * Display the specified task.
     */
    public function show(Request $request, Task $task)
    {
        abort_unless(
            $task->user_id === $request->user()->id,
            403
        );

        return response()->json($task);
    }

    /**
     * Update the specified task.
     */
    public function update(Request $request, Task $task)
    {
        abort_unless(
            $task->user_id === $request->user()->id,
            403
        );

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
            'priority' => 'sometimes|required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    /**
     * Remove the specified task.
     */
    public function destroy(Request $request, Task $task)
    {
        abort_unless(
            $task->user_id === $request->user()->id,
            403
        );

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully.',
        ]);
    }
}