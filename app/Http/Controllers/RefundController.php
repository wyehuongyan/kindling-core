<?php namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\RefundStatus;
use App\Models\Shop;
use App\Models\ShopOrder;
use App\Models\ShopOrderRefund;
use Illuminate\Http\Request;
use Braintree_Transaction;
use Braintree_Configuration;
use Illuminate\Support\Facades\Auth;
use Log;

class RefundController extends Controller {
    public function userRefunds(Request $request) {
        // retrieve refunds belonging to user
        $user = Auth::user();

        if ($user->shoppable instanceof Shop) {
            // shop
            $shopOrderRefunds = ShopOrderRefund::search(array("user_id" => $user->id))->with('user')->paginate(15);
        } else {
            // shopper
            $shopOrderRefunds = ShopOrderRefund::search(array("buyer_id" => $user->id))->with('user')->paginate(15);
        }

        return response()->json($shopOrderRefunds)->setCallback($request->input('callback'));
    }

    public function createRefund(Request $request, ShopOrder $shopOrder) {

        // first time create ShopOrderRefund
        try {
            $shopOrderRefund = $shopOrder->shopOrderRefund;

            if(!isset($shopOrderRefund)) {
                $refundAmount = $request->get("refund_amount");
                $refundReason = $request->get("refund_reason");

                if ($refundAmount > $shopOrder->total_price) {
                    // when refund price exceeds total price
                    throw new Exception("Refund Failed. The refund amount is greater than the total shop order price.");

                } else {
                    $shopOrderRefund = new ShopOrderRefund();
                    $shopOrderRefund->uid = $shopOrder->uid;
                    $shopOrderRefund->refund_amount = $refundAmount;
                    $shopOrderRefund->refund_reason = $refundReason;
                    $shopOrderRefund->user()->associate($shopOrder->user);
                    $shopOrderRefund->buyer()->associate($shopOrder->buyer);

                    if($request->get("request_for_refund") == true) {
                        // refund status id 1: Request for refund
                        $shopOrderRefund->refundStatus()->associate(RefundStatus::find(1));
                        $shopOrderRefund->shopOrder()->associate($shopOrder);
                        $shopOrderRefund->save();

                        // // set the RETURN amount on refunded cart item
                        $returnCartItems = $request->get("return_cart_items");

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


                    } else {
                        // refund status id 2: Refunded

                        // Braintree refund
                        // // to determine the status, retrieve the braintree transaction
                        $userOrder = $shopOrder->userOrder();
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
                                    // success
                                    $shopOrderRefund->refundStatus()->associate(RefundStatus::find(2));
                                    $shopOrderRefund->shopOrder()->associate($shopOrder);
                                    $shopOrderRefund->save();

                                    // // set the RETURNED (not RETURN) amount on refunded cart item
                                    $returnCartItems = $request->get("return_cart_items");

                                    foreach($returnCartItems as $cartId => $returnAmount) {
                                        $cartItem = CartItem::find($cartId);

                                        $cartItem->returned = $returnAmount;
                                        $cartItem->save();
                                    }

                                    $json = array("status" => "200",
                                        "message" => "success",
                                        "braintree_result" => array(
                                            "braintree_transaction_type" => $result->transaction->type,
                                            "braintree_transaction_amount" => $result->transaction->amount
                                        ),
                                        "shop_order_refund" => $shopOrderRefund
                                    );

                                    // send refunded success push notification and email to shop and shopper

                                } else {
                                    $refundTransactionStatus = $result->transaction->status;
                                    $processorSettlementResponseCode = $result->transaction->processorSettlementResponseCode;
                                    $processorSettlementResponseText = $result->transaction->processorSettlementResponseText;

                                    throw new Exception("Refund Failed. \nRefund Transaction Status: " . $refundTransactionStatus . "\nSettlementResponseCode: " . $processorSettlementResponseCode. "\nSettlementResponseText: " . $processorSettlementResponseText);
                                }

                                break;

                            case Braintree_Transaction::AUTHORIZED:
                            case Braintree_Transaction::SUBMITTED_FOR_SETTLEMENT:
                                // not yet settled
                                // // send to IronMQ with delay of two days

                                // send refund processing push notification and email to shop and shopper

                                break;

                            default:
                                throw new Exception("Refund Failed. \nTransaction status is ' . $status . '. \nOnly Settled or Settling transactions can be refunded, and Authorized/Submitted for settlement transactions can be queued for a refund.");
                        }
                    }
                }
            } else {
                $json = array("status" => "500",
                    "message" => "There's already an existing refund for this shop order.",
                    "shop_order_refund" => $shopOrderRefund
                );
            }

        }  catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function updateRefund(Request $request, ShopOrder $shopOrder) {
        // may have to move RETURN quantity over to RETURNED

        // this function is called when shop approve the refund request
    }
}

