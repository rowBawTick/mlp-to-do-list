<?php

namespace App\Livewire;

use Usernotnull\Toast\Concerns\WireToast;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Validate;

class TaskList extends Component
{
    use WireToast;

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
            toast()->danger('Could not load tasks.')->push();
        }
    }

    /**
     * Create a new task.
     */
    public function createTask(): void
    {
        $this->validate();

        try {
            $task = Task::create([
                'description' => $this->description
            ]);

            $this->description = '';
            // Add the new task to the beginning of the collection
            $this->tasks->prepend($task);

            toast()->success('Task created successfully!')->push();
        } catch (\Exception $e) {
            Log::error('Failed to create task: ' . $e->getMessage());
            toast()->danger('Failed to create task. Please try again.')->push();
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

            // Update the task in the collection
            $this->tasks = $this->tasks->map(function ($item) use ($task) {
                return $item->id === $task->id ? $task : $item;
            });
        } catch (\Exception $e) {
            Log::error("Failed to update task status for task ID {$taskId}: " . $e->getMessage());
            toast()->danger('Failed to update task status. Please try again.')->push();
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

            // Remove the task from the collection
            $this->tasks = $this->tasks->filter(function ($item) use ($taskId) {
                return $item->id !== $taskId;
            });

            toast()->success('Task deleted successfully!')->push();
        } catch (\Exception $e) {
            Log::error("Failed to delete task ID {$taskId}: " . $e->getMessage());
            toast()->danger('Failed to delete task. Please try again.')->push();
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
