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
//	'middleware' => 'acl'
	'middleware' => 'jwt'
], function () {
	Route::post( '/categories/{category}/duplicate', 'CategoriesController@duplicate' );
    Route::get('all-categories', 'CategoriesController@getAllCategories');
	Route::get( 'categories/{id}', 'CategoriesController@getCategory' );
	Route::get( 'categories/parent/{id}', 'CategoriesController@getParent' );
	Route::patch( 'categories/save-orders', 'CategoriesController@saveOrders' );
	Route::resource( 'categories', 'CategoriesController' );
	Route::get( 'vat-rates/{id}', 'VatRatesController@getRate' );
	Route::resource( 'vat-rates', 'VatRatesController' );
	Route::get( 'attribute-sets/{id}', 'AttributeSetsController@getAttributeSet' );
	Route::resource( 'attribute-sets', 'AttributeSetsController' );
	Route::get('vendors/{id}', 'VendorsController@getVendor');
	Route::resource( 'vendors', 'VendorsController' );
	Route::get('variant-groups/{id}', 'VariantGroupsController@getVariantGroup');
	Route::resource( 'variant-groups', 'VariantGroupsController' );
	Route::get('/types', 'VariantGroupsController@variantTypes');
	Route::get('/price-options', 'VariantGroupsController@priceOptions');
	Route::get('/main-categories', 'ProductsController@getMainCategories');
    Route::get('products/{id}', 'ProductsController@getProduct');
    Route::resource('products', 'ProductsController');
    Route::resource('users', 'UsersController');

    Route::get('modules', 'UserModuleAccessesController@getShopModules');
    Route::get('access-rights', 'UserModuleAccessesController@getAccessRights');
    Route::resource('user-access', 'UserModuleAccessesController');


});

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');