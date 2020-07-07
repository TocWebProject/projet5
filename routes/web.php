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

// TODO
Route::get('/todo-list', function () {
    if(Auth::user()){
        return view('todo');
    }
    else{
        return view('auth.login');
    }
})->name('todo-list');

Route::get('/todo', 'TasksController@index')->name('todo');

// CRUD Users for Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('is_admin')->group(function() {
    Route::resource('users', 'UsersController');
}); 