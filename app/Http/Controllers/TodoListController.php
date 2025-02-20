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
    public function show(TodoList $list)
    {
       // $list = TodoList::findOrFail($id);
        return response($list);
    }

    public function store(Request $request)
    {
        $request->validate([ 'name' => 'required']);
        $user = User::create([ 'name'=>'ahmed','email'=>'ahmed', 'password'=>'ahmed']);
        $list = TodoList::create([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);
        return $list;
        //return response($list,Response::HTTP_CREATED);
    }

    public function destroy(TodoList $list){
        $list->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }
    public function update(Request $request, TodoList $list)
    {
        $request->validate([ 'name' => 'required']);
        $list->update($request->all());
        return $list;
        //return new TodoListResource($todo_list);
    }
}
