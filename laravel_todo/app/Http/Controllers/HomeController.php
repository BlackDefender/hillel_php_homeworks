<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return view('home', ['todos' => $todos]);
    }

    public function userTodos(Request $request)
    {
        //$todos = Todo::user();
        $todos = User::find($request->id)->todos;
        //$todos = Todos::where('user_id', $request->id)->get();
        return view('home', ['todos' => $todos]);
    }
}
