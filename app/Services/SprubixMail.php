<?php namespace App\Services;

use App\Models\ShopOrder;
use App\Models\ShopOrderRefund;
use Hashids\Hashids;
use Mandrill;
use Mandrill_Error;
use App\Models\User;
use Log;
use Carbon\Carbon;

class SprubixMail {

    public function __construct() {
        //$this->mandrill = new Mandrill(env('MANDRILL_TEST_KEY'));
        $this->mandrill = new Mandrill(env('MANDRILL_KEY'));
    }

    public function sendEmailVerification(User $user) {
        try {
            if(!isset($user->verification_code) || $user->verification_code == "") {
                $hashids = new Hashids("user_email_verification", 32, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890");
                $user->verification_code = $hashids->encode($user->id);

                $user->save();
            }

            $recipientEmail = $user->email;
            $recipientName = $user->username;
            $verificationCode = $user->verification_code;
            $verificationURL = "http://sprubix-wh.ngrok.io/~wyehuongyan/kindling-core/public/index.php" . "/auth/email/verify?id=" . $user->id . "&vc=" . $verificationCode;

            // user mandrill subaccount id
            $userMandrillSubaccountId = $user->mandrill_subaccount_id;

            // template slug name in Mandrill
            $template_name = 'onboarding-confirm-email-address';
            $template_content = array();
            $message = array(
                'subject' => "Please verify your email with Sprubix",
                'from_email' => 'email-verification@sprubix.com',
                'from_name' => 'Team Sprubix',
                'to' => array(
                    array(
                        'email' => $recipientEmail,
                        'name' => $recipientName,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'no-reply@sprubix.com'),
                "auto_text" => true,
                "inline_css" => true,
                'merge' => true,
                'merge_language' => 'handlebars',
                "global_merge_vars" => array(
                    array(
                        'name' => 'order_query_email',
                        'content' => 'support@sprubix.com'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $recipientEmail,
                        'vars' => array(
                            array(
                                'name' => 'user_name',
                                'content' => $recipientName
                            ),
                            array(
                                'name' => 'verification_url',
                                'content' => $verificationURL
                            )
                        )
                    )
                ),
                'tags' => array('email-verification'),
                'subaccount' => $userMandrillSubaccountId
            );

            $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);

        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            $error = array(
                "status" => "500",
                "message" => $e->getMessage()
            );

            // handle error
            Log::error($error); // log to sentry
        }
    }

    public function sendWelcome(User $user) {
        try {
            $recipientEmail = $user->email;
            $recipientName = $user->username;

            $launchURL = env('URL_SCHEME');

            // user mandrill subaccount id
            $userMandrillSubaccountId = $user->mandrill_subaccount_id;

            // template slug name in Mandrill
            $template_name = 'onboarding-welcome-get-started';
            $template_content = array();
            $message = array(
                'subject' => "Welcome to Sprubix",
                'from_email' => 'welcome@sprubix.com',
                'from_name' => 'Team Sprubix',
                'to' => array(
                    array(
                        'email' => $recipientEmail,
                        'name' => $recipientName,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'no-reply@sprubix.com'),
                "auto_text" => true,
                "inline_css" => true,
                'merge' => true,
                'merge_language' => 'handlebars',
                "global_merge_vars" => array(
                    array(
                        'name' => 'order_query_email',
                        'content' => 'support@sprubix.com'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $recipientEmail,
                        'vars' => array(
                            array(
                                'name' => 'user_name',
                                'content' => $recipientName
                            ),
                            array(
                                'name' => 'launch_url',
                                'content' => $launchURL
                            )
                        )
                    )
                ),
                'tags' => array('email-verification'),
                'subaccount' => $userMandrillSubaccountId
            );

            $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);

        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            $error = array(
                "status" => "500",
                "message" => $e->getMessage()
            );

            // handle error
            Log::error($error); // log to sentry
        }
    }

    public function sendFeedback(User $user, $content) {
        try {
            $support_name = "Team Sprubix";

            $message = array(
                'html' => str_replace("\n", "<br />", $content),
                'text' => $content,
                'subject' => "Feedback from " . $user->username,
                'from_email' => $user->email,
                'from_name' => $user->username,
                'to' => array(
                    array(
                        'email' => env('MANDRILL_SPRUBIX_SUPPORT'),
                        'name' => $support_name,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => $user->email),
                'tags' => array('feedback'),
                'subaccount' => $user->id
            );

            $result = $this->mandrill->messages->send($message);
            $status = $result[0]['status'];

            // handle response
            if ($status != "sent") {
                // some error occured
                // log to sentry
            }

            return $result;

        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            $error = array(
                "status" => "500",
                "message" => $e->getMessage()
            );

            // handle error
            Log::error($error); // log to sentry
        }
    }

    public function sendOrderConfirmation(User $recipient, $userOrder) {
        try {
            // user order
            $recipientEmail = $recipient->email;
            $recipientInfo = $recipient->userInfo;
            $recipientName = $recipientInfo->first_name;
            $recipientMandrillSubaccountId = $recipient->mandrill_subaccount_id;

            if(!isset($recipientName) || $recipientName == "") {
                $recipientName = $recipient->username;
            }

            $userOrderUID = $userOrder->uid;
            $userOrderTotalPayable = $userOrder->total_payable_price;
            $userOrderTotalDiscount = $userOrder->total_discount;
            $userOrderPointsApplied = (int)$userOrder->points_applied;

            // // user payment method
            $paymentMethod = $userOrder->paymentMethod;
            $paymentMethodName = $paymentMethod->card_type . " ending with " . $paymentMethod->redacted_card_num;

            // // user shipping address
            $shippingAddress = $userOrder->shippingAddress;

            $shippingAddressHTML = $shippingAddress->address_1 . "<br>";

            if(isset($shippingAddress->address_2) && $shippingAddress->address_2 != "") {
                $shippingAddressHTML .= $shippingAddress->address_2 . "<br>";
            }

            $shippingAddressHTML .= $shippingAddress->city . "<br>";
            $shippingAddressHTML .= $shippingAddress->state . "<br>";
            $shippingAddressHTML .= $shippingAddress->country . "<br>";
            $shippingAddressHTML .= $shippingAddress->postal_code;

            // shop orders
            $shopOrders = $userOrder->shopOrders;

            // // format shop orders for handlebars display
            $formattedShopOrders = array();

            foreach($shopOrders as $shopOrder) {
                $formattedShopOrder = new \stdClass();

                $formattedShopOrder->uid = $shopOrder->uid;
                $formattedShopOrder->items_price = $shopOrder->items_price;
                $formattedShopOrder->shipping_rate = $shopOrder->shipping_rate;
                $formattedShopOrder->total_price = $shopOrder->total_price;

                // // delivery info
                $deliveryOption = $shopOrder->deliveryOption;
                $formattedShopOrder->shipping_method = $deliveryOption->name;

                // // cart items
                $cartItems = $shopOrder->cartItems;
                $formattedCartItems = array();

                foreach($cartItems as $cartItem) {
                    $formattedCartItem = new \stdClass();

                    $piece = $cartItem->piece;
                    $pieceImages = json_decode($piece->images);
                    $formattedCartItem->image = $pieceImages->cover;
                    $formattedCartItem->name = $piece->name;
                    $formattedCartItem->size = $cartItem->size;
                    $formattedCartItem->quantity = $cartItem->quantity;
                    $formattedCartItem->price = $piece->price;

                    $formattedCartItems[] = $formattedCartItem;
                }

                $formattedShopOrder->cart_items = $formattedCartItems;

                // // seller info
                $seller = $shopOrder->user;
                $formattedShopOrder->seller_image = $seller->image;
                $formattedShopOrder->seller_name = $seller->name;
                $formattedShopOrder->seller_username = $seller->username;
                $formattedShopOrder->seller_email = $seller->email;

                // // buyer info
                $buyer = $shopOrder->buyer;
                $formattedShopOrder->buyer_image = $buyer->image;
                $formattedShopOrder->buyer_name = $buyer->name;
                $formattedShopOrder->buyer_username = $buyer->username;
                $formattedShopOrder->buyer_email = $buyer->email;

                $formattedShopOrders[] = $formattedShopOrder;

                // send order confirmation to shop
                // // if no mandrill subaccount, create it
                if (!isset($seller->mandrill_subaccount_id)) {
                    $id = $seller->id;
                    $name = $seller->username;
                    $notes = 'Signed up on ' . Carbon::now();

                    $result = $this->addSubAccount($id, $name, $notes);
                    $status = $result['status'];

                    // account created
                    if ($status == "active") {
                        $seller->mandrill_subaccount_id = $id;
                        $seller->save();

                        // send order confirmation to shop
                        $this->sendOrderConfirmationShop($formattedShopOrder, $seller, $shopOrder->id);
                    } else {
                        // some error occured
                        // log to sentry, subaccount not created
                    }
                } else {
                    // send order confirmation to shop
                    $this->sendOrderConfirmationShop($formattedShopOrder, $seller, $shopOrder->id);
                }
            }

            // template slug name in Mandrill
            $template_name = 'transactional-order-confirmation';
            $template_content = array();
            $message = array(
                'subject' => "Order Confirmation #" . $userOrderUID,
                'from_email' => 'order-confirmation@sprubix.com',
                'from_name' => 'Team Sprubix',
                'to' => array(
                    array(
                        'email' => $recipientEmail,
                        'name' => $recipientName,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'no-reply@sprubix.com'),
                "auto_text" => true,
                "inline_css" => true,
                'merge' => true,
                'merge_language' => 'handlebars',
                "global_merge_vars" => array(
                    array(
                        'name' => 'order_query_email',
                        'content' => 'support@sprubix.com'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $recipientEmail,
                        'vars' => array(
                            array(
                                'name' => 'user_order_uid',
                                'content' => $userOrderUID
                            ),
                            array(
                                'name' => 'shipping_address',
                                'content' => $shippingAddressHTML
                            ),
                            array(
                                'name' => 'user_order_points_applied',
                                'content' => $userOrderPointsApplied
                            ),
                            array(
                                'name' => 'user_order_total_discount',
                                'content' => $userOrderTotalDiscount
                            ),
                            array(
                                'name' => 'user_order_total_payable',
                                'content' => $userOrderTotalPayable
                            ),
                            array(
                                'name' => 'recipient_name',
                                'content' => $recipientName
                            ),
                            array(
                                'name' => 'payment_method',
                                'content' => $paymentMethodName
                            ),
                            array(
                                'name' => 'shop_orders',
                                'content' => $formattedShopOrders
                            )
                        )
                    )
                ),
                'tags' => array('order-confirmation'),
                'subaccount' => $recipientMandrillSubaccountId
            );

            $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            Log::error($e->getMessage()); // log to sentry
        }
    }

    public function sendOrderConfirmationShop($formattedShopOrder, $seller, $shopOrderId) {
        // send email to shop
        $shopOrderUID = $formattedShopOrder->uid;
        $sellerName = $formattedShopOrder->seller_name;
        $sellerEmail = $formattedShopOrder->seller_email;

        $buyerImage = $formattedShopOrder->buyer_image;
        $buyerName = $formattedShopOrder->buyer_name;
        $buyerEmail = $formattedShopOrder->buyer_email;

        $shopOrderTotal = $formattedShopOrder->total_price;
        $shippingMethod = $formattedShopOrder->shipping_method;
        $itemsPrice = $formattedShopOrder->items_price;
        $shippingRate = $formattedShopOrder->shipping_rate;

        $urlScheme = env('URL_SCHEME') . "/order/shop/" . $shopOrderId;

        $formattedCartItems = $formattedShopOrder->cart_items;

        // seller mandrill subaccount id
        $sellerMandrillSubaccountId = $seller->mandrill_subaccount_id;

        // template slug name in Mandrill
        $template_name = 'transactional-order-confirmation-shop';
        $template_content = array();
        $message = array(
            'subject' => "Order Confirmation #" . $shopOrderUID,
            'from_email' => 'customer-order-confirmation@sprubix.com',
            'from_name' => 'Team Sprubix',
            'to' => array(
                array(
                    'email' => $sellerEmail,
                    'name' => $sellerName,
                    'type' => 'to'
                )
            ),
            'headers' => array('Reply-To' => 'no-reply@sprubix.com'),
            "auto_text" => true,
            "inline_css" => true,
            'merge' => true,
            'merge_language' => 'handlebars',
            "global_merge_vars" => array(
                array(
                    'name' => 'order_query_email',
                    'content' => 'support@sprubix.com'
                )
            ),
            'merge_vars' => array(
                array(
                    'rcpt' => $sellerEmail,
                    'vars' => array(
                        array(
                            'name' => 'shop_order_uid',
                            'content' => $shopOrderUID
                        ),
                        array(
                            'name' => 'shipping_method',
                            'content' => $shippingMethod
                        ),
                        array(
                            'name' => 'items_price',
                            'content' => $itemsPrice
                        ),
                        array(
                            'name' => 'shipping_rate',
                            'content' => $shippingRate
                        ),
                        array(
                            'name' => 'shop_order_total',
                            'content' => $shopOrderTotal
                        ),
                        array(
                            'name' => 'seller_name',
                            'content' => $sellerName
                        ),
                        array(
                            'name' => 'buyer_image',
                            'content' => $buyerImage
                        ),
                        array(
                            'name' => 'buyer_name',
                            'content' => $buyerName
                        ),
                        array(
                            'name' => 'buyer_email',
                            'content' => $buyerEmail
                        ),
                        array(
                            'name' => 'cart_items',
                            'content' => $formattedCartItems
                        ),
                        array(
                            'name' => 'view_order_url',
                            'content' => $urlScheme
                        ),
                    )
                )
            ),
            'tags' => array('customer-order-confirmation'),
            'subaccount' => $sellerMandrillSubaccountId
        );

        $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);
    }

    public function sendShopOrderUpdate(User $buyer, ShopOrder $shopOrder) {
        $userOrderUID = $shopOrder->userOrder->uid;
        $shopOrderUID = $shopOrder->uid;
        $itemsPrice = $shopOrder->items_price;
        $shippingRate = $shopOrder->shipping_rate;
        $shopOrderTotal = $shopOrder->total_price;

        // // buyer
        $buyerImage = $buyer->image;
        $buyerEmail = $buyer->email;
        $buyerName = $buyer->name;
        $buyerUsername = $buyer->username;

        // // seller info
        $seller = $shopOrder->user;
        $sellerImage = $seller->image;
        $sellerEmail = $seller->email;
        $sellerName = $seller->name;
        $sellerUsername = $seller->username;

        // // delivery info
        $deliveryOption = $shopOrder->deliveryOption;
        $shippingMethod = $deliveryOption->name;

        // // user shipping address
        $shippingAddress = $shopOrder->shippingAddress;

        $shippingAddressHTML = $shippingAddress->address_1 . "<br>";

        if(isset($shippingAddress->address_2) && $shippingAddress->address_2 != "") {
            $shippingAddressHTML .= $shippingAddress->address_2 . "<br>";
        }

        $shippingAddressHTML .= $shippingAddress->city . "<br>";
        $shippingAddressHTML .= $shippingAddress->state . "<br>";
        $shippingAddressHTML .= $shippingAddress->country . "<br>";
        $shippingAddressHTML .= $shippingAddress->postal_code;

        // // cart items
        $cartItems = $shopOrder->cartItems;
        $formattedCartItems = array();

        foreach($cartItems as $cartItem) {
            $formattedCartItem = new \stdClass();

            $piece = $cartItem->piece;
            $pieceImages = json_decode($piece->images);
            $formattedCartItem->image = $pieceImages->cover;
            $formattedCartItem->name = $piece->name;
            $formattedCartItem->size = $cartItem->size;
            $formattedCartItem->quantity = $cartItem->quantity;
            $formattedCartItem->price = $piece->price;

            $formattedCartItems[] = $formattedCartItem;
        }

        // // if no mandrill subaccount, create it
        if (!isset($buyer->mandrill_subaccount_id)) {
            $id = $buyer->id;
            $name = $buyer->username;
            $notes = 'Signed up on ' . Carbon::now();

            $result = $this->addSubAccount($id, $name, $notes);
            $status = $result['status'];

            // account created
            if ($status == "active") {
                $buyer->mandrill_subaccount_id = $id;
                $buyer->save();
            }
        }

        // buyer mandrill subaccount id
        $buyerMandrillSubaccountId = $buyer->mandrill_subaccount_id;

        // perform different actions at different stages
        $orderStatus = $shopOrder->orderStatus;

        switch ($orderStatus->id) {
            case 3:
                // Shipping Posted
                // template slug name in Mandrill
                $template_name = 'transactional-shipping-confirmation';

                $message = array(
                    'subject' => "Order Update #" . $shopOrderUID,
                    'from_email' => 'order-update-shipped@sprubix.com',
                    'from_name' => 'Team Sprubix',
                    'to' => array(
                        array(
                            'email' => $buyerEmail,
                            'name' => $buyerName,
                            'type' => 'to'
                        )
                    ),
                    'headers' => array('Reply-To' => 'no-reply@sprubix.com'),
                    "auto_text" => true,
                    "inline_css" => true,
                    'merge' => true,
                    'merge_language' => 'handlebars',
                    "global_merge_vars" => array(
                        array(
                            'name' => 'order_query_email',
                            'content' => 'support@sprubix.com'
                        )
                    ),
                    'merge_vars' => array(
                        array(
                            'rcpt' => $buyerEmail,
                            'vars' => array(
                                array(
                                    'name' => 'user_order_uid',
                                    'content' => $userOrderUID
                                ),
                                array(
                                    'name' => 'shipping_address',
                                    'content' => $shippingAddressHTML
                                ),
                                array(
                                    'name' => 'shop_order_uid',
                                    'content' => $shopOrderUID
                                ),
                                array(
                                    'name' => 'shipping_method',
                                    'content' => $shippingMethod
                                ),
                                array(
                                    'name' => 'items_price',
                                    'content' => $itemsPrice
                                ),
                                array(
                                    'name' => 'shipping_rate',
                                    'content' => $shippingRate
                                ),
                                array(
                                    'name' => 'shop_order_total',
                                    'content' => $shopOrderTotal
                                ),
                                array(
                                    'name' => 'seller_email',
                                    'content' => $sellerEmail
                                ),
                                array(
                                    'name' => 'seller_name',
                                    'content' => $sellerName
                                ),
                                array(
                                    'name' => 'seller_image',
                                    'content' => $sellerImage
                                ),
                                array(
                                    'name' => 'buyer_name',
                                    'content' => $buyerName
                                ),
                                array(
                                    'name' => 'cart_items',
                                    'content' => $formattedCartItems
                                )
                            )
                        )
                    ),
                    'tags' => array('order-update-shipped'),
                    'subaccount' => $buyerMandrillSubaccountId
                );

                $template_content = array();

                $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);

                break;
            case 4:
                // Shipping Received
                break;
            case 6:
                // Shipping Delayed
                break;
        }
    }

    public function sendShopOrderRefundRequest(User $seller, ShopOrderRefund $shopOrderRefund) {
        try {
            // seller will receive the request
            $sellerImage = $seller->image;
            $sellerEmail = $seller->email;
            $sellerName = $seller->name;
            $sellerUsername = $seller->username;

            // buyer
            $buyer = $shopOrderRefund->buyer;
            $buyerImage = $buyer->image;
            $buyerEmail = $buyer->email;
            $buyerName = $buyer->name;
            $buyerUsername = $buyer->username;

            $refundUID = $shopOrderRefund->uid;
            $totalRefundAmount = $shopOrderRefund->refund_amount;

            $shopOrder = $shopOrderRefund->shopOrder;
            $shopOrderUID = $shopOrder->uid;
            $itemsPrice = $shopOrder->items_price;
            $shippingRate = $shopOrder->shipping_rate;

            // // delivery info
            $deliveryOption = $shopOrder->deliveryOption;
            $shippingMethod = $deliveryOption->name;

            // // payment method
            $paymentMethod = $shopOrder->paymentMethod;
            $paymentMethodName = $paymentMethod->card_type . " ending with " . $paymentMethod->redacted_card_num;

            // refund items
            $cartItems = $shopOrder->cartItems;
            $refundItems = array();

            foreach($cartItems as $cartItem) {
                // // choose cart items that have non-zero 'return' property
                if($cartItem->return != 0) {
                    $refundItem = new \stdClass();

                    $piece = $cartItem->piece;
                    $pieceImages = json_decode($piece->images);
                    $refundItem->image = $pieceImages->cover;

                    $refundItem->name = $piece->name;
                    $refundItem->size = $cartItem->size;
                    $refundItem->quantity = $cartItem->quantity;
                    $refundItem->price = $piece->price;
                    $refundItem->return = $cartItem->return;

                    $refundItems[] = $refundItem;
                }
            }

            Log::info($refundItems);

            // view refund url scheme
            $urlScheme = env('URL_SCHEME') . "/refund/" . $shopOrderRefund->id;

            // seller mandrill subaccount id
            $sellerMandrillSubaccountId = $seller->mandrill_subaccount_id;

            // template slug name in Mandrill
            $template_name = 'transactional-order-refund';

            $message = array(
                'subject' => "Refund Request Shop Order #" . $shopOrderUID,
                'from_email' => 'order-refund-requested@sprubix.com',
                'from_name' => 'Team Sprubix',
                'to' => array(
                    array(
                        'email' => $sellerEmail,
                        'name' => $sellerName,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'no-reply@sprubix.com'),
                "auto_text" => true,
                "inline_css" => true,
                'merge' => true,
                'merge_language' => 'handlebars',
                "global_merge_vars" => array(
                    array(
                        'name' => 'refund_request',
                        'content' => true
                    ),
                    array(
                        'name' => 'order_query_email',
                        'content' => 'support@sprubix.com'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $sellerEmail,
                        'vars' => array(
                            array(
                                'name' => 'refund_uid',
                                'content' => $refundUID
                            ),
                            array(
                                'name' => 'shop_order_uid',
                                'content' => $shopOrderUID
                            ),
                            array(
                                'name' => 'payment_method',
                                'content' => $paymentMethodName
                            ),
                            array(
                                'name' => 'shipping_method',
                                'content' => $shippingMethod
                            ),
                            array(
                                'name' => 'items_price',
                                'content' => $itemsPrice
                            ),
                            array(
                                'name' => 'shipping_rate',
                                'content' => $shippingRate
                            ),
                            array(
                                'name' => 'total_refund_amount',
                                'content' => $totalRefundAmount
                            ),
                            array(
                                'name' => 'seller_email',
                                'content' => $sellerEmail
                            ),
                            array(
                                'name' => 'seller_name',
                                'content' => $sellerName
                            ),
                            array(
                                'name' => 'buyer_image',
                                'content' => $buyerImage
                            ),
                            array(
                                'name' => 'buyer_email',
                                'content' => $buyerEmail
                            ),
                            array(
                                'name' => 'buyer_name',
                                'content' => $buyerName
                            ),
                            array(
                                'name' => 'refund_items',
                                'content' => $refundItems
                            ),
                            array(
                                'name' => 'view_refund_url',
                                'content' => $urlScheme
                            )
                        )
                    )
                ),
                'tags' => array('order-refund-requested'),
                'subaccount' => $sellerMandrillSubaccountId
            );

            $template_content = array();

            $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            Log::error($e->getMessage()); // log to sentry
        }
    }

    public function sendShopOrderRefundApproved(User $buyer, ShopOrderRefund $shopOrderRefund) {
        try {
            $seller = $shopOrderRefund->user;
            $sellerImage = $seller->image;
            $sellerEmail = $seller->email;
            $sellerName = $seller->name;
            $sellerUsername = $seller->username;

            $buyerImage = $buyer->image;
            $buyerEmail = $buyer->email;
            $buyerName = $buyer->name;
            $buyerUsername = $buyer->username;

            $refundUID = $shopOrderRefund->uid;
            $totalRefundAmount = $shopOrderRefund->refund_amount;

            $shopOrder = $shopOrderRefund->shopOrder;
            $shopOrderUID = $shopOrder->uid;
            $itemsPrice = $shopOrder->items_price;
            $shippingRate = $shopOrder->shipping_rate;

            // // delivery info
            $deliveryOption = $shopOrder->deliveryOption;
            $shippingMethod = $deliveryOption->name;

            // // payment method
            $paymentMethod = $shopOrder->paymentMethod;
            $paymentMethodName = $paymentMethod->card_type . " ending with " . $paymentMethod->redacted_card_num;

            // refunded items
            $cartItems = $shopOrder->cartItems;
            $refundedItems = array();

            foreach($cartItems as $cartItem) {
                // // choose cart items that have non-zero 'returned' property
                if($cartItem->returned != 0) {
                    $refundedItem = new \stdClass();

                    $piece = $cartItem->piece;
                    $pieceImages = json_decode($piece->images);
                    $refundedItem->image = $pieceImages->cover;

                    $refundedItem->name = $piece->name;
                    $refundedItem->size = $cartItem->size;
                    $refundedItem->quantity = $cartItem->quantity;
                    $refundedItem->price = $piece->price;
                    $refundedItem->returned = $cartItem->returned;

                    $refundedItems[] = $refundedItem;
                }
            }

            Log::info($refundedItems);

            // view refund url scheme
            $urlScheme = env('URL_SCHEME') . "/refund/" . $shopOrderRefund->id;

            // buyer mandrill subaccount id
            $buyerMandrillSubaccountId = $buyer->mandrill_subaccount_id;

            // template slug name in Mandrill
            $template_name = 'transactional-order-refund';

            $message = array(
                'subject' => "Refund Approval Shop Order #" . $shopOrderUID,
                'from_email' => 'order-refund-approved@sprubix.com',
                'from_name' => 'Team Sprubix',
                'to' => array(
                    array(
                        'email' => $buyerEmail,
                        'name' => $buyerName,
                        'type' => 'to'
                    )
                ),
                'headers' => array('Reply-To' => 'no-reply@sprubix.com'),
                "auto_text" => true,
                "inline_css" => true,
                'merge' => true,
                'merge_language' => 'handlebars',
                "global_merge_vars" => array(
                    array(
                        'name' => 'order_query_email',
                        'content' => 'support@sprubix.com'
                    )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $buyerEmail,
                        'vars' => array(
                            array(
                                'name' => 'refund_uid',
                                'content' => $refundUID
                            ),
                            array(
                                'name' => 'shop_order_uid',
                                'content' => $shopOrderUID
                            ),
                            array(
                                'name' => 'payment_method',
                                'content' => $paymentMethodName
                            ),
                            array(
                                'name' => 'shipping_method',
                                'content' => $shippingMethod
                            ),
                            array(
                                'name' => 'items_price',
                                'content' => $itemsPrice
                            ),
                            array(
                                'name' => 'shipping_rate',
                                'content' => $shippingRate
                            ),
                            array(
                                'name' => 'total_refund_amount',
                                'content' => $totalRefundAmount
                            ),
                            array(
                                'name' => 'seller_image',
                                'content' => $sellerImage
                            ),
                            array(
                                'name' => 'seller_email',
                                'content' => $sellerEmail
                            ),
                            array(
                                'name' => 'seller_name',
                                'content' => $sellerName
                            ),
                            array(
                                'name' => 'buyer_email',
                                'content' => $buyerEmail
                            ),
                            array(
                                'name' => 'buyer_name',
                                'content' => $buyerName
                            ),
                            array(
                                'name' => 'refund_items',
                                'content' => $refundedItems
                            ),
                            array(
                                'name' => 'view_refund_url',
                                'content' => $urlScheme
                            )
                        )
                    )
                ),
                'tags' => array('order-refund-approved'),
                'subaccount' => $buyerMandrillSubaccountId
            );

            $template_content = array();

            $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            Log::error($e->getMessage()); // log to sentry
        }
    }

    public function addSubAccount($id, $name, $notes) {
        try {
            // create subaccount
            $result = $this->mandrill->subaccounts->add($id, $name, $notes);

            return $result;

        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            Log::error($e->getMessage()); // log to sentry
        }
    }
}