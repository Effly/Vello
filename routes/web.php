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
    return view('index');
});




Route::get('catalog/all', 'CategoryController@allData')->name('contact-data');
Route::get('catalog', 'ProductCategoryController@catalog')->name('catalog-main');


//Route::get('/catalog/{category}', function(){
//    return view('products');
//})->name('product');

Route::get('catalog/{categorySlug?}', 'ProductCategoryController@getCatProduct')->name('catalog');
Route::get('catalog/{categorySlug?}/{subcategorySlug?}', 'ProductCategoryController@getCatSubProduct')->name('catalog.sub');
Route::get('catalog/{categorySlug?}/{subcategorySlug?}/{thirdcategorySlug?}', 'ProductCategoryController@getCatThirdProducts')->name('catalog.third');
Route::get('product/{product}', 'ProductCategoryController@getProduct')->name('product');


Route::get('/basket', 'BasketController@basket')->name('basket');
Route::get('/basket/place', 'BasketController@basketPlace')->name('basket-place');
Route::post('/basket/add/{id}', 'BasketController@basketAdd')->name('basket-add');
Route::post('/basket/remove/{id}', 'BasketController@basketRemove')->name('basket-remove');
Route::post('/basket/place', 'BasketController@basketConfirm')->name('basket-confirm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

// Admin routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function() {

    Route::get('/login', 'DashboardController@index')->name('admin.dashboard');


    Route::resource('shares','ShareController');
});


