<?php

use Illuminate\Http\Request;

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
Route::get('urunler','UrunController@urunler')->name('api.urunler');
Route::get('kategoriler','KategoriController@kategoriler')->name('api.kategoriler');
Route::get('siparisler','SiparisController@siparisler')->name('api.siparisler');
Route::get('sepet','SepetController@sepet')->name('api.sepet');
