<?php namespace App\Http\Controllers;

use App\Facades\SprubixQueue;
use App\Models\OrderStatus;
use Hashids\Hashids;
use App\Models\CartItem;
use App\Models\RefundStatus;
use App\Models\Shop;
use App\Models\ShopOrder;
use App\Models\ShopOrderRefund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Braintree_Transaction;
use Braintree_Configuration;
use Illuminate\Support\Facades\Auth;
use Mixpanel;
use Log;
use Carbon\Carbon;

class RefundController extends Controller {
    public function userRefunds(Request $request) {
        // retrieve refunds belonging to user
        $user = Auth::user();

        if ($user->shoppable instanceof Shop) {
            // shop
            $shopOrderRefunds = ShopOrderRefund::search(array("user_id" => $user->id))->with('buyer', 'refundStatus', 'shopOrder.cartItems.piece')->orderBy('created_at', 'desc')->paginate(15);
        } else {
            // shopper
            $shopOrderRefunds = ShopOrderRefund::search(array("buyer_id" => $user->id))->with('user', 'refundStatus', 'shopOrder.cartItems.piece')->orderBy('created_at', 'desc')->paginate(15);
        }

        return response()->json($shopOrderRefunds)->setCallback($request->input('callback'));
    }

    public function shopOrderRefunds(Request $request) {
        $shopOrderRefunds = ShopOrderRefund::search($request->all())->with('user', 'buyer', 'refundStatus', 'shopOrder.cartItems.piece')->orderBy('created_at', 'desc')->paginate(15);

        return response()->json($shopOrderRefunds)->setCallback($request->input('callback'));
    }

    public function shopOrderRefund(Request $request, ShopOrderRefund $shopOrderRefund) {
        $shopOrderRefund = ShopOrderRefund::find($shopOrderRefund->id)->with('user', 'refundStatus', 'shopOrder.cartItems.piece')->orderBy('created_at', 'desc')->first();

        return response()->json($shopOrderRefund)->setCallback($request->input('callback'));
    }

    public function createRefund(Request $request) {
        // first time create ShopOrderRefund
        try {
            $shopOrder = ShopOrder::find($request->get("shop_order_id"));

            $refundAmount = $request->get("refund_amount");
            $refundPoints = $request->get("refund_points");
            $refundReason = $request->get("refund_reason");
            $returnCartItems = $request->get("return_cart_items");

            if ($refundAmount > $shopOrder->refundable_amount) {
                // when refund price exceeds total refundable amount
                throw new Exception("Refund Failed. The refund amount is greater than the total refundable amount.");

            } else {
                $shopOrderRefund = new ShopOrderRefund();
                $shopOrderRefund->refund_amount = $refundAmount;
                $shopOrderRefund->refund_points = (string)$refundPoints;
                $shopOrderRefund->refund_reason = $refundReason;
                $shopOrderRefund->return_cart_items = json_encode($returnCartItems);
                $shopOrderRefund->user()->associate($shopOrder->user);
                $shopOrderRefund->buyer()->associate($shopOrder->buyer);

                if($request->get("request_for_refund") == true) {
                    // refund status id 1: Request for refund
                    $shopOrderRefund->refundStatus()->associate(RefundStatus::find(1));
                    $shopOrderRefund->shopOrder()->associate($shopOrder);
                    $shopOrderRefund->save();

                    $hashids = new Hashids("refunds", 10, "ABCDEF1234567890");
                    $shopOrderRefund->uid = $hashids->encode($shopOrderRefund->id);
                    $shopOrderRefund->save();

                    // // set the RETURN amount on refunded cart item
                    foreach($returnCartItems as $cartId => $returnAmount) {
                        $cartItem = CartItem::find($cartId);

                        $cartItem->return = $returnAmount;
                        $cartItem->save();
                    }

                    $json = array("status" => "200",
                        "message" => "success",
                        "shop_order_refund" => $shopOrderRefund
                    );

                    // send refund request push notification and email to shop and shopper
                    $message = $shopOrder->buyer->username . " has requested for a refund.";
                    SprubixQueue::queuePushNotification($shopOrder->user, $message);
                    SprubixQueue::queueRefundRequestEmail($shopOrderRefund);

                } else {
                    $json = $this->refund($shopOrder, $shopOrderRefund, $returnCartItems, $refundAmount, $refundPoints);
                }
            }
        }  catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function approveRefund(Request $request, ShopOrderRefund $shopOrderRefund) {
        try {
            $shopOrder = $shopOrderRefund->shopOrder;
            $refundAmount = $request->get("refund_amount");
            $refundPoints = $request->get("refund_points");

            if ($refundAmount > $shopOrder->refundable_amount) {
                // when refund price exceeds total refundable amount
                throw new \Exception("Refund Failed. The refund amount is greater than the total refundable amount.");
            } else {
                // approve refund
                $returnCartItems = $request->get("return_cart_items");
                $json = $this->refund($shopOrder, $shopOrderRefund, $returnCartItems, $refundAmount, $refundPoints);
            }
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    private function refund($shopOrder, $shopOrderRefund, $returnCartItems, $refundAmount, $refundPoints) {
        // Braintree refund
        // // to determine the status, retrieve the braintree transaction
        $userOrder = $shopOrder->userOrder;
        $transactionId = $userOrder->braintree_transaction_id;

        // set up braintree environment (looks like this always has to be done)
        Braintree_Configuration::environment(Config::get('app.braintree_environment'));
        Braintree_Configuration::merchantId(Config::get('app.braintree_merchantid'));
        Braintree_Configuration::publicKey(Config::get('app.braintree_public_key'));
        Braintree_Configuration::privateKey(Config::get('app.braintree_private_key'));

        $transaction = Braintree_Transaction::find($transactionId);
        $status = $transaction->status;

        switch($status) {
            case Braintree_Transaction::SETTLED:
            case Braintree_Transaction::SETTLING:

                // do the refund
                $result = Braintree_Transaction::refund($transactionId, $refundAmount);

                if ($result->success) {
                    $transaction = $result->transaction;

                    // success
                    // refund status id 3: Refunded
                    $shopOrderRefund->refundStatus()->associate(RefundStatus::find(3));
                    $shopOrderRefund->shopOrder()->associate($shopOrder);
                    $shopOrderRefund->braintree_transaction_id = $transaction->id;
                    $shopOrderRefund->save();

                    $hashids = new Hashids("refunds", 10, "ABCDEF1234567890");
                    $shopOrderRefund->uid = $hashids->encode($shopOrderRefund->id);
                    $shopOrderRefund->save();

                    // // set the RETURNED (not RETURN) amount on refunded cart item
                    foreach($returnCartItems as $cartId => $returnAmount) {
                        if ($returnAmount > 0) {
                            $cartItem = CartItem::find($cartId);

                            // set refunded points property
                            $singleItemRefundablePoints = ceil($cartItem->refundable_points / ($cartItem->quantity - $cartItem->returned));
                            $cartItem->refundable_points = $cartItem->refundable_points - $singleItemRefundablePoints;
                            $cartItem->refunded_points = $cartItem->refunded_points + $singleItemRefundablePoints;

                            // set RETURNED
                            $cartItem->returned = $cartItem->returned + $returnAmount;
                            $cartItem->return = 0;

                            $cartItem->save();
                        }
                    }

                    // // set the shop order refunded_amount and refundable_amount
                    $totalRefundedAmount = $shopOrder->refunded_amount + $refundAmount;
                    $totalRefundedPoints = $shopOrder->refunded_points + $refundPoints;

                    $shopOrder->refunded_amount = $totalRefundedAmount;
                    $shopOrder->refundable_amount = $shopOrder->total_payable_price - $totalRefundedAmount;

                    $shopOrder->refunded_points = $totalRefundedPoints;
                    $shopOrder->refundable_points = $shopOrder->refundable_points - $totalRefundedPoints;

                    // if all cart items in the shop order has been refunded
                    // if (qty - returned) > 0 exists for one cart item, not cancelled
                    // else shop order is set to 'cancelled'

                    $cartItems = $shopOrder->cartItems;
                    $cancelled = true;

                    foreach($cartItems as $cartItem) {
                        $quantity = $cartItem->quantity;
                        $returned = $cartItem->returned;

                        $remainder = $quantity - $returned;

                        if($remainder > 0) {
                            $cancelled = false;
                            break;
                        }
                    }

                    if($cancelled) {
                        // set shop order to 'cancelled' status
                        $cancelledOrderStatus = OrderStatus::find(7); // 7 = cancelled
                        $shopOrder->orderStatus()->associate($cancelledOrderStatus);

                        $shopOrder->save();

                        // check parent order (user order)
                        //// take the min id of all shop orders
                        $userOrder = $shopOrder->userOrder;

                        $minOrderStatusId = $userOrder->shopOrders->min('order_status_id');
                        $minOrderStatus = OrderStatus::find($minOrderStatusId);

                        $userOrder->orderStatus()->associate($minOrderStatus);
                        $userOrder->save();
                    }

                    $shopOrder->save();

                    // // give the buyer back their refunded points
                    $buyer = $shopOrder->buyer;
                    $userPoints = $buyer->points;

                    // create user points
                    if(!isset($userPoints)) {
                        $userPoints = new UserPoints();
                        $userPoints->user()->associate($buyer);
                        $userPoints->save();
                    }

                    $userPoints->amount = $userPoints->amount + $refundPoints;
                    $userPoints->save();

                    $json = array("status" => "200",
                        "message" => "success",
                        "braintree_result" => array(
                            "braintree_transaction_type" => $result->transaction->type,
                            "braintree_transaction_amount" => $result->transaction->amount
                        ),
                        "shop_order_refund" => $shopOrderRefund
                    );

                    // send refund approved push notification and email to shop and shopper
                    $message = $shopOrder->user->username . " has approved your refund request.";
                    SprubixQueue::queuePushNotification($shopOrder->buyer, $message);
                    SprubixQueue::queueRefundApprovedEmail($shopOrderRefund);

                    // Mixpanel - People - Refund Points (Add) and Revenue (Deduct)
                    $mixpanel = Mixpanel::getInstance(env("MIXPANEL_TOKEN"));
                    $mixpanel->people->increment($buyer->id, "Points", $refundPoints);
                    $mixpanel->track("Points", array(
                        "User ID" => $buyer->id,
                        "Amount" => $refundPoints,
                        "Source" => "Refund",
                        "Timestamp" => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a")
                    ));

                    $mixpanel->people->trackCharge($buyer->id, -$refundAmount, strtotime(Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a")));
                    $mixpanel->track("Revenue", array(
                        "User ID" => $buyer->id,
                        "Amount" => -$refundAmount,
                        "Source" => "Refund",
                        "Timestamp" => Carbon::now()->setTimezone('UTC')->format("F j, Y, g:i a")
                    ));

                } else {
                    $refundTransactionStatus = $result->transaction->status;
                    $processorSettlementResponseCode = $result->transaction->processorSettlementResponseCode;
                    $processorSettlementResponseText = $result->transaction->processorSettlementResponseText;

                    //Log::info($result);

                    throw new \Exception("Refund Failed. Refund Transaction Status: " . $refundTransactionStatus . "SettlementResponseCode: " . $processorSettlementResponseCode. "SettlementResponseText: " . $processorSettlementResponseText);
                }

                break;

            case Braintree_Transaction::AUTHORIZED:
            case Braintree_Transaction::SUBMITTED_FOR_SETTLEMENT:

                /* // special case

                // check if userOrder only has this shopOrder and this shopOrder only has 1 item
                // if yes do void
                // else, do the usual queuing method.
                $userOrder = $shopOrder->userOrder;

                if( $userOrder->shopOrders()->count() == 1 &&
                    $shopOrder->cartItems()->count() == 1 &&
                    $shopOrder->cartItems()->first()->quantity == 1) {

                    Log::info("Only one shop order, and only one item with quantity 1");

                    // if bt transaction status == authorized/submitted for settlement
                    // do a void instead of refund
                    $result = Braintree_Transaction::void($transactionId);

                    if ($result->success) {
                        // refund status id 3: Refunded
                        $shopOrderRefund->refundStatus()->associate(RefundStatus::find(3));
                        $shopOrderRefund->save();
                        $shopOrderRefund->braintree_transaction_id = $transaction->id;
                        $shopOrderRefund->save();

                        $hashids = new Hashids("refunds", 10, "ABCDEF1234567890");
                        $shopOrderRefund->uid = $hashids->encode($shopOrderRefund->id);
                        $shopOrderRefund->save();

                        // // set the RETURNED (not RETURN) amount on refunded cart item
                        foreach ($returnCartItems as $cartId => $returnAmount) {
                            if ($returnAmount > 0) {
                                $cartItem = CartItem::find($cartId);

                                // set refunded points property
                                $singleItemRefundablePoints = ceil($cartItem->refundable_points / ($cartItem->quantity - $cartItem->returned));
                                $cartItem->refundable_points = $cartItem->refundable_points - $singleItemRefundablePoints;
                                $cartItem->refunded_points = $cartItem->refunded_points + $singleItemRefundablePoints;

                                // set RETURNED
                                $cartItem->returned = $cartItem->returned + $returnAmount;
                                $cartItem->return = 0;

                                $cartItem->save();
                            }
                        }

                        // // set the shop order refunded_amount and refundable_amount
                        $totalRefundedAmount = $shopOrder->refunded_amount + $refundAmount;
                        $totalRefundedPoints = $shopOrder->refunded_points + $refundPoints;

                        $shopOrder->refunded_amount = $totalRefundedAmount;
                        $shopOrder->refundable_amount = $shopOrder->total_payable_price - $totalRefundedAmount;

                        $shopOrder->refunded_points = $totalRefundedPoints;
                        $shopOrder->refundable_points = $shopOrder->refundable_points - $totalRefundedPoints;

                        // if all cart items in the shop order has been refunded
                        // if (qty - returned) > 0 exists for one cart item, not cancelled
                        // else shop order is set to 'cancelled'

                        $cartItems = $shopOrder->cartItems;
                        $cancelled = true;

                        foreach ($cartItems as $cartItem) {
                            $quantity = $cartItem->quantity;
                            $returned = $cartItem->returned;

                            $remainder = $quantity - $returned;

                            if ($remainder > 0) {
                                $cancelled = false;
                                break;
                            }
                        }

                        if ($cancelled) {
                            // set shop order to 'cancelled' status
                            $cancelledOrderStatus = OrderStatus::find(7); // 7 = cancelled
                            $shopOrder->orderStatus()->associate($cancelledOrderStatus);

                            $shopOrder->save();

                            // check parent order (user order)
                            //// take the min id of all shop orders
                            $userOrder = $shopOrder->userOrder;

                            $minOrderStatusId = $userOrder->shopOrders->min('order_status_id');
                            $minOrderStatus = OrderStatus::find($minOrderStatusId);

                            $userOrder->orderStatus()->associate($minOrderStatus);
                            $userOrder->save();
                        }

                        $shopOrder->save();

                        // // give the buyer back their refunded points
                        $buyer = $shopOrder->buyer;
                        $userPoints = $buyer->points;

                        // create user points
                        if (!isset($userPoints)) {
                            $userPoints = new UserPoints();
                            $userPoints->user()->associate($buyer);
                            $userPoints->save();
                        }

                        $userPoints->amount = $userPoints->amount + $refundPoints;
                        $userPoints->save();

                        $json = array("status" => "200",
                            "message" => "success",
                            "braintree_result" => array(
                                "braintree_transaction_type" => $result->transaction->type,
                                "braintree_transaction_amount" => $result->transaction->amount
                            ),
                            "shop_order_refund" => $shopOrderRefund
                        );

                        // send refund approved push notification and email to shop and shopper
                        $message = $shopOrder->user->username . " has approved your refund request.";
                        SprubixQueue::queuePushNotification($shopOrder->buyer, $message);
                        SprubixQueue::queueRefundApprovedEmail($shopOrderRefund);

                        // Mixpanel - People - Refund Points (Add) and Revenue (Deduct)
                        $mixpanel = Mixpanel::getInstance(env("MIXPANEL_TOKEN"));
                        $mixpanel->people->increment($buyer->id, "Points", $userPoints);
                        $mixpanel->people->trackCharge($buyer->id, -$refundAmount);

                    } else {
                        $refundTransactionStatus = $result->transaction->status;
                        $processorSettlementResponseCode = $result->transaction->processorSettlementResponseCode;
                        $processorSettlementResponseText = $result->transaction->processorSettlementResponseText;

                        //Log::info($result);

                        throw new \Exception("Void Failed. Void Transaction Status: " . $refundTransactionStatus . "SettlementResponseCode: " . $processorSettlementResponseCode . "SettlementResponseText: " . $processorSettlementResponseText);
                    }

                } else {
                */

                // not yet settled
                //$delay = 6*3600;

                // refund status id 2: Request Queued
                $shopOrderRefund->refundStatus()->associate(RefundStatus::find(2));
                $shopOrderRefund->save();

                // queue refund
                //SprubixQueue::queueRefund($shopOrder, $shopOrderRefund, $returnCartItems, $refundAmount, $refundPoints, $delay);

                $json = array("status" => "200",
                    "message" => "refund_queued",
                    "shop_order_refund" => $shopOrderRefund
                );

                Log::info("BT Authorized/Submitted for Settlement - Refund Queued for 6 hours.");

                break;

            default:
                throw new \Exception("Refund Failed. Transaction status is ' . $status . '. Only Settled or Settling transactions can be refunded, and Authorized/Submitted for settlement transactions can be queued for a refund.");
        }

        return $json;
    }
}

