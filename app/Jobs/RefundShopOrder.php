<?php

namespace App\Jobs;

use App\Facades\SprubixQueue;
use App\Jobs\Job;
use App\Models\CartItem;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Config;
use Braintree_Transaction;
use Braintree_Configuration;
use App\Models\RefundStatus;
use App\Models\ShopOrder;
use App\Models\ShopOrderRefund;
use Hashids\Hashids;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class RefundShopOrder extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $shopOrder;
    protected $shopOrderRefund;
    protected $returnCartItems;
    protected $refundAmount;
    protected $refundPoints;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ShopOrder $shopOrder, ShopOrderRefund $shopOrderRefund, $returnCartItems, $refundAmount, $refundPoints, $queueName)
    {
        //
        $this->shopOrder = $shopOrder;
        $this->shopOrderRefund = $shopOrderRefund;
        $this->returnCartItems = $returnCartItems;
        $this->refundAmount = $refundAmount;
        $this->refundPoints = $refundPoints;
        $this->onQueue($queueName);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try {
            // Braintree refund
            // // to determine the status, retrieve the braintree transaction
            $userOrder = $this->shopOrder->userOrder;
            $transactionId = $userOrder->braintree_transaction_id;

            // set up braintree environment (looks like this always has to be done)
            Braintree_Configuration::environment(Config::get('app.braintree_environment'));
            Braintree_Configuration::merchantId(Config::get('app.braintree_merchantid'));
            Braintree_Configuration::publicKey(Config::get('app.braintree_public_key'));
            Braintree_Configuration::privateKey(Config::get('app.braintree_private_key'));

            $transaction = Braintree_Transaction::find($transactionId);
            $status = $transaction->status;

            Log::info("BT Status: " . $status);

            switch($status) {
                case Braintree_Transaction::SETTLED:
                case Braintree_Transaction::SETTLING:

                    // do the refund
                    $result = Braintree_Transaction::refund($transactionId, $this->refundAmount);

                    if ($result->success) {
                        $transaction = $result->transaction;

                        // success
                        // refund status id 3: Refunded
                        $this->shopOrderRefund->refundStatus()->associate(RefundStatus::find(3));
                        $this->shopOrderRefund->shopOrder()->associate($this->shopOrder);
                        $this->shopOrderRefund->braintree_transaction_id = $transaction->id;
                        $this->shopOrderRefund->save();

                        $hashids = new Hashids("refunds", 10, "ABCDEF1234567890");
                        $this->shopOrderRefund->uid = $hashids->encode($this->shopOrderRefund->id);
                        $this->shopOrderRefund->save();

                        // // set the RETURNED (not RETURN) amount on refunded cart item
                        foreach($this->returnCartItems as $cartId => $returnAmount) {
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
                        $totalRefundedAmount = $this->shopOrder->refunded_amount + $this->refundAmount;
                        $totalRefundedPoints = $this->shopOrder->refunded_points + $this->refundPoints;

                        $this->shopOrder->refunded_amount = $totalRefundedAmount;
                        $this->shopOrder->refundable_amount = $this->shopOrder->total_price - $totalRefundedAmount;

                        $this->shopOrder->refunded_points = $totalRefundedPoints;
                        $this->shopOrder->refundable_points = $this->shopOrder->refundable_points - $totalRefundedPoints;

                        // if all cart items in the shop order has been refunded
                        // if (qty - returned) > 0 exists for one cart item, not cancelled
                        // else shop order is set to 'cancelled'

                        $cartItems = $this->shopOrder->cartItems;
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
                            $this->shopOrder->orderStatus()->associate($cancelledOrderStatus);

                            $this->shopOrder->save();

                            // check parent order (user order)
                            //// take the min id of all shop orders
                            $userOrder = $this->shopOrder->userOrder;

                            $minOrderStatusId = $userOrder->shopOrders->min('order_status_id');
                            $minOrderStatus = OrderStatus::find($minOrderStatusId);

                            $userOrder->orderStatus()->associate($minOrderStatus);
                            $userOrder->save();
                        }

                        $this->shopOrder->save();

                        // // give the buyer back their refunded points
                        $buyer = $this->shopOrder->buyer;
                        $userPoints = $buyer->points;

                        // create user points
                        if(!isset($userPoints)) {
                            $userPoints = new UserPoints();
                            $userPoints->user()->associate($buyer);
                            $userPoints->save();
                        }

                        $userPoints->amount = $userPoints->amount + $this->refundPoints;
                        $userPoints->save();

                        // send refund approved push notification and email to shop and shopper
                        $message = $this->shopOrder->user->username . " has approved your refund request.";
                        SprubixQueue::queuePushNotification($this->shopOrder->buyer, $message);
                        SprubixQueue::queueRefundApprovedEmail($this->shopOrderRefund);

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
                    // not yet settled
                    // // send to IronMQ with delay of 6 hours
                    //$delay = 6*3600;

                    // refund status id 2: Request Queued
                    $this->shopOrderRefund->refundStatus()->associate(RefundStatus::find(2));
                    $this->shopOrderRefund->save();

                    // queue refund
                    //SprubixQueue::queueRefund($this->shopOrder, $this->shopOrderRefund, $this->returnCartItems, $this->refundAmount, $this->refundPoints, $delay);

                    Log::info("OK Queue again for 6 hours, still unrefundable...");

                    break;

                default:
                    throw new \Exception("Refund Failed. Transaction status is ' . $status . '. Only Settled or Settling transactions can be refunded, and Authorized/Submitted for settlement transactions can be queued for a refund.");
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
