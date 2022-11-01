<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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

Route::get('/get_tasks', [TasksController::class, 'get_tasks']);
Route::get('/get_sub_tasks', [TasksController::class, 'get_sub_tasks']);


Route::get('/create_task', [TasksController::class, 'create_task']);
Route::get('/create_sub_task', [TasksController::class, 'create_sub_task']);

Route::get('/update_task', [TasksController::class, 'update_task']);
Route::get('/update_sub_task', [TasksController::class, 'update_sub_task']);

Route::get('/delete_task', [TasksController::class, 'delete_task']);
Route::get('/delete_sub_task', [TasksController::class, 'delete_sub_task']);
Route::get('/delete_scheduler', [TasksController::class, 'delete_scheduler']);

