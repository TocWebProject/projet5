<?php

use Illuminate\Support\Facades\Route;

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

// HOME
Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

// TODO-LIST View.
Route::get ('/todo-list',function () {
    return view('todo');
})->name('todo-list')->middleware('auth');

// TODO-LIST Request.
Route::get('/todo/{searchQ?}', 'TasksController@index')->name('todo');
Route::post('/todo', 'TasksController@store')->name('todo');
Route::get('/tasks/modify/{id}', 'TasksController@edit');
Route::patch('/tasks/modify/{id}', 'TasksController@update');
Route::delete('/tasks/{id}', 'TasksController@destroy');

// Calendar View & Request
Route::get ('/calendar',function () {
    return view('calendar');
})->name('calendar')->middleware('auth');

// CRUD Users for Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('is_admin')->group(function() {
    Route::resource('users', 'UsersController');
}); 