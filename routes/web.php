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