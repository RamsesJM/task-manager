<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the user's tasks.
     */
    public function index(Request $request)
    {
        $query = $request->user()->tasks();

        $this->applyFilters($query, $request);

        $tasks = $query->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the dashboard.
     */
    public function dashboard(Request $request)
    {
        $query = $request->user()->tasks();

        $this->applyFilters($query, $request);

        $tasks = $query->latest()->get();

        return view('dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create');
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

        $request->user()->tasks()->create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing a task.
     */
    public function edit(Task $task)
    {
        Gate::authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task.
     */
    public function update(Request $request, Task $task)
    {
        Gate::authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Toggle the completed status of a task.
     */
    public function toggle(Task $task)
    {
        Gate::authorize('update', $task);

        $task->update([
            'completed' => !$task->completed,
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified task.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Task deleted successfully.');
    }

    /**
     * Apply dashboard/task filters.
     */
    private function applyFilters($query, Request $request): void
    {
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'completed') {
                $query->where('completed', true);
            }

            if ($request->status === 'pending') {
                $query->where('completed', false);
            }
        }

        if ($request->filled('priority') && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }
    }
}