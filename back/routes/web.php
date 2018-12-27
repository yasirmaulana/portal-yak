<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tes', function () {
    return 'hayan sama basor';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
