<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Http\Resources\TodoListResource;
use App\Models\Task;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $task = Task::all();
        return response($task);
    }

    public function store(Request $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'todo_list_id' => $request->todo_list_id,
        ]);
        return response($task,201);
    }
    public function destroy(Task $task)
    {
        $task->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

}
