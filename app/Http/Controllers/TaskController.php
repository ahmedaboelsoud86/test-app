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
            'title' => $request->title
        ]);
        return response($task,201);
    }

}
