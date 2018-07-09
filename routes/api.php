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
//	'middleware' => 'jwt'
], function () {

//    Categories Routes
	Route::post( '/categories/{category}/duplicate', 'CategoriesController@duplicate' );
    Route::get('all-categories', 'CategoriesController@getAllCategories');
	Route::get( 'categories/{id}', 'CategoriesController@getCategory' );
	Route::get( 'categories/parent/{id}', 'CategoriesController@getParent' );
	Route::patch( 'categories/save-orders', 'CategoriesController@saveOrders' );
	Route::get('categories/{id}/attribute-sets', 'CategoriesController@getAttributeSets');
	Route::resource( 'categories', 'CategoriesController' );

//	Vat Rates Routes
	Route::get( 'vat-rates/{id}', 'VatRatesController@getRate' );
	Route::resource( 'vat-rates', 'VatRatesController' );

//	Attribute Sets Routes
	Route::get( 'attribute-sets/{id}', 'AttributeSetsController@getAttributeSet' );
	Route::get('attribute-sets-categories/{id}', 'AttributeSetsController@getAttributeSetCategories');
	Route::resource( 'attribute-sets', 'AttributeSetsController' );

//	Vendors Routes
	Route::get('vendors/{id}', 'VendorsController@getVendor');
	Route::put('vendors/change-visibility', 'VendorsController@changeVisibility');
	Route::post('vendors/check-logo', 'VendorsController@checkLogo');
	Route::resource( 'vendors', 'VendorsController' );

//	Variant Sets Routes
	Route::get('variant-groups/{id}', 'VariantGroupsController@getVariantGroup');
	Route::resource( 'variant-groups', 'VariantGroupsController' );
	Route::get('/types', 'VariantGroupsController@variantTypes');
	Route::get('/price-options', 'VariantGroupsController@priceOptions');

//	Products Routes
	Route::get('/main-categories', 'ProductsController@getMainCategories');
	Route::put('/products/change-visibility', 'ProductsController@changeVisibility');
	Route::put('/products/change-main-category', 'ProductsController@changeMainCategory');
	Route::put('/products/change-vendor', 'ProductsController@changeVendor');
	Route::put('/products/change-price', 'ProductsController@changePrice');
    Route::get('products/{id}', 'ProductsController@getProduct');
    Route::delete('products/delete-all/{products}', 'ProductsController@deleteAll');
    Route::post('products/add-to-stock', 'ProductsController@addToStock');
    Route::get('products-sort-price-asc', 'ProductsController@sortByPriceAsc');
    Route::get('products-sort-price-desc', 'ProductsController@sortByPriceDesc');
    Route::get('products-sort-name', 'ProductsController@sortByName');
    Route::get('products-sort-recently-added', 'ProductsController@sortByRecentlyAdded');
    Route::get('/products-filter', 'ProductsController@filter');
    Route::get('/products-max-price', 'ProductsController@getMaxPrice');
    Route::get('/products-count', 'ProductsController@numberOfProducts');
    Route::post('products-search', 'ProductsController@search');
    Route::resource('products', 'ProductsController');

//  Description Templates Routes
    Route::get('description-templates/{id}', 'DescriptionTemplateController@getTemplate');
    Route::resource('description-templates', 'DescriptionTemplateController');


//    Users Routes
    Route::resource('users', 'UsersController');
    Route::post('/users/duplicate', 'UsersController@duplicate');
    Route::put('/users/{id}/change-password', 'UsersController@changePassword');
    Route::get('/users/{id}', 'UsersController@getUser');
    Route::get('modules', 'UserModuleAccessesController@getShopModules');
    Route::get('access-rights', 'UserModuleAccessesController@getAccessRights');
    Route::resource('user-access', 'UserModuleAccessesController');
    
    Route::post('/users/test', 'UsersController@test');

//    Warehouse Routes
    Route::get('warehouses/{id}', 'WarehousesController@getWarehouse');
    Route::resource('/warehouses', 'WarehousesController');
    Route::get('/warehouse-items/{id}', 'WarehouseItemsController@index');
    Route::resource('/warehouse-items', 'WarehouseItemsController');
    Route::get('/last-group-id', 'WarehouseItemsController@getLastGroupId');


//  Static Pages Routes
    Route::get('copy-page/{id}', 'StaticPagesController@duplicate');
    Route::resource('static-pages', 'StaticPagesController');

//    Clients Routes
    Route::post('register', 'ClientsController@register');
    Route::post('check-nip', 'ClientsController@checkIfClientExists');
    Route::post('gus-search-clients', 'ClientsController@searchInGus');
//    Route::get('register/verify/{confirmation_code}', 'ClientsController@confirm');
    Route::resource('clients', 'ClientsController');
    Route::get('client/{client_id}/shipping-details', 'ShippingDetailController@getClientShippingDetails');
    Route::resource('shipping-details', 'ShippingDetailController');
    Route::get('client/{client_id}/delete-account-confirm', 'ClientsController@deleteAccountConfirm');
    Route::post('client/add-discount', 'ClientsController@addClientDiscount');
    Route::get('client/{client_id}/discounts', 'ClientsController@getClientDiscounts');

//    Newsletters Routes
    Route::resource('newsletters', 'NewslettersController');

//    Logs Routes
    Route::resource('user-logs', 'LogController');


    Route::post('panel-search', 'HelperController@panelSearch');
//  Emails Routes
    Route::resource('emails', 'EmailsController');
    Route::put('emails/{id}/change-active', 'EmailsController@changeActive');

});

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('user/reset-password', 'UsersController@sendEmailResetPassword');
Route::get('user/{$id}/reset-password', 'UsersController@resetPassword');