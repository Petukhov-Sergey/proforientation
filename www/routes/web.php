<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function () {  //, 'middleware' => 'admin'
        Route::get('/users', 'UserController@index')->name('admin.users.index');
        Route::get('/users/create', 'UserController@create')->name('admin.user.create');
        Route::get('/users/{user}', 'UserController@show')->name('admin.user.show');
        Route::get('/users/{user}/edit', 'UserController@edit')->name('admin.user.edit');
        Route::patch('/users/{user}', 'UserController@update')->name('admin.user.update');
        Route::delete('/users/{user}', 'UserController@destroy')->name('admin.user.destroy');
        Route::post('/users', 'UserController@store')->name('admin.user.store');
});
