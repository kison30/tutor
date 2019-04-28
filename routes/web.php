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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', 'UserController@login')->name('login');
\Auth::loginUsingId(1); //用户id为1的登录
//显示文章和相应的评论
Route::get('/post/show/{id}', 'PostController@show');

//用户进行评论
Route::post('post/{id}/comments', 'PostController@comment');