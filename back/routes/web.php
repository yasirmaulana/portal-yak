<?php

use App\Sequence;
use App\PengajuanDana;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('pengajuan', 'ControllerPengajuanDana')->middleware(['auth', 'role']);
Route::resource('pengajuandetail', 'ControllerPengajuanDanaDetail');

Route::get('/sekuen', function () {
    $post = Sequence::find(1);
    // $post->no = 0;
    // $post->save();
    return $post;
});
Route::get('/getsekuen', function () {
    $user = Auth::user()->id;
    $data = PengajuanDana::where('user_id', $user)->get();
    return $data;
});

// Route::get('/user', function () {
//     return Auth::user();
// });

// Route::get('/form', 'ControllerTest@form');
// Route::post('/add', 'ControllerTest@addCart');

// Route::get('/admin', function () {
//     return 'ini halaman admin';
// })->middleware(['role', 'auth']);