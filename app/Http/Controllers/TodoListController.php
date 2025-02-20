<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Http\Resources\TodoListResource;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{

    public function index()
    {
        $list = TodoList::all();
        return response($list);
    }
    public function show(TodoList $todolist)
    {
       // $list = TodoList::findOrFail($id);
        return response($todolist);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $user = User::create([
            'name' => 'ahmed',
            'email' => 'ahmed',
            'password' => 'ahmed',
        ]);
        $list = TodoList::create([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);
        return $list;
        //return response($list,Response::HTTP_CREATED);
    }
}
