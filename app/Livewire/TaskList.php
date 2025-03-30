<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Validate;

class TaskList extends Component
{
    /**
     * The new task description.
     */
    #[Validate('required|string')]
    public string $description = '';

    /**
     * The collection of tasks.
     */
    public Collection|array $tasks = [];

    /**
     * Mount the component and load the tasks.
     */
    public function mount(): void
    {
        $this->loadTasks();
    }

    /**
     * Load all tasks ordered by creation date.
     */
    private function loadTasks(): void
    {
        try {
            $this->tasks = Task::orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            Log::error('Failed to retrieve tasks: ' . $e->getMessage());
            $this->dispatch('notify', type: 'error', message: 'Could not load tasks.');
        }
    }

    /**
     * Create a new task.
     */
    public function createTask(): void
    {
        $this->validate();

        try {
            Task::create([
                'description' => $this->description
            ]);

            $this->description = '';
            $this->loadTasks();

            $this->dispatch('notify', type: 'success', message: 'Task created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create task: ' . $e->getMessage());
            $this->dispatch('notify', type: 'error', message: 'Failed to create task. Please try again.');
        }
    }

    /**
     * Toggle the completion status of a task.
     */
    public function toggleComplete($taskId): void
    {
        try {
            $task = Task::findOrFail($taskId);
            $task->completed = !$task->completed;
            $task->save();

            $this->loadTasks();

            $status = $task->completed ? 'completed' : 'reopened';
            $this->dispatch('notify', type: 'success', message: "Task {$status} successfully!");
        } catch (\Exception $e) {
            Log::error("Failed to update task status for task ID {$taskId}: " . $e->getMessage());
            $this->dispatch('notify', type: 'error', message: 'Failed to update task status. Please try again.');
        }
    }

    /**
     * Delete a task.
     */
    public function deleteTask($taskId): void
    {
        try {
            $task = Task::findOrFail($taskId);
            $task->delete();

            $this->loadTasks();

            $this->dispatch('notify', type: 'success', message: 'Task deleted successfully!');
        } catch (\Exception $e) {
            Log::error("Failed to delete task ID {$taskId}: " . $e->getMessage());
            $this->dispatch('notify', type: 'error', message: 'Failed to delete task. Please try again.');
        }
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.to-do-list');
    }
}
