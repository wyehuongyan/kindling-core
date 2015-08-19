<?php namespace App\Services;

use App\Models\ShopOrder;
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
            $userOrderTotal = $userOrder->total_price;

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
                                'name' => 'user_order_total',
                                'content' => $userOrderTotal
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

    public function sendShopOrderUpdate(ShopOrder $shopOrder) {
        $shopOrderUID = $shopOrder->uid;
        $itemsPrice = $shopOrder->items_price;
        $shippingRate = $shopOrder->shipping_rate;
        $shopOrderTotal = $shopOrder->total_price;

        // // buyer
        $buyer = $shopOrder->buyer;
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

                break;
            case 4:
                // Shipping Received
                break;
            case 6:
                // Shipping Delayed
                break;
        }

        $template_content = array();

        $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);
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