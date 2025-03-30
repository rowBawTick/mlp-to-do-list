<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index(): View
    {
        try {
            $tasks = Task::orderBy('created_at', 'desc')->get();
            return view('tasks', compact('tasks'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve tasks: ' . $e->getMessage());
            return view('tasks', ['tasks' => collect()])->with('error', 'Could not load tasks.');
        }
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        try {
            Task::create($validated);
            return redirect('/')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create task: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to create task. Please try again.');
        }
    }

    /**
     * Update the specified task's completion status.
     */
    public function toggleComplete(Task $task): RedirectResponse
    {
        try {
            $task->update([
                'completed' => !$task->completed
            ]);
            return redirect('/')->with('success', 'Task status updated!');
        } catch (\Exception $e) {
            Log::error("Failed to update task status for task ID {$task->id}: " . $e->getMessage());
            return back()->with('error', 'Failed to update task status. Please try again.');
        }
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        try {
            $task->delete();
            return redirect('/')->with('success', 'Task deleted successfully!');
        } catch (\Exception $e) {
            Log::error("Failed to delete task ID {$task->id}: " . $e->getMessage());
            return back()->with('error', 'Failed to delete task. Please try again.');
        }
    }
}
