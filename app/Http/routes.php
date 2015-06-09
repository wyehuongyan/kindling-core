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
    // pieces
    Route::post('pieces', 'PieceController@pieces');
    Route::post('pieces/ids', 'PieceController@piecesByIds');
    Route::get('user/{user}/pieces', 'PieceController@userPieces');
    Route::get('piece/{piece}/outfits', 'PieceController@pieceOutfits');

    // outfits
    Route::post('outfits', 'OutfitController@outfits');
    Route::post('outfits/ids', 'OutfitController@outfitsByIds');
    Route::get('user/{user}/outfits', 'OutfitController@userOutfits');
    Route::get('user/{user}/outfits/following', 'OutfitController@followingOutfits');
    Route::get('user/{user}/outfits/community', 'OutfitController@communityOutfits');

    // upload
    Route::post('upload/outfit/create', 'MediaController@uploadOutfit');
    Route::post('upload/outfit/spruce', 'MediaController@uploadSprucedOutfit');

    // follow
    Route::post('user/followed', 'UserController@followedUser');
    Route::post('user/following', 'UserController@followingUsers');

    // firebase
    Route::get('auth/firebase/token', 'Auth\AuthController@generateFireBaseToken');
});