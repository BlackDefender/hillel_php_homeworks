<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/users/{id}/todos', 'HomeController@userTodos')->name('userTodos');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/todos', 'TodoController@addTodo')->name('addTodo');
Route::put('/todos/{id}/status', 'TodoController@changeStatus')->name('changeTodoStatus');
Route::delete('/todos/{id}/delete', 'TodoController@deleteTodo')->name('deleteTodo');