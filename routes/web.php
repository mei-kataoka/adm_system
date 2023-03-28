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


//ホーム画面
//Route::get('/home', 'homeController@index')->name('home');


//商品一覧画面
Route::get('/product', 'AdmController@showList')->name('products');
//商品検索
Route::get('/product/listSearch/', 'AdmController@search')->name('search');
Route::get('/productSearch', 'AdmController@search')->name('productSearch');

// 商品登録画面を表示
Route::get('/product/create', 'AdmController@showCreate')->name('create');

// 商品登録
Route::post('/product/store', 'AdmController@exeStore')->name('store');



//商品詳細画面を表示
Route::get('/product/{id}', 'AdmController@showDetail')->name('show');

//商品編集画面を表示 登録
Route::get('/product/edit/{id}', 'AdmController@showEdit')->name('edit');
Route::post('/product/update', 'AdmController@exeUpdate')->name('update');

//ブログ削除
Route::post('/product/delete/{id}', 'AdmController@exeDelete')->name('delete');

Auth::routes();
