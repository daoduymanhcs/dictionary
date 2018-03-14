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

Route::prefix('admin')->group(function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/getData', 'CrawlController@getInputWebsite')->name('fetch_website');
	Route::post('/getData', 'CrawlController@getData')->name('fetch_website');
	Route::get('crawls', 'CrawlController@index');
	Route::post('crawls', 'CrawlController@index');
	Route::get('validate', 'Admin\ValidateController@index')->name('validate');
	Route::post('delete-meaning', 'Admin\ValidateController@deleteMeaning')->name('delete-meaning');
	Route::post('update-meaning-status', 'Admin\ValidateController@updateMeaningStatus');
});
/*sub pages*/
Route::get('contact', function () {
    return view('contact');
});

// Route::resource('crawls', 'CrawlController');
Route::get('login', 'AuthController@index');
Route::post('login', 'AuthController@index');


Auth::routes();

Route::get('/', 'IndexController@index');
Route::get('/{slug}', 'DetailController@index');
