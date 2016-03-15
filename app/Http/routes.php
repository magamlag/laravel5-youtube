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

Route::get('/', function () {
	return redirect('/videos');
});

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/login', ['uses' => 'GoogleLoginController@index', 'as' => 'login']);
Route::get('/logout', ['uses' => 'GoogleLoginController@logout', 'as' => 'logout']);
Route::get('/loginCallback', ['uses' => 'GoogleLoginController@store', 'as' => 'loginCallback']);
Route::get('/categories', ['uses' => 'YouTubeAPIController@categories']);
Route::get('/video/{id}', ['uses' => 'YouTubeAPIController@video', 'as' => 'video']);
Route::get('/videos', ['uses' => 'YouTubeAPIController@videos', 'as' => 'videos']);
Route::any('/search', ['as' => 'search', 'uses' => 'YouTubeAPIController@search']);