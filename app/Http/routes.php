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
Route::get('/', 'HomeController@index');
Route::get('/timeline', 'TimelineController@index');
Route::post('/tweet', 'TweetController@create');
Route::get('/tweets/delete/{id}','TweetController@delete');
Route::get('tweets/like/{id}','TweetController@like');
Route::post('/search','SearchController@searchUsers');
Route::get('/follow/{id}','UserController@follow');
Route::get('/users/{id}','UserController@show');
Route::get('/activity','HomeController@activity');
