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


/*
|
| Main Routes
|
*/
Route::get('/', 'WelcomeController@index');
Route::get('home', 'WelcomeController@index');
Route::get('locale/{lang}', 'Auth\AccountController@changeLocale');

/*
|
| Login Routes
|
*/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('facebook', 'Auth\AccountController@redirectToFacebook');
Route::get('account/facebook', 'Auth\AccountController@facebookLogin');

Route::get('twitter', 'Auth\AccountController@redirectToTwitter');
Route::get('account/twitter', 'Auth\AccountController@twitterLogin');


//Route::get('/', 'Frontend\ArticleController@index');
Route::get('article/{magazineid}/{number}', 'Frontend\ArticleController@showArticle');

/*
|
| Admin Routes
|
*/
Route::group(['prefix' =>'admin'], function() {
	Route::get('/', 'Admin\AdminController@index');

	Route::post('magazine', 'Admin\MagazinesController@setMagazine');

	Route::get('article', 'Admin\ArticleController@index');
	Route::post('article/sort', 'Admin\ArticleController@sortArticles');
	Route::get('article/create', 'Admin\ArticleController@newArticle');
	Route::post('article/fileupload/{id}', 'Admin\ArticleController@fileUpload');
	Route::get('article/{id}', 'Admin\ArticleController@editArticle');
	Route::post('article/{id}', 'Admin\ArticleController@saveArticle');

	Route::get('article/delete/{id}', 'Admin\ArticleController@deleteArticle');

	Route::get('article/sections/{article_id}', 'Admin\SectionsController@showArticleSections');
	Route::get('article/comments/{article_id}', 'Admin\CommentsController@showArticleComments');

	Route::get('sections', 'Admin\SectionsController@index');
	Route::post('sections/fileupload/{id}', 'Admin\SectionsController@fileUpload');
	Route::get('sections/{id}', 'Admin\SectionsController@editSection');
	Route::post('sections/{id}', 'Admin\SectionsController@saveSection');
	Route::get('sections/delete/{id}', 'Admin\SectionsController@deleteSection');

	Route::get('media/delete/{filename}', 'Admin\SectionsController@deleteMediaItem');

	Route::get('comments', 'Admin\CommentsController@index');
	Route::get('comments/{id}', 'Admin\CommentsController@editComment');
	Route::post('comments/{id}', 'Admin\CommentsController@saveComment');
	Route::get('comments/delete/{id}', 'Admin\CommentsController@deleteComment');

	Route::get('user', 'Admin\AdminController@showUser');
	Route::get('user/delete/{id}', 'Admin\AdminController@deleteUser');

	Route::get('magazines', 'Admin\MagazinesController@showMagazines');
	Route::get('magazines/create', 'Admin\MagazinesController@createMagazine');
	Route::get('magazines/delete/{id}', 'Admin\MagazinesController@deleteMagazine');
	Route::get('magazines/{id}', 'Admin\MagazinesController@showMagazine');
	Route::post('magazines/{id}', 'Admin\MagazinesController@saveMagazine');

});

/*
|
| User Routes
|
*/
Route::get('user', 'UserController@index');
Route::post('user', 'UserController@saveUser');



