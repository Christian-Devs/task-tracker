<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_can_have_tasks_and_task_status_can_be_updated()
    {
        // 1. Create a project
        $projectResponse = $this->postJson('/api/projects', [
            'name' => 'New Test Project',
        ]);

        $projectResponse->assertStatus(201);

        $projectId = $projectResponse->json('id');

        // 2. Add a task to the project
        $taskResponse = $this->postJson("/api/projects/{$projectId}/tasks", [
            'title' => 'Initial task',
            'description' => 'Set up the project',
            'status' => 'todo',
            'due_date' => '2026-01-20',
        ]);

        $taskResponse->assertStatus(201);

        $taskId = $taskResponse->json('id');

        // 3. Update the task status
        $updateResponse = $this->patchJson("/api/tasks/{$taskId}/status", [
            'status' => 'done',
        ]);

        $updateResponse
            ->assertStatus(200)
            ->assertJson([
                'status' => 'done',
            ]);

        // 4. Fetch the project and confirm the task is updated
        $this->getJson("/api/projects/{$projectId}")
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $taskId,
                'status' => 'done',
            ]);
    }
}
