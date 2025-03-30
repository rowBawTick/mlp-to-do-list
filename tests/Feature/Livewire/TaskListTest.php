<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TaskList;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TaskListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the component can render.
     */
    public function test_component_can_render(): void
    {
        Livewire::test(TaskList::class)
            ->assertStatus(200);
    }

    /**
     * Test that tasks are loaded when the component is mounted.
     */
    public function test_tasks_are_loaded_on_mount(): void
    {
        // Create some tasks
        $tasks = Task::factory()->count(3)->create();

        Livewire::test(TaskList::class)
            ->assertSeeInOrder([
                $tasks[0]->description,
                $tasks[1]->description,
                $tasks[2]->description,
            ]);
    }

    /**
     * Test that a task can be created.
     */
    public function test_can_create_task(): void
    {
        Livewire::test(TaskList::class)
            ->set('description', 'Test task description')
            ->call('createTask')
            ->assertSet('description', ''); // Input should be cleared

        $this->assertDatabaseHas('tasks', [
            'description' => 'Test task description',
            'completed' => false,
        ]);
    }

    /**
     * Test that task creation validation works.
     */
    public function test_task_validation_works(): void
    {
        Livewire::test(TaskList::class)
            ->set('description', '')
            ->call('createTask')
            ->assertHasErrors(['description' => 'required']);
    }

    /**
     * Test that a task's completion status can be toggled.
     */
    public function test_can_toggle_task_completion(): void
    {
        $task = Task::factory()->create(['completed' => false]);

        Livewire::test(TaskList::class)
            ->call('toggleComplete', $task->id);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true,
        ]);

        // Toggle back to incomplete
        Livewire::test(TaskList::class)
            ->call('toggleComplete', $task->id);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => false,
        ]);
    }

    /**
     * Test that a task can be deleted.
     */
    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create();

        Livewire::test(TaskList::class)
            ->call('deleteTask', $task->id);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
