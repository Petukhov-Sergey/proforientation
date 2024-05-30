<?php
use App\Http\Controllers\Editor\AnswerController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Editor\TestController as EditorTestController;
use App\Http\Controllers\Editor\QuestionController;
use App\Http\Controllers\Editor\ResultController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [TestController::class, 'index']);
Route::get('/tests/{test}', [TestController::class, 'show'])->name('tests.show');
Route::get('/tests/{test}/start', [TestController::class, 'start'])->name('tests.start');
Route::post('/tests/{test}/submit', [TestController::class, 'submit'])->name('tests.submit');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
Route::get('/users', 'UserController@index')->name('admin.users.index');
Route::get('/users/create', 'UserController@create')->name('admin.user.create');
Route::get('/users/{user}', 'UserController@show')->name('admin.user.show');
Route::get('/users/{user}/edit', 'UserController@edit')->name('admin.user.edit');
Route::patch('/users/{user}', 'UserController@update')->name('admin.user.update');
Route::delete('/users/{user}', 'UserController@destroy')->name('admin.user.destroy');
Route::post('/users', 'UserController@store')->name('admin.user.store');
});

Route::group(['namespace' => 'App\Http\Controllers\Editor', 'prefix' => 'editor', 'middleware' => 'editor', 'as' => 'editor.'], function () {
Route::resource('tests', EditorTestController::class);
Route::resource('tests.questions', QuestionController::class);
Route::resource('questions.answers', AnswerController::class);
Route::resource('tests.results', ResultController::class);
});
