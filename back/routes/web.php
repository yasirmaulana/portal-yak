<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', function () {
    return Auth::user();
});


Route::resource('pengajuan', 'ControllerPengajuanDana');
Route::resource('pengajuandetail', 'ControllerPengajuanDanaDetail');

// Route::get('/form', 'ControllerTest@form');
// Route::post('/add', 'ControllerTest@addCart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
