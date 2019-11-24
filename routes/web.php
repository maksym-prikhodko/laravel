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

Route::get('/', function () {
    return view('welcome');
});

// Products
Route::get('/products', 'ProductController@all');
Route::get('/products/search', 'ProductController@search');

// Product
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::get('/product/create', 'ProductController@create');

Route::post('/product/edit/{id}', 'ProductController@update');
Route::post('/product/create', 'ProductController@make');
Route::get('/product/delete/{id}', 'ProductController@delete');

// Product Type
Route::get('/product-types', 'ProductTypeController@all');
Route::get('/product-type/create', 'ProductTypeController@create');
Route::get('/product-type/edit/{id}', 'ProductTypeController@edit');

Route::post('/product-type/edit/{id}', 'ProductTypeController@update');
Route::post('/product-type/create', 'ProductTypeController@make');
Route::get('/product-type/delete/{id}', 'ProductTypeController@delete');

// Product Attribute
Route::get('/product-attributes', 'ProductAttributeController@all');
Route::get('/product-attribute/create', 'ProductAttributeController@create');
Route::get('/product-attribute/edit/{id}', 'ProductAttributeController@edit');

Route::post('/product-attribute/edit/{id}', 'ProductAttributeController@update');
Route::post('/product-attribute/create', 'ProductAttributeController@make');
Route::get('/product-attribute/delete/{id}', 'ProductAttributeController@delete');

