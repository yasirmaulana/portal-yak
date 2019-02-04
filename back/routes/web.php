<?php

use App\Sequence;
use App\Tab;
use App\Menu;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\KodeBudget;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('pengajuan', 'ControllerPengajuanDana')->middleware(['auth', 'rolestandar']);
Route::resource('pengajuanedit', 'ControllerPengajuanDanaEdit')->middleware(['auth', 'rolestandar']);
Route::resource('pengajuandetail', 'ControllerPengajuanDanaDetail')->middleware(['auth', 'rolestandar']);
Route::resource('persetujuanpengajuandana', 'ControllerPersetujuanPengajuanDana')->middleware(['auth', 'rolemanager']);
Route::resource('persetujuanpengajuandetail', 'ControllerPersetujuanPengajuanDetail')->middleware(['auth', 'rolemanager']);
Route::resource('persetujuanpengajuanaccounting', 'ControllerPersetujuanPengajuanAccounting')->middleware(['auth', 'roleaccounting']);

Route::get('/addSeq', function () {
    $post = new Sequence;
    $post->no = 0;
    $post->save();
    return $post;
});
Route::get('/addmenu', function () {
    $post = new Menu;
    $post->name = 'Persetujuan Pengajuan Dana';
    $post->role = 'accounting';
    $post->route = 'persetujuanpengajuanaccounting.index';
    $post->save();
    return $post;
});
Route::get('/addkodebudget', function () {
    $post= new KodeBudget;
    $post->kode_budget = '002';
    $post->deskripsi = 'Guru Ngaji';
    $post->save();
    return $post;
});