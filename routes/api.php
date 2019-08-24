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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group('middleware' => ['auth:api'], function () {
// 	Route::post('register','UserController@register');
// 	Route::get('user','UserController@user');
// })

// User Controller Routes
Route::post('register','UserController@register');
Route::get('user-list','UserController@getUsers');
Route::get('user/edit/{id}','UserController@edit');
Route::post('user/update','UserController@update');
Route::post('user/destroy','UserController@destroy');
Route::get('user/details/{id}','UserController@getUserDetails');

// Category Controller Routes
Route::get('category-list','CategoryController@getCategories');
Route::post('category/store','CategoryController@store');
Route::get('category/edit/{id}','CategoryController@edit');
Route::post('category/update','CategoryController@update');
Route::post('category/destroy','CategoryController@destroy');
Route::get('category/details/{id}','CategoryController@getCategoryDetails');
Route::get('sub-category-list/{category_id}','CategoryController@getSubCategoriesByCategoryId');

// Product Controller Routes
Route::get('product-list','ProductController@getProducts');
Route::post('product/store','ProductController@store');
Route::get('product/edit/{id}','ProductController@edit');
Route::post('product/update','ProductController@update');
Route::post('product/destroy','ProductController@destroy');
Route::get('product/details/{id}','ProductController@getProductDetails');

// Referal Controller Routes
Route::get('referal-list','ReferalController@getCategories');
Route::post('referal/store','ReferalController@store');
Route::get('referal/edit/{id}','ReferalController@edit');
Route::post('referal/update','ReferalController@update');
Route::post('referal/destroy','ReferalController@destroy');
Route::get('referal/details/{id}','ReferalController@getReferalDetails');

// Referal status Controller Routes
Route::get('referal-status-list','ReferalStatusController@getCategories');
Route::post('referal-status/store','ReferalStatusController@store');
Route::get('referal-status/edit/{id}','ReferalStatusController@edit');
Route::post('referal-status/update','ReferalStatusController@update');
Route::post('referal-status/destroy','ReferalStatusController@destroy');
Route::get('referal-status/details/{id}','ReferalStatusController@getReferalStatusDetails');

// Reward type Controller Routes
Route::get('rewart-type-list','RewardTypeController@getCategories');
Route::post('rewart-type/store','RewardTypeController@store');
Route::get('rewart-type/edit/{id}','RewardTypeController@edit');
Route::post('rewart-type/update','RewardTypeController@update');
Route::post('rewart-type/destroy','RewardTypeController@destroy');
Route::get('rewart-type/details/{id}','RewardTypeController@getRewardTypeDetails');





