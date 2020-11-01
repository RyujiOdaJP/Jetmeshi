<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);
// RestoreUser
Route::get('restore', function () {
  return view('auth.restore');
});
Route::post('restore', 'Auth\RestoreUserController')->name('restore');

// User
Route::get('user/', 'User\IndexUserController')->name('user.index');
Route::get('user/{user}', 'User\ShowUserController')->name('user.show');
Route::get('user/{user}/edit', 'User\EditUserController')->name('user.edit');
Route::match(['put', 'patch'], 'user/{user}', 'User\UpdateUserController')->name('user.update');
Route::delete('user/{user}', 'User\DestroyUserController')->name('user.destroy');

// ChangePassword
Route::get('changepassword', 'Auth\ShowChangePasswordController')->name('changepassword.form');
Route::match(['put', 'patch'], 'changepassword/{user}', 'Auth\ChangePasswordController')->name('changepassword');

// ChangeEmail
Route::get('changeemail', 'Auth\ShowChangeEmailController')->name('changeemail.form');
Route::post('changeemail/{user}', 'Auth\ChangeEmailController')->name('changeemail');
// 新規メールアドレスに更新
Route::get('reset/{token}', 'Auth\ResetEmailController')->name('reset.email');

// Post
Route::get('post/', 'Post\IndexPostController@index')->name('post.index');
Route::get('post/create', 'Post\CreatePostController')->name('post.create');
Route::post('post/', 'Post\StorePostController')->name('post.store');
Route::get('post/{post}', 'Post\ShowPostController@show')->name('post.show');
Route::get('post/{post}/edit', 'Post\EditPostController')->name('post.edit');
Route::match(['put', 'patch'], 'post/{post}', 'Post\UpdatePostController')->name('post.update');
Route::delete('post/{post}', 'Post\DestroyPostController')->name('post.destroy');

Route::post('post/review/{post}', 'ReviewController@store')->name('review.store');
Route::get('search', 'SearchController@index')->name('search');
Route::post('report/{post}', 'ReportController')->name('report');

Route::post('like/{post}', 'LikeController@ajaxStore')->name('like');
Route::post('post/like/{post}', 'LikeController@ajaxStore')->name('like.post');
Route::post('user/like/{post}', 'LikeController@ajaxStore')->name('like.user');
