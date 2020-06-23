<?php

declare(strict_types=1);

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
  // return view('welcome');
  return view('top');
});
Route::get('/welcome', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// resouce(query, controller) will declare index, create, store, show, edit, update, destory methodes to controller
Route::resource('user', 'UserController', ['except' => ['create', 'store', 'destroy']]);

Route::delete('/user/{id}', 'UserController@unable')->name('user.unable');

Route::resource('post', 'PostController');

Route::post('/post/review/{post}', 'ReviewController@store')->name('review.store');

Route::get('/search', 'SearchController@index')->name('search');

Route::post('like/{post}', 'LikeController@ajaxstore')->name('like.post');

Route::get('changepassword', 'UserController@show_change_password_form');

Route::post('changepassword', 'UserController@change_password')->name('changepassword');

// Route::get('like', function(){
//     return 'ok';
// });
