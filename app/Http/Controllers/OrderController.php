<?php namespace App\Http\Controllers;

use App\Facades\SprubixQueue;
use App\Models\Cart;
use App\Models\DeliveryOption;
use App\Models\Outfit;
use App\Models\User;
use App\Models\ShopOrder;
use App\Models\UserOrder;
use App\Models\OrderStatus;
use App\Models\UserPaymentMethod;
use App\Models\UserPoints;
use App\Models\UserShippingAddress;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Braintree_Transaction;
use Braintree_Configuration;
use Illuminate\Support\Facades\Log;
use Mixpanel;

class OrderController extends Controller {

    public function orderStatuses(Request $request) {
        $user = Auth::user();

        $permittedOrderStatuses = $user->shoppable->order_statuses;

        $orderStatuses = OrderStatus::find($permittedOrderStatuses);

        return response()->json($orderStatuses)->setCallback($request->input('callback'));
    }

    public function userOrders(Request $request) {
        $user = Auth::user();
        $orderStatusIds = $request->get("order_status_ids");

        $query = $user->orders()->with("shopOrders", "user.userInfo")->whereIn("order_status_id", $orderStatusIds)->orderBy('created_at', 'desc');

        $orders = $query->paginate(15);

        return response()->json($orders)->setCallback($request->input('callback'));
    }

    public function userOrder(Request $request) {
        $userOrderId = $request->get("user_order_id");

        $userOrder = UserOrder::with("shippingAddress")->with(array("shopOrders" => function($query) {
                $query->with("user", "orderStatus");
            }))->find($userOrderId);

        return response()->json($userOrder)->setCallback($request->input('callback'));
    }

    public function userShopOrders(Request $request) {
        $input = $request->all();

        $query = ShopOrder::search($input)->with("user", "buyer", "shippingAddress", "orderStatus", "deliveryOption", "cartItems.piece")->orderBy('created_at', 'desc');

        $userShopOrders = $query->paginate(15)->toJson();
        $userTotalSpending = $query->sum("total_price");

        $json = array("status" => "200",
            "message" => "success",
            "total_spending" => $userTotalSpending,
            "user_shop_orders" => $userShopOrders
        );

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function shopOrders(Request $request) {
        $shop = Auth::user();
        $orderStatusIds = $request->get("order_status_ids");
        $shopOrderIds = $request->get("shop_order_ids");

        if(isset($orderStatusIds)) {
            $query = $shop->shopOrders()->with("user.userInfo", "buyer", "shopOrderRefunds.refundStatus", "shopOrderRefunds.user", "shippingAddress", "orderStatus", "deliveryOption", "cartItems.piece")->whereIn("order_status_id", $orderStatusIds)->orderBy('created_at', 'desc');
        } else if (isset($shopOrderIds)) {
            $query = ShopOrder::whereIn('id', $shopOrderIds)->with("user.userInfo", "buyer", "shopOrderRefunds.refundStatus", "shopOrderRefunds.user", "shippingAddress", "orderStatus", "deliveryOption", "cartItems.piece");
        }

        $orders = $query->paginate(15);

        return response()->json($orders)->setCallback($request->input('callback'));
    }

    public function updateShopOrder(Request $request, ShopOrder $shopOrder) {
        try {
            $newOrderStatusId = $request->get("order_status_id");
            $newOrderStatus = OrderStatus::find($newOrderStatusId);

            $shopOrder->orderStatus()->associate($newOrderStatus);
            $shopOrder->save();

            // allocate points if shopOrder has been received
            if ($shopOrder->orderStatus->id == 4) {
                // shipping received

                $user = $shopOrder->buyer;
                $userPoints = $user->points;
                $userOrder = $shopOrder->userOrder;
                $fraction = $shopOrder->total_price / $userOrder->total_price;

                // create user points
                if(!isset($userPoints)) {
                    $userPoints = new UserPoints();
                    $userPoints->user()->associate($user);
                    $userPoints->save();
                }

                $userPoints->amount = $userPoints->amount + ($fraction * $userOrder->total_points);
                $userPoints->save();
            }

            // send mandrill shop order update email
            SprubixQueue::queueShopOrderUpdateEmail($shopOrder);

            // check if userOrder's shopOrders have all changed to the new status
            //// take the min id of all shop orders
            $userOrder = $shopOrder->userOrder;

            $minOrderStatusId = $userOrder->shopOrders->min('order_status_id');
            $minOrderStatus = OrderStatus::find($minOrderStatusId);

            $userOrder->orderStatus()->associate($minOrderStatus);
            $userOrder->save();

            $json = array("status" => "200",
                "message" => "success",
                "order_status" => $newOrderStatus
            );

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function createOrder(Request $request) {
        // user order
        // // total_price
        // // items_price
        // // shipping_rate
        // // total_points

        // create each shop order separately
        // // total_price
        // // items_price
        // // shipping_rate
        // // all relationships to respective models
        // // // selected delivery option
        // // // selected shipping address
        // // // selected payment method

        try {
            $user = Auth::user();
            $transactionId = $request->get("braintree_transaction_id");
            $totalItemsPrice = $request->get("total_items_price");

            $totalPayablePrice = $request->get("total_payable_price");
            $totalDiscount = $request->get("total_discount");
            $pointsApplied = $request->get("points_applied");

            $totalShippingRate = $request->get("total_shipping_rate");
            $totalPrice = $request->get("total_price");
            $totalPoints = $request->get("total_points");
            $outfitContributorsData = $request->get("outfit_contributors_data");
            $sellers = $request->get("sellers");

            $itemPayablePrices = $request->get("item_payable_prices");
            $itemDiscounts = $request->get("item_discounts");
            $itemPointsApplied = $request->get("item_points_applied");

            $shippingAddressId = $request->get("delivery_address_id");
            $paymentMethodId = $request->get("payment_method_id");

            // create user order
            $userOrder = new UserOrder();
            $userOrder->total_price = $totalPrice;
            $userOrder->total_items_price = $totalItemsPrice;
            $userOrder->total_payable_price = $totalPayablePrice;
            $userOrder->total_discount = $totalDiscount;
            $userOrder->points_applied = $pointsApplied;
            $userOrder->total_shipping_rate = $totalShippingRate;
            $userOrder->braintree_transaction_id = $transactionId;
            $userOrder->total_points = $totalPoints;

            $userOrder->shippingAddress()->associate(UserShippingAddress::find($shippingAddressId));
            $userOrder->paymentMethod()->associate(UserPaymentMethod::find($paymentMethodId));
            $userOrder->user()->associate($user);

            // set up braintree environment (looks like this always has to be done)
            Braintree_Configuration::environment(Config::get('app.braintree_environment'));
            Braintree_Configuration::merchantId(Config::get('app.braintree_merchantid'));
            Braintree_Configuration::publicKey(Config::get('app.braintree_public_key'));
            Braintree_Configuration::privateKey(Config::get('app.braintree_private_key'));

            // // to determine the status, retrieve the braintree transaction
            $transaction = Braintree_Transaction::find($transactionId);

            $status = $transaction->status;
            $statusCode = "";
            $statusText = "";

            switch($status) {
                case Braintree_Transaction::AUTHORIZATION_EXPIRED:
                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                    break;

                case Braintree_Transaction::AUTHORIZING:
                    // order status id 1: Processing
                    $userOrder->orderStatus()->associate(OrderStatus::find(1));

                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
                    break;

                case Braintree_Transaction::SETTLEMENT_PENDING: // only for paypal
                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
                    break;

                case Braintree_Transaction::SETTLEMENT_DECLINED:
                    // order status id 5: Payment Failed
                    $userOrder->orderStatus()->associate(OrderStatus::find(5));

                    $statusCode .= $transaction->processorSettlementResponseCode;
                    $statusText .= $transaction->processorSettlementResponseText;
                    break;

                case Braintree_Transaction::FAILED:
                    // order status id 5: Payment Failed
                    $userOrder->orderStatus()->associate(OrderStatus::find(5));

                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
                    break;

                case Braintree_Transaction::GATEWAY_REJECTED:
                    // order status id 5: Payment Failed
                    $userOrder->orderStatus()->associate(OrderStatus::find(5));

                    $statusCode .= "nil";
                    $statusText .= $transaction->gatewayRejectionReason;
                    break;

                case Braintree_Transaction::PROCESSOR_DECLINED:
                    // order status id 5: Payment Failed
                    $userOrder->orderStatus()->associate(OrderStatus::find(5));

                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
                    break;

                case Braintree_Transaction::SETTLED:
                    // order status id 2: Shipping Requested
                    $userOrder->orderStatus()->associate(OrderStatus::find(2));

                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
                    break;

                case Braintree_Transaction::SETTLING:
                    // order status id 2: Shipping Requested
                    $userOrder->orderStatus()->associate(OrderStatus::find(2));

                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
                    break;

                case Braintree_Transaction::VOIDED:
                    // order status id 7: Cancelled
                    $userOrder->orderStatus()->associate(OrderStatus::find(7));

                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
                    break;

                case Braintree_Transaction::AUTHORIZED:
                case Braintree_Transaction::SUBMITTED_FOR_SETTLEMENT:
                    // success
                    // order status id 2: Shipping Requested
                    $userOrder->orderStatus()->associate(OrderStatus::find(2));

                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
                    break;

                default:
                    $statusCode .= $transaction->processorResponseCode;
                    $statusText .= $transaction->processorResponseText . "\nAdditional: " . $transaction->additionalProcessorResponse;
            }

            $userOrder->braintree_payment_status = $status;
            $userOrder->braintree_payment_status_code = $statusCode;
            $userOrder->braintree_payment_status_text = $statusText;

            $userOrder->save();

            // generate user order uid
            $hashids = new Hashids("user_orders", 10, "ABCDEF1234567890");
            $userOrder->uid = $hashids->encode($userOrder->id);
            $userOrder->save();

            $cartItems = $user->cart->cartItems;

            // set the payable price for each cart item
            foreach($cartItems as $cartItem) {

                if(count($itemPayablePrices) > 0 && count($itemDiscounts) > 0 && count($itemPointsApplied) > 0) {

                    if(array_key_exists($cartItem->id, $itemPayablePrices) && array_key_exists($cartItem->id, $itemDiscounts) && array_key_exists($cartItem->id, $itemPointsApplied)) {
                        $itemPayablePrice = $itemPayablePrices[$cartItem->id];
                        $itemDiscount = $itemDiscounts[$cartItem->id];
                        $itemPointApplied = $itemPointsApplied[$cartItem->id];

                        if(isset($itemPayablePrice) && isset($itemDiscount) && isset($itemPointApplied)) {
                            $cartItem->total_payable_price = $itemPayablePrice;
                            $cartItem->total_discount = $itemDiscount;
                            $cartItem->points_applied = $itemPointApplied;
                            $cartItem->refundable_points = $itemPointApplied;

                            $cartItem->save();
                        }
                    } else {
                        $cartItemPiece = $cartItem->piece;

                        $cartItem->total_payable_price = $cartItemPiece->price;
                        $cartItem->total_discount = 0;
                        $cartItem->points_applied = 0;
                        $cartItem->refundable_points = 0;

                        $cartItem->save();
                    }
                } else {
                    $cartItemPiece = $cartItem->piece;

                    $cartItem->total_payable_price = $cartItemPiece->price;
                    $cartItem->total_discount = 0;
                    $cartItem->points_applied = 0;
                    $cartItem->refundable_points = 0;

                    $cartItem->save();
                }
            }

            foreach($sellers as $seller) {
                $sellerId = $seller["seller_id"];
                $deliveryOptionId = $seller["delivery_option_id"];
                $shippingRate = $seller["shipping_rate"];
                $itemsPrice = $seller["items_price"];
                $sellerTotalPrice = $seller["total_price"];

                $sellerTotalPayablePrice = $seller["total_payable_price"];
                $sellerTotalDiscount = $seller["total_discount"];
                $sellerPointsApplied = $seller["points_applied"];

                // create individual shop orders
                $shopOrder = new ShopOrder();
                $shopOrder->items_price = $itemsPrice;
                $shopOrder->shipping_rate = $shippingRate;
                $shopOrder->total_price = $sellerTotalPrice;

                $shopOrder->refundable_amount = $sellerTotalPayablePrice;
                $shopOrder->refundable_points = $sellerPointsApplied;

                $shopOrder->total_payable_price = $sellerTotalPayablePrice;
                $shopOrder->total_discount = $sellerTotalDiscount;
                $shopOrder->points_applied = $sellerPointsApplied;

                $shopOrder->user()->associate(User::find($sellerId));
                $shopOrder->buyer()->associate($user);
                $shopOrder->userOrder()->associate($userOrder);
                $shopOrder->deliveryOption()->associate(DeliveryOption::find($deliveryOptionId));

                $shopOrder->shippingAddress()->associate(UserShippingAddress::find($shippingAddressId));
                $shopOrder->paymentMethod()->associate(UserPaymentMethod::find($paymentMethodId));
                $shopOrder->orderStatus()->associate($userOrder->orderStatus);

                $shopOrder->save();

                // generate user order uid
                $hashids = new Hashids("shop_orders", 10, "ABCDEF1234567890");
                $shopOrder->uid = $hashids->encode($shopOrder->id);
                $shopOrder->save();

                // for cart items bought from this seller, set it to this shopOrder
                foreach($cartItems as $cartItem) {
                    if($cartItem->seller_id == $sellerId) {
                        // match
                        $cartItem->shopOrder()->associate($shopOrder);
                        $cartItem->save();

                        // deduct shop's stock quantity
                        $piece = $cartItem->piece;
                        $quantity = json_decode($piece->quantity);

                        $orderedSize = $cartItem->size;
                        $newQuantity = (int)$quantity->$orderedSize - $cartItem->quantity;
                        $quantity->$orderedSize = "$newQuantity";

                        $piece->quantity = json_encode($quantity);
                        $piece->save();
                    }
                }
            }

            // deduct points from user info
            $userPoints = $user->points;

            $remainingPoints = $userPoints->amount - $pointsApplied;

            if ($remainingPoints >= 0) {
                $userPoints->amount = $remainingPoints;
                $userPoints->expire_at = Carbon::now()->addMonth(3); // 3 months from now
                $userPoints->save();
            } else {
                throw new \Exception("Points deduction failed. Points applied is greater than what is available for deduction.");
            }

            // Mixpanel - People - Points (Deduct)
            $mixpanel = Mixpanel::getInstance(env("MIXPANEL_TOKEN"));
            $mixpanel->people->increment($user->id, "Points", -$pointsApplied);

            // allocate points to contributors
            //// find out who were the ones who do not have shop orders
            //// and give them points
            foreach($outfitContributorsData as $outfitId => $contributorData) {

                $outfit = Outfit::find($outfitId);

                $boughtPieceIds = $contributorData["bought_piece_ids"];
                $contributorPointsEarned = $contributorData["contributor_points_earned"];

                $pieces = $outfit->pieces;
                $contributors = array();

                foreach($pieces as $unboughtPiece) {
                    if(!in_array($unboughtPiece->id, $boughtPieceIds)) {
                        // if piece is not inside bought pieces
                        // it is from a contributor
                        $pieceOwner = $unboughtPiece->user;

                        // make sure pieceOwner != buyer
                        if($pieceOwner->id != $user->id) {
                            $contributors[] = $pieceOwner;
                        }
                    }
                }

                // add posted by (most recent sprucer) and inspired by (previous sprucer) as contributors
                $outfitPostedByUser = $outfit->user;
                $outfitInspiredByUser = $outfit->inspiredBy;

                if(isset($outfitInspiredByUser) && $outfitInspiredByUser->id != $outfitPostedByUser->id) {
                    // this outfit was inspired by someone else
                    if($outfitPostedByUser->id != $user->id) {
                        // always make sure its not from the buyer
                        $contributors[] = $outfitPostedByUser;
                    }

                    if($outfitInspiredByUser->id != $user->id) {
                        // always make sure its not from the buyer
                        $contributors[] = $outfitInspiredByUser;
                    }
                } else {
                    // this outfit is originally posted by $outfitPostedByUser only
                    if($outfitPostedByUser->id != $user->id) {
                        // always make sure its not from the buyer
                        $contributors[] = $outfitPostedByUser;
                    }
                }

                // make sure contributors are unique
                $contributors = array_unique($contributors);

                // divide the contributor points equality amongst the contributors
                $pointsPerContributor = $contributorPointsEarned / count($contributors);
                $pointsPerContributor = ceil($pointsPerContributor);

                $contributionArray = array();

                // distribute the points
                foreach($contributors as $contributor) {
                    $contributorPoints = $contributor->points;

                    if(!isset($contributorPoints)) {
                        $contributorPoints = new UserPoints();
                        $contributorPoints->amount = $pointsPerContributor;
                        $contributorPoints->expire_at = Carbon::now()->addMonth(3); // 3 months from now
                        $contributorPoints->user()->associate($contributor);
                    } else {
                        $contributorPoints->amount = $contributorPoints->amount + $pointsPerContributor;
                    }

                    $contributorPoints->save();

                    $contribution = new \stdClass();
                    $contribution->contributor = $contributor;
                    $contribution->awarded_points = $pointsPerContributor;
                    $contribution->outfit = $outfit;
                    $contributionArray[] = $contribution;

                    // Mixpanel - People - Contributors Points (Add)
                    $mixpanel->people->increment($contributor->id, "Points", $pointsPerContributor);
                }
            }

            // finally, give user a new cart
            // // old cart must be maintained for recording purpose
            $user->cart->delete();
            $newCart = new Cart();
            $newCart->user()->associate($user);
            $newCart->save();

            // send mandrill order email
            SprubixQueue::queueOrderConfirmationEmail($userOrder->id);

            $json = array("status" => "200",
                "message" => "success",
                "user_order_id" => $userOrder->id,
                "contributions" => $contributionArray
            );

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }
}