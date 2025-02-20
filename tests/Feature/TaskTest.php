<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{

    use RefreshDatabase;
    public function test_fetch_all_Tasks_of_todo_list(): void
    {
        $task = Task::factory()->create();
        $response = $this->getJson(route('task.index'))->assertOk()->json();
        $this->assertEquals(1,count($response));
        $this->assertEquals($task->title,$response[0]['title']);
    }

    public function test_task_for_todo_list(): void
    {
        $task = Task::factory()->create();
        $response = $this->postJson(route('task.store',['title'=>$task->title]))->assertCreated()->json();

        $this->assertDatabaseHas('tasks',['title'=>$task->title]);
        //$this->assertEquals($task->title,$response[0]['title']);
    }
}

