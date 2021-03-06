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

/*
	Sitemap
*/
Route::get('/sitemap', 'SitemapController@index');
Route::get('/sitemap/alphabet/{a}', 'SitemapController@alphabet');
Route::get('/sitemap/alphabet-test/{a}', 'SitemapController@test');
Route::get('/sitemap/common', 'SitemapController@common');

Route::prefix('admin')->group(function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/getData', 'CrawlController@getInputWebsite')->name('fetch_website');
	Route::post('/getData', 'CrawlController@getData')->name('fetch_website');
	Route::get('crawls', 'CrawlController@index');
	Route::post('crawls', 'CrawlController@index');
	Route::get('validate', 'Admin\ValidateController@index')->name('validate');
	Route::post('delete-meaning', 'Admin\ValidateController@deleteMeaning')->name('delete-meaning');
	Route::post('update-meaning-status', 'Admin\ValidateController@updateMeaningStatus');
	Route::post('update-page-meaning-status', 'Admin\ValidateController@updatePageMeaningStatus');
	Route::post('search', 'Admin\ValidateController@searchWord');
	Route::get('search', 'Admin\ValidateController@searchWord');
});

// action frontend
Route::post('update-meaning-like', 'Object\MeaningController@updateMeaningLike');
Route::post('update-meaning-dislike', 'Object\MeaningController@updateMeaningDislike');

/*sub pages*/
Route::get('contact', function () {
    return view('contact');
});

// Route::resource('crawls', 'CrawlController');
/*Route::get('login', 'AuthController@index');
Route::post('login', 'AuthController@index');*/

Auth::routes();

Route::get('/', 'IndexController@index');
Route::get('/{slug}', 'DetailController@index');
