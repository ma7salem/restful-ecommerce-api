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

Route::group(['namespace' => 'Api'], function(){

		Route::post('login', 'AuthController@login')->name('api.login');
		Route::post('register', 'AuthController@register')->name('api.register');
		Route::get('logout', 'AuthController@logout')->name('api.logout')->middleware('auth:api');

		Route::apiResource('/products', 'ProductController', ['as' => 'api'])->only(['index', 'show']);
		Route::get('products/category/{slug}', 'ProductController@category')->name('api.products.category');
		Route::get('products/brand/{slug}', 'ProductController@brand')->name('api.products.brand');


		Route::get('categories', 'CategoryController@index')->name('api.categories.index');

		Route::get('brands', 'BrandController@index')->name('api.brands.index');

		Route::group(['prefix' => 'products'], function(){
			Route::apiResource('{slug}/reviews', 'ReviewController', ['as' => 'api'])->only(['index', 'show', 'store']);
		});

		Route::apiResource('order', 'OrderController', ['as' => 'api'])->only(['store', 'index', 'show']);

		Route::apiResource('contact', 'ContactController', ['as' => 'api'])->only(['store']);
	

});
