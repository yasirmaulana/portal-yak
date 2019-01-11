<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('pengajuan', 'ControllerPengajuanDana')->middleware(['auth', 'role']);
Route::resource('pengajuandetail', 'ControllerPengajuanDanaDetail');

// Route::get('/user', function () {
//     return Auth::user();
// });

// Route::get('/form', 'ControllerTest@form');
// Route::post('/add', 'ControllerTest@addCart');

// Route::get('/admin', function () {
//     return 'ini halaman admin';
// })->middleware(['role', 'auth']);