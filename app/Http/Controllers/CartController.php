<?php namespace App\Http\Controllers;

use App\Models\DeliveryOption;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\User;
use App\Models\Piece;
use App\Models\Outfit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller {

    // Cart Item
    public function addCartItem(Request $request) {
        $deliveryOptionId = $request->get("delivery_option_id");
        $pieceId = $request->get("piece_id");
        $quantity = $request->get("quantity");
        $size = $request->get("size");
        $sellerId = $request->get("seller_id");
        $buyerId = $request->get("buyer_id");
        $outfitId = $request->get("outfit_id");

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
                                            "cart_id" => $cart->id,
                                            "outfit_id" => $outfitId])->first();

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

                if(isset($outfitId)) {
                    $outfit = Outfit::find($outfitId);
                    $cartItem->outfit()->associate($outfit);
                }

                $cartItem->deliveryOption()->associate($deliveryOption);
                $cartItem->size = $size;
                $cartItem->quantity = $quantity;
                $cartItem->save();

                $json = array("status" => "200",
                    "message" => "success",
                    "cart_item" => $cartItem
                );
            }
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function updateCartItem(Request $request) {
        try {
            $cartItem = CartItem::find($request->get("id"));
            $cartItem->size = $request->get("size");
            $cartItem->quantity = $request->get("quantity");

            $deliveryOption = DeliveryOption::find($request->get("delivery_option_id"));
            $cartItem->deliveryOption()->associate($deliveryOption);

            $cartItem->save();

            $json = array("status" => "200",
                "message" => "success",
                "cart_item" => $cartItem
            );
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function deleteCartItem(Request $request, CartItem $cartItem) {
        $cartOwner = $cartItem->cart->user;

        if($cartOwner->id == $request->get("owner_id")) {
            $cartItem->delete();

            $json = array(
                "status" => "200",
                "message" => "success",
                "deleted" => $cartItem
            );
        } else {
            $json = array(
                "status" => "400",
                "message" => "error",
                "data" => "failed to delete, please try again."
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    // Cart
    public function cart(Request $request) {
        $user = Auth::user();

        if(isset($user)) {
            $cart = $user->cart;

            $cartItems = Cart::where('user_id', '=', $user->id)->with(array('cartItems' => function($query) use ($cart) {
                $query->with('outfit', 'piece', 'seller', 'deliveryOption');
            }))->orderBy('created_at', 'desc');
        }

        return response()->json($cartItems->first())->setCallback($request->input('callback'));
    }

    public function updateCart(Request $request, Cart $cart) {
        try {
            $itemsPrice = $request->get("items_price");
            $shippingRate = $request->get("shipping_rate");
            $totalPrice = $request->get("total_price");

            $cart->items_price = $itemsPrice;
            $cart->shipping_rate = $shippingRate;
            $cart->total_price = $totalPrice;

            $cart->save();

            $json = array("status" => "200",
                "message" => "success",
                "cart_item" => $cart
            );
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function verifyStock(Request $request) {
        // for each cart item check if stock is still available
        // return a json of "insufficient_stock" if some items are unavailable
        $markedPieces = array();
        $insufficientStocks = array();
        $insufficient = false;
        $cart = Auth::user()->cart;

        $cartItems = $cart->cartItems;

        // associative to store quantity of similar piece cartItem
        $piecePurchasedQuantity = array();

        foreach($cartItems as $cartItem) {
            $piece = $cartItem->piece;
            $quantity = json_decode($piece->quantity);

            foreach($quantity as $key => $value) {
                if($cartItem->size == $key) {

                    $alreadyPurchasedQuantity = 0;

                    // was the same piece already carted?
                    if(array_key_exists($piece->id, $piecePurchasedQuantity)) {
                        $pieceSizeQuantityArray = $piecePurchasedQuantity[$piece->id];

                        // was the same size already carted?
                        if(array_key_exists($cartItem->size, $pieceSizeQuantityArray)) {
                            $alreadyPurchasedQuantity = $pieceSizeQuantityArray[$cartItem->size];

                            // update carted quantity for this size
                            $pieceSizeQuantityArray[$cartItem->size] = $alreadyPurchasedQuantity + $cartItem->quantity;

                        } else {
                            // add new size
                            $pieceSizeQuantityArray[$cartItem->size] = $cartItem->quantity;
                        }

                        // update array
                        $piecePurchasedQuantity[$piece->id] = $pieceSizeQuantityArray;

                    } else {
                        // add new piece
                        $piecePurchasedQuantity[$piece->id] = array($cartItem->size => $cartItem->quantity);
                    }

                    // verify stock
                    if($cartItem->quantity + $alreadyPurchasedQuantity > $value) {
                        // low stock for this piece size
                        $markedPieces[$piece->id] = $value;
                        $insufficient = true;
                    }
                }
            }
        }

        if($insufficient) {
            // loop through cartItems and mark cartItems with insufficient stock
            foreach($cartItems as $cartItem) {
                $piece = $cartItem->piece;

                if(array_key_exists($piece->id, $markedPieces)) {
                    $insufficientStock = new \stdClass();
                    $insufficientStock->cart_item = $cartItem;
                    $insufficientStock->cart_item_id = $cartItem->id;
                    $insufficientStock->cart_item_name = $piece->name;
                    $insufficientStock->size_ordered = $cartItem->size;
                    $insufficientStock->quantity_ordered = $cartItem->quantity;
                    $insufficientStock->quantity_left = $markedPieces[$piece->id];

                    $insufficientStocks[] = $insufficientStock;
                }
            }

            $json = array("status" => "200",
                "message" => "success",
                "insufficient_stocks" => $insufficientStocks
            );
        } else {
            $json = array("status" => "200",
                "message" => "success"
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }
}