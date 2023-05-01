<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\API\VerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//商品情報取得
Route::post('ver', 'API\VerController@index')->name('index');
//商品購入
Route::post('ver/update', 'API\VerController@upDate')->name('upDate');
