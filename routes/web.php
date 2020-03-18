<?php

Route::get('/', 'StaticPagesController@home')->name('home');

Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');

Route::resource('users', 'UsersController');
// 以上代码等同于
//Route::get('/users', 'UsersConersController@destroy')->name('users.destroy');troller@index')->name('users.index');
////Route::get('/users/create', 'UsersController@create')->name('users.create');
////Route::get('/users/{user}', 'UsersController@show')->name('users.show');
////Route::post('/users', 'UsersController@store')->name('users.store');
////Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
////Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
////Route::delete('/users/{user}', 'Us

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::resource('statuses', 'StatusesController', ['only'=> ['store', 'destroy']]);

Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');

Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');