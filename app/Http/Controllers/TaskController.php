<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index(): View
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks', compact('tasks'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request): Application|Redirector|RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'required',
        ]);

        Task::create($validated);

        return redirect('/')->with('success', 'Task created successfully!');
    }

    /**
     * Update the specified task's completion status.
     */
    public function toggleComplete(Task $task): Application|Redirector|RedirectResponse
    {
        $task->update([
            'completed' => !$task->completed
        ]);

        return redirect('/')->with('success', 'Task status updated!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task): Application|Redirector|RedirectResponse
    {
        $task->delete();

        return redirect('/')->with('success', 'Task deleted successfully!');
    }
}
