<?php namespace App\Services;

use Mandrill;
use Mandrill_Error;
use App\Models\User;
use Log;

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

                $formattedShopOrders[] = $formattedShopOrder;
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
                'tags' => array('welcome'),
                'subaccount' => $recipientMandrillSubaccountId
            );

            $result = $this->mandrill->messages->sendTemplate($template_name, $template_content, $message);

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }

    public function sendOrderUpdate() {

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