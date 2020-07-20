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
  return view('top');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// resouce(query, controller) will declare index, create, store, show, edit, update, destory methodes to controller
// Route::resource('user', 'UserController', ['except' => ['create', 'store', 'destroy']]);
Route::get('user/', 'IndexUserController')->name('user.index');

Route::get('user/{user}', 'ShowUserController')->name('user.show');

Route::get('user/{user}/edit', 'EditUserController')->name('user.edit');

Route::match(['put', 'patch'], 'user/{user}', 'UpdateUserController')->name('user.update');

Route::delete('user/{user}', 'DestroyUserController')->name('user.destroy');

Route::get('changepassword', 'ShowChangePasswordController')->name('changepassword.form');

Route::match(['put', 'patch'], 'changepassword/{user}', 'ChangePasswordController')->name('changepassword');

Route::resource('post', 'PostController');

Route::post('post/review/{post}', 'ReviewController@store')->name('review.store');

Route::get('search', 'SearchController@index')->name('search');

Route::post('like/{post}', 'LikeController@ajaxstore')->name('like');

Route::post('post/like/{post}', 'LikeController@ajaxstore')->name('like.post');

Route::post('user/like/{post}', 'LikeController@ajaxstore')->name('like.user');

// Route::get('like', function(){
//     return 'ok';
// });
