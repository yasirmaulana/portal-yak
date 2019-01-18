<?php

use App\Sequence;
use App\Tab;
use App\Menu;
use App\PengajuanDana;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('pengajuan', 'ControllerPengajuanDana')->middleware(['auth', 'rolestandar']);
Route::resource('pengajuandetail', 'ControllerPengajuanDanaDetail')->middleware(['auth', 'rolestandar']);
Route::resource('persetujuanpengajuandana', 'ControllerPersetujuanPengajuanDana')->middleware(['auth', 'rolemanager']);

Route::get('/addmenu', function () {
    $post = new Sequence;
    $post->no = 0;
    // $post->name = 'Pengajuan Dana';
    // $post->role = 'standar';
    // $post->route = 'pengajuan.index';
    $post->save();
    return $post;
});
Route::get('/getsekuen', function () {
    $user = Auth::user()->id;
    $data = PengajuanDana::where('user_id', $user)->get();
    return $data;
});

Route::delete('/deletepengajuandetail/{id}/{nomor}', 'ControllerPengajuanDetail@destroy')->name('pengajuandetail.destroy');

// Route::get('/user', function () {
//     return Auth::user();
// });

// Route::get('/form', 'ControllerTest@form');
// Route::post('/add', 'ControllerTest@addCart');

// Route::get('/admin', function () {
//     return 'ini halaman admin';
// })->middleware(['role', 'auth']);