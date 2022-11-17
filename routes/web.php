<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//商品一覧画面
Route::get('/', 'AdmController@showList')->name('products');

// ブログ登録画面を表示
Route::get('/product/create', 'AdmController@showCreate')->name('create');

// ブログ登録
Route::post('/product/store', 'AdmController@exeStore')->name('store');

//商品詳細表示画面
Route::get('/product/{id}', 'AdmController@showDetail')->name('show');
