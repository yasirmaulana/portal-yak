<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', function () {
    return Auth::user();
});

Route::resource('pengajuandana', 'ControllerPengajuanDana');

