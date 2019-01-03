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

Route::get('/form', 'ControllerTest@form');
Route::post('/add', 'ControllerTest@addCart');
Route::post('/remove', function () {
    Cart::remove();
});