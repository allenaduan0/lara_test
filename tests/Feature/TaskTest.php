<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function it_can_create_a_task(){
        $response = $this->postJson('/tasks', ['title' => 'New Task']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', ['title' => 'New Task']);
    }

    public function it_can_list_tasks(){
        Task::factory()->count(2)->create();

        $response = $this->getJson('/tasks');

        $response->assertStatus(200)->assertJsonCount(2);
    }
}