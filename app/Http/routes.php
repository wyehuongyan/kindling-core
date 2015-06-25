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
    Route::delete('piece/{piece}', 'PieceController@deletePiece');
    Route::get('piece/categories', 'PieceController@pieceCategories');
    Route::post('piece/brands', 'PieceController@pieceBrands');

    // outfits
    Route::post('outfits', 'OutfitController@outfits');
    Route::post('outfits/ids', 'OutfitController@outfitsByIds');
    Route::get('user/{user}/outfits', 'OutfitController@userOutfits');
    Route::post('user/{user}/outfits/following', 'OutfitController@followingOutfits');
    Route::get('user/{user}/outfits/community', 'OutfitController@communityOutfits');
    Route::delete('outfit/{outfit}', 'OutfitController@deleteOutfit');

    // upload
    Route::post('upload/piece/create', 'MediaController@uploadPiece');
    Route::post('upload/piece/update', 'MediaController@updatePiece');
    Route::post('upload/outfit/create', 'MediaController@uploadOutfit');
    Route::post('upload/outfit/spruce', 'MediaController@uploadSprucedOutfit');

    // follow
    Route::post('user/followed', 'UserController@followedUser');
    Route::post('user/following', 'UserController@followingUsers');

    // delivery options
    Route::post('delivery/options', 'DeliveryController@deliveryOptions');
    Route::post('delivery/option/create', 'DeliveryController@createDeliveryOption');

    // firebase
    Route::get('auth/firebase/token', 'Auth\AuthController@generateFireBaseToken');
});