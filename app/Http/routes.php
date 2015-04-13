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

////////////////////////////
/* Laravel Default Routes */
////////////////////////////
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('aws', ['middleware' => 'auth', 'uses' => 'WelcomeController@aws']);

/////////////////////////////////
/* Authentication and Password */
/////////////////////////////////
Route::post('auth/register', 'Auth\AuthController@register');
Route::post('auth/login', 'Auth\AuthController@authenticate');
Route::get('auth/check', 'Auth\AuthController@checkLoggedIn');
Route::controller('password', 'Auth\PasswordController');

/////////////////////////////
/* User Pieces and Outfits */
/////////////////////////////
Route::post('users', 'UserController@users');
Route::get('user', 'UserController@user');

/////////////////////////////
/* User Pieces and Outfits */
/////////////////////////////
Route::group(['middleware' => 'auth'], function() {
    Route::post('pieces', 'PieceController@pieces');
    Route::get('user/{user}/pieces', 'PieceController@user_pieces');
    Route::get('outfits', 'OutfitController@outfits');
    Route::get('user/{user}/outfits', 'OutfitController@user_outfits');
    Route::get('user/{user}/outfits/following', 'OutfitController@following_outfits');
    Route::get('user/{user}/outfits/community', 'OutfitController@community_outfits');
});

