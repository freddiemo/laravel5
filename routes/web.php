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

/**
 * Show Task Dashboard
 */
Route::get('/', function () {
    $tasks = \App\Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * Add New Task
 */
Route::post('/task', 'TaskController@store');

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (\App\Task $task){
    $task->delete();

    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
