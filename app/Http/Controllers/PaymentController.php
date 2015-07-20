<?php namespace App\Http\Controllers;

use App\Models\UserPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Log;
use Braintree_Customer;
use Braintree_Configuration;
use Braintree_Test_Nonces;
use Braintree_Transaction;

class PaymentController extends Controller {
    public function userPaymentMethods(Request $request) {
        $user = $request->user();

        $userPaymentMethods = $user->paymentMethods()->orderBy('is_default', 'desc')->get();

        return response()->json($userPaymentMethods)->setCallback($request->input('callback'));
    }

    public function userPaymentMethod(Request $request) {
        $user = $request->user();

        $userPaymentMethod= UserPaymentMethod::search(["user_id" => $user->id, "is_default" => 1])->first();

        return response()->json($userPaymentMethod)->setCallback($request->input('callback'));
    }

    public function createPaymentMethod(Request $request) {
        $user = $request->user();

        $isDefault = $request->get("is_default");
        $nonceFromTheClient = $request->get("nonce");

        try {
            $userPaymentMethod = new UserPaymentMethod();

            // set up braintree environment (looks like this always has to be done)
            Braintree_Configuration::environment(Config::get('app.braintree_environment'));
            Braintree_Configuration::merchantId(Config::get('app.braintree_merchantid'));
            Braintree_Configuration::publicKey(Config::get('app.braintree_public_key'));
            Braintree_Configuration::privateKey(Config::get('app.braintree_private_key'));

            // check if user has is already a braintree customer
            if(!isset($user->braintree_cust_id)) {
                // if not, init a new customer + payment method at braintree
                $result = Braintree_Customer::create([
                    'creditCard' => [
                        'paymentMethodNonce' => Braintree_Test_Nonces::$transactable,
                        'options' => [
                            'verifyCard' => true,
                            //'failOnDuplicatePaymentMethod' => true,
                            'makeDefault' => $isDefault
                        ]
                    ]
                ]);

                if($result->success) {
                    // set token for payment method
                    $userPaymentMethod->token = $result->customer->paymentMethods()[0]->token;
                    $userPaymentMethod->redacted_card_num = $result->customer->paymentMethods()[0]->last4;
                    $userPaymentMethod->card_type = $result->customer->paymentMethods()[0]->cardType;
                    $userPaymentMethod->image = $result->customer->paymentMethods()[0]->imageUrl;

                    // set braintree cust id for user
                    $user->braintree_cust_id = $result->customer->id;
                    $user->save();

                } else {
                    $errorString = 'Braintree Error: ';

                    foreach($result->errors->deepAll() AS $error) {
                        $errorString .= $error->code . ": " . $error->message . "\r";

                        Log::info($error->code . ": " . $error->message . "\r\n");
                    }

                    throw new \Exception($errorString);
                }
            } else {
                // already has a BT account
                // // just create a new payment method
                $result = \Braintree_PaymentMethod::create([
                    'customerId' => $user->braintree_cust_id,
                    'paymentMethodNonce' => Braintree_Test_Nonces::$transactable,
                    'options' => [
                        'verifyCard' => true,
                        //'failOnDuplicatePaymentMethod' => true,
                        'makeDefault' => $isDefault
                    ]
                ]);

                if($result->success) {
                    // set token for payment method
                    $userPaymentMethod->token = $result->paymentMethod->token;
                    $userPaymentMethod->redacted_card_num = $result->paymentMethod->last4;
                    $userPaymentMethod->card_type = $result->paymentMethod->cardType;
                    $userPaymentMethod->image = $result->paymentMethod->imageUrl;
                }
            }

            if($result->success) {
                if(isset($isDefault)) {
                    if($isDefault) {
                        // set all other payment methods to be not default
                        $userPaymentMethods = $user->paymentMethods()->get();

                        foreach($userPaymentMethods as $paymentMethod) {
                            $paymentMethod->is_default = false;

                            $paymentMethod->save();
                        }

                        $userPaymentMethod->is_default = $isDefault;
                    }
                }

                $userPaymentMethod->user()->associate($user);
                $userPaymentMethod->save();

                $json = array("status" => "200",
                    "message" => "success",
                    "user_payment_method" => $userPaymentMethod
                );

            } else {
                foreach($result->errors->deepAll() AS $error) {
                    $errorString = 'Braintree Error: ';
                    $errorString .= $error->code . ": " . $error->message . "\r";
                }

                throw new \Exception($errorString);
            }
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function createTransaction(Request $request) {
        try {
            $user = $request->user();
            $amount = $request->get("amount");

            if(isset($user)) {
                // braintree cust id
                $braintree_cust_id = $user->braintree_cust_id;
            }

            // set up braintree environment (looks like this always has to be done)
            Braintree_Configuration::environment(Config::get('app.braintree_environment'));
            Braintree_Configuration::merchantId(Config::get('app.braintree_merchantid'));
            Braintree_Configuration::publicKey(Config::get('app.braintree_public_key'));
            Braintree_Configuration::privateKey(Config::get('app.braintree_private_key'));

            $result = Braintree_Transaction::sale(
                [
                    'customerId' => $braintree_cust_id,
                    'amount' => $amount,
                    'options' => [
                        'submitForSettlement' => true
                    ]
                ]
            );

            if($result->success) {
                // check status
                $transaction = $result->transaction;
                $status = $transaction->status;

                $statusCode = "";
                $statusText = "";

                switch($status) {
                    case "authorization_expired":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "authorizing":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "settlement_pending":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "settlement_confirmed":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "settlement_declined":
                        $statusCode .= $transaction->processorSettlementResponseCode;
                        $statusText .= $transaction->processorSettlementResponseText;
                        break;

                    case "failed":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "gateway_rejected":
                        $statusCode .= "nil";
                        $statusText .= $transaction->gatewayRejectionReason;
                        break;

                    case "processor_declined":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "settled":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "settling":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "voided":
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    case "authorized":
                    case "submitted_for_settlement":
                        // success
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                        break;

                    default:
                        $statusCode .= $transaction->processorResponseCode;
                        $statusText .= $transaction->processorResponseText . " Additional: " . $transaction->additionalProcessorResponse;
                }

                $json = array("status" => "200",
                    "BT_transaction_id" => $transaction->id,
                    "BT_status" => $status,
                    "BT_code" => $statusCode,
                    "BT_text" => $statusText
                );

            } else {
                $errorString = 'Braintree Error: ';

                foreach($result->errors->deepAll() AS $error) {
                    $errorString .= $error->code . ": " . $error->message . "\r";
                }

                throw new \Exception($errorString);
            }

        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    public function deletePaymentMethod(Request $request, UserPaymentMethod $paymentMethod) {

    }
}