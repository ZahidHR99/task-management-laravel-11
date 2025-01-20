<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskUnitTest extends TestCase
{
    /** @test */
    public function it_creates_a_task_with_valid_data()
    {
        $user = User::factory()->create();

        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'priority' => 'Medium',
            'status' => true,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'user_id' => $user->id,
        ]);
    }
}
