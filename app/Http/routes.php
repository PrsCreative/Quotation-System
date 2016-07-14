<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', 'AdminController@index');

Route::get('/admin', 'AdminController@index');

/*** AJAX Requests ***/
//Get products info base on product id
Route::get('/search/products/{id}', 'SearchController@getProduct');

//Get inventory rows based on product id
Route::get('/search/inventory/{id}', 'SearchController@getInventory');

//Get items table based on quotation id
Route::get('/search/quotations/{id}', 'SearchController@getItemsTable');

//Test purposes only
Route::get('/test', 'SearchController@test');

// RESOURCE CONTROLLERS ///////////////////////////////////////////////////

/*** Quotations ***/
Route::resource('quotations', 'QuoteController');
Route::resource('quote_items', 'QuoteItemController');

/*** Customers ***/
Route::resource('customers', 'CustomerController');

/*** Products ***/
Route::resource('products', 'ProductController');

/*** Inventory ***/
Route::resource('inventory', 'InventoryController');

