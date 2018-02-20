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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/categories/{category}/duplicate', 'CategoriesController@duplicate');
Route::resource('categories', 'CategoriesController');
Route::resource('vat-rates', 'VatRatesController');
Route::resource('attributes', 'AttributesController');
Route::resource('attribute-sets', 'AttributeSetsController');
