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

Route::get('/', 'WeatherController@index')->name('index');
Route::post('/weather/today', 'WeatherController@today')->name('weatherToday');
Route::post('/weather/5days', 'WeatherController@fiveDays')->name('weatherFiveDays');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
