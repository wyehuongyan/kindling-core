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

    // delivery
    // // delivery options
    Route::post('delivery/options', 'DeliveryController@deliveryOptions');
    Route::post('delivery/option/create', 'DeliveryController@createDeliveryOption');
    Route::post('delivery/option/edit/{deliveryOption}', 'DeliveryController@updateDeliveryOption');
    Route::delete('delivery/option/{deliveryOption}', 'DeliveryController@deleteDeliveryOption');

    // // shipping address
    Route::get('shipping/addresses', 'DeliveryController@userShippingAddresses');
    Route::get('shipping/address', 'DeliveryController@userShippingAddress');
    Route::post('shipping/address/create', 'DeliveryController@createShippingAddress');
    Route::post('shipping/address/edit/{userShippingAddress}', 'DeliveryController@updateShippingAddress');
    Route::delete('shipping/address/{userShippingAddress}', 'DeliveryController@deleteShippingAddress');

    // cart
    Route::get('cart', 'CartController@cart');
    Route::post('cart/update/{cart}', 'CartController@updateCart');
    Route::post('cart/item/add', 'CartController@addCartItem');
    Route::post('cart/item/edit/{cartItem}', 'CartController@updateCartItem');
    Route::delete('cart/item/{cartItem}', 'CartController@deleteCartItem');
    Route::get('cart/verify', 'CartController@verifyStock');

    // points
    Route::get('user/points', 'PointsController@userPoints');
    Route::post('user/points/add', 'PointsController@addUserPoints');
    Route::post('user/points/deduct', 'PointsController@deductUserPoints');
    Route::post('user/points/edit', 'PointsController@updateUserPoints');

    // payments
    Route::get('billing/payments', 'PaymentController@userPaymentMethods');
    Route::get('billing/payment', 'PaymentController@userPaymentMethod');
    Route::post('billing/payment/create', 'PaymentController@createPaymentMethod');
    Route::post('billing/transaction/create', 'PaymentController@createTransaction');

    // orders
    Route::post('orders/user', 'OrderController@userOrders');
    Route::post('orders/user/shop', 'OrderController@userShopOrders');
    Route::post('order/user', 'OrderController@userOrder');
    Route::post('orders/shop', 'OrderController@shopOrders');
    Route::post('order/shop/{shopOrder}', 'OrderController@updateShopOrder');
    Route::get('order/statuses', 'OrderController@orderStatuses');
    Route::post('order/create', 'OrderController@createOrder');

    // firebase token
    Route::get('auth/firebase/token', 'Auth\AuthController@generateFireBaseToken');

    // braintree token
    Route::get('auth/braintree/token', 'Auth\AuthController@generateBraintreeToken');

    // APNS
    Route::post('auth/apns/token', 'Auth\AuthController@updateAPNSDeviceToken');
    Route::post('notification/send', 'NotificationController@sendPushNotification');

    // edit profile
    Route::post('update/profile', 'UserController@updateProfile');
    Route::post('update/password', 'UserController@updatePassword');

    // mail
    Route::post('mail/feedback', 'MailController@feedback');
    Route::post('mail/welcome', 'MailController@orders');
});

/////////////////////////////
/////////* Queue *///////////
/////////////////////////////
// queue
Route::post('queue/receive', 'QueueController@receiveJob');