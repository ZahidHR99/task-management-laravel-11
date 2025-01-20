<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_retrieves_tasks_for_authenticated_user()
    {
        // Create a user
        $user = User::factory()->create();

        // Create tasks for the user
        Task::factory()->count(3)->create(['user_id' => $user->id]);

        // Act as the user and hit the endpoint
        $response = $this->actingAs($user, 'sanctum')->getJson('/api/tasks');

        // Assert successful response and correct task count
        $response->assertStatus(200)
                 ->assertJsonCount(3, 'tasks');
    }

    /** @test */
    public function it_returns_unauthorized_for_requests_without_token()
    {
        // Hit the endpoint without authentication
        $response = $this->getJson('/api/tasks');

        // Assert unauthorized response
        $response->assertStatus(401)
                 ->assertJson(['message' => 'Unauthenticated.']);
    }
}

