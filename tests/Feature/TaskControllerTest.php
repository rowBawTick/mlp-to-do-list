<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test task creation with valid data.
     */
    public function test_can_create_task_with_valid_data(): void
    {
        $taskData = [
            'description' => 'Test task description',
        ];

        $response = $this->post(route('tasks.store'), $taskData);

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Task created successfully!');
        $this->assertDatabaseHas('tasks', $taskData);
    }

    /**
     * Test task creation with invalid data.
     */
    public function test_cannot_create_task_with_invalid_data(): void
    {
        $response = $this->post(route('tasks.store'), [
            'description' => '',
        ]);

        $response->assertSessionHasErrors('description');
        $this->assertDatabaseMissing('tasks', ['description' => '']);
    }

    /**
     * Test toggling task completion status.
     */
    public function test_can_toggle_task_completion(): void
    {
        // Create a task that is not completed
        $task = Task::factory()->create(['completed' => false]);

        // Toggle the task to completed
        $response = $this->patch(route('tasks.toggle', $task));

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Task status updated!');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true,
        ]);

        // Toggle the task back to not completed
        $response = $this->patch(route('tasks.toggle', $task->fresh()));

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Task status updated!');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => false,
        ]);
    }

    /**
     * Test toggling a non-existent task.
     */
    public function test_cannot_toggle_nonexistent_task(): void
    {
        $nonExistentTaskId = 999;

        $response = $this->patch(route('tasks.toggle', $nonExistentTaskId));

        $response->assertStatus(404);
    }

    /**
     * Test task deletion.
     */
    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Task deleted successfully!');
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /**
     * Test deleting a non-existent task.
     */
    public function test_cannot_delete_nonexistent_task(): void
    {
        $nonExistentTaskId = 999;

        $response = $this->delete(route('tasks.destroy', $nonExistentTaskId));

        $response->assertStatus(404);
    }
}
