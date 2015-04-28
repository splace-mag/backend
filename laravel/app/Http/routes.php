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

Route::get('/', 'WelcomeController@index');
Route::get('home', 'WelcomeController@index');


Route::group(['prefix' =>'admin'], function() {
	Route::get('/', 'AdminController@index');
	Route::get('/fb', 'Auth\AuthController@redirectToProviderFacebook');

	Route::get('article', 'ArticleController@index');
	Route::get('article/create', 'ArticleController@newArticle');
	Route::get('article/{id}', 'ArticleController@editArticle');
	Route::post('article/{id}', 'ArticleController@saveArticle');
	Route::get('article/delete/{id}', 'ArticleController@deleteArticle');

	Route::get('article/sections/{article_id}', 'SectionsController@showArticleSections');
	Route::get('article/comments/{article_id}', 'CommentsController@showArticleComments');

	Route::get('sections', 'SectionsController@index');
	Route::get('sections/{id}', 'SectionsController@editSection');
	Route::post('sections/{id}', 'SectionsController@saveSection');
	Route::get('sections/delete/{id}', 'SectionsController@deleteSection');

	Route::get('comments', 'CommentsController@index');
	Route::get('comments/{id}', 'CommentsController@editComment');
	Route::post('comments/{id}', 'CommentsController@saveComment');


});



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
