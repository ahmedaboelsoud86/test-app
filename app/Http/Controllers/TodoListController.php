<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Http\Resources\TodoListResource;
use App\Models\TodoList;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{

    public function index()
    {
        $list = TodoList::all();
        return response($list);
    }
    public function show(TodoList $todo_list)
    {
       // $list = TodoList::findOrFail($id);
        return response($todo_list);
    }

    public function store(TodoListRequest $request)
    {
        $user = User::create([ 'name'=>'ahmed','email'=>'hhh', 'password'=>'ahmed']);
        $list = TodoList::create([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);
        return $list;
        //return response($list,Response::HTTP_CREATED);
    }

    public function destroy(TodoList $todo_list){
        $todo_list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
    public function update(TodoListRequest $request, TodoList $todo_list)
    {
        $todo_list->update($request->all());
        return $todo_list;
        //return new TodoListResource($todo_list);
    }
}
