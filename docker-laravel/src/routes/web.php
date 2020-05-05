<?php

use Illuminate\Support\Facades\Route;
use Laravel\Dusk\Http\Controllers\UserController;

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
    // return view('welcome');
    return view('top');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// resouce(query, controller) will declare index, create, store, show, edit, update, destory methodes to controller
Route::resource('User', 'UserController');

Route::resource('Post', 'PostController');

