<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_blelogs_to_todo_list(): void
    {

        $list = $this->createTodoList();
        $task = $this->createTaskList(['todo_list_id' => $list->id]);

       // $this->assertInstanceOf(Collection::class, $list->tasks);
        $this->assertInstanceOf(TodoList::class, $task->todo_list);
    }
}
