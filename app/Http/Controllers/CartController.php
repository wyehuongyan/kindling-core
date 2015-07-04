<?php namespace App\Http\Controllers;

use App\Models\DeliveryOption;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\User;
use App\Models\Piece;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {

    // Cart Item
    public function addCartItem(Request $request) {
        $deliveryOptionId = $request->get("delivery_option_id");
        $pieceId = $request->get("piece_id");
        $quantity = $request->get("quantity");
        $size = $request->get("size");
        $sellerId = $request->get("seller_id");
        $buyerId = $request->get("buyer_id");

        try {
            // check if user has cart
            $user = User::find($buyerId);
            $cart = $user->cart;

            if(!isset($cart)) {
                $cart = new Cart();
                $cart->user()->associate($user);
                $cart->save();
            }

            // check if cart already contains this item
            $existingCartItem = CartItem::search(["piece_id" => $pieceId,
                                            "cart_id" => $cart->id])->first();

            // if there's an existing item with the same size
            if(isset($existingCartItem) && $existingCartItem->size == $size) {

                // combine the existing cart item's quantity with the new one
                $existingCartItem->quantity = $existingCartItem->quantity + $quantity;
                $existingCartItem->save();

                $json = array("status" => "200",
                    "message" => "success",
                    "cart_item" => $existingCartItem
                );

            } else {
                // create new cart item
                $piece = Piece::find($pieceId);
                $seller = User::find($sellerId);

                $deliveryOption = DeliveryOption::find($deliveryOptionId);

                $cartItem = new CartItem();
                $cartItem->cart()->associate($cart);
                $cartItem->piece()->associate($piece);
                $cartItem->seller()->associate($seller);
                $cartItem->deliveryOption()->associate($deliveryOption);
                $cartItem->size = $size;
                $cartItem->quantity = $quantity;
                $cartItem->save();

                $json = array("status" => "200",
                    "message" => "success",
                    "cart_item" => $cartItem
                );
            }
        } catch (QueryException $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function updateCartItem(Request $request) {
    }

    public function deleteCartItem(Request $request) {
    }

    // Cart
    public function cart(Request $request) {
        $cart = Auth::user()->cart;

        $cartItems = $cart->with('cartItems.piece', 'cartItems.seller', 'cartItems.deliveryOption')->first();

        return response()->json($cartItems)->setCallback($request->input('callback'));
    }
}