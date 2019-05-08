<?php
Route::post('/user/login', 'UserController@login');
Route::get('/user/info','UserController@info');