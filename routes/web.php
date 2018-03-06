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

Route::get('/test', 'CrawlController@test');
/*sub pages*/
Route::get('contact', function () {
    return view('contact');
});

// Route::resource('crawls', 'CrawlController');
Route::get('login', 'AuthController@index');
Route::post('login', 'AuthController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index');
Route::get('/{slug}', 'DetailController@index');


Route::prefix('admin')->group(function () {
	Route::resource('crawls', 'CrawlController');
});