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
Route::group([
	'middleware' => 'jwt'
], function () {
	Route::post( '/categories/{category}/duplicate', 'CategoriesController@duplicate' );
	Route::get( 'categories/{id}', 'CategoriesController@getCategory' );
	Route::resource( 'categories', 'CategoriesController' );
	Route::get( 'vat-rates/{id}', 'VatRatesController@getRate' );
	Route::resource( 'vat-rates', 'VatRatesController' );
	Route::get( 'attributes/{id}', 'AttributesController@getAttribute' );
	Route::resource( 'attributes', 'AttributesController' );
	Route::get( 'attribute-sets/{id}', 'AttributeSetsController@getAttributeSet' );
	Route::get( 'attribute-sets/{item}/list', 'AttributeSetsController@attributesList' );
	Route::resource( 'attribute-sets', 'AttributeSetsController' );

});

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');