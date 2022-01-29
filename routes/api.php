<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('task1', 'App\Http\Controllers\TasksController@task1');
Route::get('task2', 'App\Http\Controllers\TasksController@task2');
Route::get('task3', 'App\Http\Controllers\TasksController@task3');
Route::get('task4', 'App\Http\Controllers\TasksController@task4');
Route::get('userinfo', 'App\Http\Controllers\TasksController@getUserData');