<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function addTodo(Request $request)
    {
        Todo::create(['description' => $request->description, 'user_id'=>Auth::user()->id]);
        return redirect('/home');
    }

    public function changeStatus($id)
    {
        $todo = Todo::find($id);
        $todo->status = !$todo->status;
        $todo->save();
        return redirect('/home');
    }

    public function deleteTodo($id)
    {
        Todo::destroy($id);
        return redirect('/home');
    }
}
