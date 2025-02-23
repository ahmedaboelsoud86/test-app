<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\TodoList;

class TaskTest extends TestCase
{

    use RefreshDatabase;

    private $task;
    private $list;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
        $this->list  =  $this->createTodoList();
        $this->task  =  $this->createTaskList(['todo_list_id'=>$this->list['id']]);
    }
    public function test_fetch_all_tasks_of_todo_list(): void
    {
        $response = $this->getJson(route('todo-list.task.index',$this->list['id']))->assertOk()->json();
        $this->assertEquals(1,count($response));
        $this->assertEquals($this->task->title,$response[0]['title']);
    }

    public function test_task_for_todo_list(): void
    {
        $todo_lists =  $this->createTodoList();
        $task = Task::factory(['todo_list_id'=>$todo_lists['id']])->make();
        $response = $this->postJson(route('todo-list.task.store',$this->list['id']),['title'=>$task->title,'todo_list_id'=>$todo_lists['id']])
                        ->assertCreated()
                        ->json();

        $this->assertDatabaseHas('tasks',['title'=>$task->title,'todo_list_id'=>$todo_lists->id]);
        $this->assertEquals($task->title,$response['title']);
    }

    public function test_delete_task(): void
    {
        $this->deleteJson(route('task.destroy',$this->task->id));
        $this->assertDatabaseMissing('tasks',['title'=>$this->task->title]);
    }
}

