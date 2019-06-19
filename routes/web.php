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

use App\Todo;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * Get the ACTIVE todo tasks.
 */
Route::get('/', function () {
    // code to fetch todo tasks
    // $todo = new Todo;
    // $result = $todo->all();
    // return  $result;

    // 透過 sql 設定條件
    // $todo = new Todo();
    // $result = $todo->where('status', '=', 'ACTIVE')->get();
    // return $result;

    // 設定一次顯示的筆數
    $todo = new Todo();
    $result = $todo
                ->where('status', '=', 'ACTIVE')
                ->orderby('created_at', 'DESC')
                ->forPage(1, 10) // 參數1: 頁碼`; 參數2: 每頁顯示項目數量
                ->get();
    // return $result;

    return view('home', ['todos' => $result]);
});

/**
 * Get the ACTIVE todo tasks for a given page.
 */
Route::get('/todo/active/{page?}', function ($page = 1) {
    // code to fetch todo tasks on page = $page
    $todo = new Todo();
    $result = $todo
                ->where('status', '=', 'ACTIVE')
                ->forpage($page, 10)
                ->get();
    // return $result;
    return view('active', ['todos' => $result, 'page' => $page]);

});

/**
 * Get the DONE todo tasks for a given page.
 */
Route::get('/todo/done/{page?}', function($page = 1){
    // code to fetch the todo tasks on page = $page
    $todo = new Todo();
    $result = $todo
                ->where('status', '=', 'DONE')
                ->forpage($page, 10)
                ->get();
    // return $result;
    return view('done', ['todos' => $result, 'page' => $page]);
});

/**
 * Get the DELETED todo tasks for a given page.
 */
Route::get('/todo/delete/{page?}', function($page = 1){
    // code to fetch the todo tasks on page = $page
    $todo = new Todo();
    $result = $todo
                ->where('status', '=', 'DELETED')
                ->forpage($page, 10)
                ->get();
    // return $result;
    return view('delete', ['todos' => $result, 'page' => $page]);
});

/**
 * Get a specific todo task by id.
 */
Route::get('todo/{id}', 'TodoController@getTodoById');

/**
 * Create a new todo task.
 */
Route::post('/todo', function (Request $request) {
    // code to create new todo task
    // validate
    $validator = Validator::make($request->all(), [
        'todo-title' => 'required|max:100',
        'todo-description' => 'required|max:5000',
    ]);
    
    
    // if error
    if ($validator->fails()) {
        return 'Error in submitted data.';
    }

    // now create new todo
    $todo = new Todo();

    if (isset($request['todo-title'])) {
        $todo->title = $request['todo-title'];
    }
    if (isset($request['todo-description'])) {
        $todo->description = $request['todo-description'];
    }

    // new save
    $todo->save();

    // redirect to home
    return redirect('/');
});

/**
 * Update a specific todo task by id.
 */
Route::put('/todo/{id}', 'TodoController@updateTodoById');

/**
 * Delete a specific todo task by id.
 */
Route::delete('/todo/{id}', 'TodoController@deleteTodoById');
