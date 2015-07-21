<?php namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DeliveryOption;
use App\Models\User;
use App\Models\ShopOrder;
use App\Models\UserOrder;
use App\Models\OrderStatus;
use App\Models\UserPaymentMethod;
use App\Models\UserShippingAddress;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Braintree_Transaction;
use Braintree_Configuration;
use Log;

class OrderController extends Controller {

    public function orderStatuses(Request $request) {
        $user = $request->user();

        $permittedOrderStatuses = $user->shoppable->order_statuses;

        $orderStatuses = OrderStatus::find($permittedOrderStatuses);

        return response()->json($orderStatuses)->setCallback($request->input('callback'));
    }

    public function userOrders(Request $request) {
        $user = $request->user();
        $orderStatusIds = $request->get("order_status_ids");

        $query = $user->orders()->with("shopOrders", "user")->whereIn("order_status_id", $orderStatusIds)->orderBy('created_at', 'desc');

        $orders = $query->paginate(15);

        return response()->json($orders)->setCallback($request->input('callback'));
    }

    public function userShopOrders(Request $request) {
        $shopOrderIds = $request->get("shop_order_ids");

        $userShopOrders = ShopOrder::whereIn('id', $shopOrderIds)->with("user", "buyer", "shippingAddress", "orderStatus", "deliveryOption", "cartItems.piece")->paginate(15);

        return response()->json($userShopOrders)->setCallback($request->input('callback'));
    }

    public function shopOrders(Request $request) {
        $shop = $request->user();
        $orderStatusIds = $request->get("order_status_ids");
        
        $query = $shop->shopOrders()->with("user", "buyer", "shippingAddress", "orderStatus", "deliveryOption", "cartItems.piece")->whereIn("order_status_id", $orderStatusIds)->orderBy('created_at', 'desc');

        $orders = $query->paginate(15);

        return response()->json($orders)->setCallback($request->input('callback'));
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
            $totalShippingRate = $request->get("total_shipping_rate");
            $totalPrice = $request->get("total_price");
            $totalPoints = $request->get("total_points");
            $sellers = $request->get("sellers");

            $shippingAddressId = $request->get("delivery_address_id");
            $paymentMethodId = $request->get("payment_method_id");

            // create user order
            $userOrder = new UserOrder();
            $userOrder->total_price = $totalPrice;
            $userOrder->total_items_price = $totalItemsPrice;
            $userOrder->total_shipping_rate = $totalShippingRate;
            $userOrder->braintree_transaction_id = $transactionId;
            $userOrder->total_points = $totalPoints;

            /*$userPoints = $user->points;

            // create user points
            if(!isset($userPoints)) {
                $userPoints = new UserPoints();
                $userPoints->user()->associate($user);
                $userPoints->save();
            }

            $userPoints->amount = $totalPoints;
            $userPoints->expire_at = Carbon::now()->addMonth(3); // 3 months from now
            $userPoints->save();*/

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
            $hashids = new Hashids("user_orders", 8, "ABCDEF1234567890");
            $userOrder->uid = $hashids->encode($userOrder->id);
            $userOrder->save();

            $cartItems = $user->cart->cartItems;

            foreach($sellers as $seller) {
                $sellerId = $seller["seller_id"];
                $deliveryOptionId = $seller["delivery_option_id"];
                $shippingRate = $seller["shipping_rate"];
                $itemsPrice = $seller["items_price"];
                $sellerTotalPrice = $seller["total_price"];

                // create individual shop orders
                $shopOrder = new ShopOrder();
                $shopOrder->items_price = $itemsPrice;
                $shopOrder->shipping_rate = $shippingRate;
                $shopOrder->total_price = $sellerTotalPrice;

                $shopOrder->user()->associate(User::find($sellerId));
                $shopOrder->buyer()->associate($user);
                $shopOrder->userOrder()->associate($userOrder);
                $shopOrder->deliveryOption()->associate(DeliveryOption::find($deliveryOptionId));

                $shopOrder->shippingAddress()->associate(UserShippingAddress::find($shippingAddressId));
                $shopOrder->paymentMethod()->associate(UserPaymentMethod::find($paymentMethodId));
                $shopOrder->orderStatus()->associate($userOrder->orderStatus);

                $shopOrder->save();

                // generate user order uid
                $hashids = new Hashids("shop_orders", 8, "ABCDEF1234567890");
                $shopOrder->uid = $hashids->encode($shopOrder->id);
                $shopOrder->save();

                // for cart items bought from this seller, set it to this shopOrder
                foreach($cartItems as $cartItem) {
                    if($cartItem->seller_id == $sellerId) {
                        // match
                        $cartItem->shopOrder()->associate($shopOrder);
                        $cartItem->save();
                    }
                }
            }

            // finally, give user a new cart
            // // old cart must be maintained for recording purpose
            $user->cart->delete();
            $newCart = new Cart();
            $newCart->user()->associate($user);
            $newCart->save();

            $json = array("status" => "200",
                "message" => "success"
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