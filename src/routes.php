<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(array('prefix' => 'admin', 'middleware' => ['web']), function()
{
    // main page for the admin section (app/views/admin/dashboard.blade.php)
    Route::get('/', 'Nhiepphong\Backend\Http\Controllers\BackendController@index');
    
    Route::get('/crop_image', 'Nhiepphong\Backend\Http\Controllers\CropImageController@index');
    Route::post('/crop_image', 'Nhiepphong\Backend\Http\Controllers\CropImageController@index');

    Route::get('/login', 'Nhiepphong\Backend\Http\Controllers\AccountController@login');
    Route::post('/login', 'Nhiepphong\Backend\Http\Controllers\AccountController@login');

    Route::get('/logout', 'Nhiepphong\Backend\Http\Controllers\AccountController@logout');

    Route::get("/dashboard", 'Nhiepphong\Backend\Http\Controllers\BackendController@index');

    Route::get("/dashboard", 'Nhiepphong\Backend\Http\Controllers\BackendController@index');

    $menu = DB::table('admin_menu')->where('controller', '!=', 'NULL')->where("is_active", '1')->get();
    foreach ($menu as $dt) 
    {
        Route::get('/'.$dt->model.'/lists', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        Route::get('/'.$dt->model.'/lists/{parent_id}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        Route::get('/'.$dt->model.'/lists/{name}/{sort}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        Route::get('/'.$dt->model.'/lists/{name}/{sort}/{start}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        Route::get('/'.$dt->model.'/lists/{parent_id}/{name}/{sort}/{start}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        
        Route::get('/'.$dt->model.'/add', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@addData']);
        Route::get('/'.$dt->model.'/add/{id}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@addData']);

        Route::get('/'.$dt->model.'/edit/{id}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@editData']);

        Route::get('/'.$dt->model.'/delete/{id}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@deleteData']);

        Route::post('/'.$dt->model.'/lists', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        Route::post('/'.$dt->model.'/lists/{parent_id}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        Route::post('/'.$dt->model.'/lists/{name}/{sort}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        Route::post('/'.$dt->model.'/lists/{name}/{sort}/{start}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        Route::post('/'.$dt->model.'/lists/{parent_id}/{name}/{sort}/{start}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@index']);
        
        Route::post('/'.$dt->model.'/add', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@addData']);
        Route::post('/'.$dt->model.'/add/{id}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@addData']);

        Route::post('/'.$dt->model.'/edit/{id}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@editData']);

        Route::post('/'.$dt->model.'/delete/{id}', ['uses' => 'App\Http\Controllers\Admin\\'.$dt->controller.'@deleteData']);
    }
});