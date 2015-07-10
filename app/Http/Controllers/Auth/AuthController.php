<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Validator;
use App\Models\User;
use App\Models\Shopper;
use Services_FirebaseTokenGenerator;
use Braintree_ClientToken;
use Braintree_Configuration;

class AuthController extends Controller {

    public function authenticate(Request $request) {
        $loginAttr = "";
        $remember = true;

        if($request->has('email')) {
            $loginAttr = "email";
        } else {
            $loginAttr = "username";
        }

        if (Auth::attempt($request->only($loginAttr, 'password'), $remember))
        {
            // success, login
            $trimLoginAttr = preg_replace('/\s+/', '', $request->input($loginAttr));

            $user = User::search(array($loginAttr => $trimLoginAttr))->with('shoppable')->first();

            $success = array(
                "status" => "200",
                "message" => "success",
                "data" => $user
            );

            return response()->json($success)->setCallback($request->input('callback'));
        } else {
            // failed to login
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => "failed to login, please try again."
            );

            return response()->json($error)->setCallback($request->input('callback'));
        }
    }

    public function checkLoggedIn(Request $request) {
        if(Auth::check()) {
            return response()->json(array("status" => "logged in", "user" => Auth::user()))
                ->setCallback($request->input('callback'));
        } else {
            return response()->json(array("status" => "not logged in", "user" => Auth::user()))
                ->setCallback($request->input('callback'));
        }
    }

    public function register(Request $request) {

        // Validate the user input
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            $error = array(
                "status" => "400",
                "message" => "error",
                "data" => $validator->messages()
            );

            return response()->json($error)
                ->setCallback($request->input('callback'));
        } else {
            // pass

            $user = new User();
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);

            $user->save();

            $shopper = new Shopper();
            $shopper->save();
            $shopper->user()->save($user);

            $shopper->save();

            $success = array(
                "status" => "200",
                "message" => "success",
                "data" => $user
            );

            return response()->json($success)
                ->setCallback($request->input('callback'));
        }

    }

    // Firebase methods
    public function generateFireBaseToken(Request $request) {
        try {
            $user = Auth::user();

            $tokenGen = new Services_FirebaseTokenGenerator(env("FIREBASE_KEY"));
            $token = $tokenGen->createToken(array("uid" => "sprubix-user:" . $user->id));

            $json = array(
                "status" => "200",
                "message" => "success",
                "token" => $token
            );

            $user->firebase_token = $token;
            $user->save();
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    // Braintree
    public function generateBraintreeToken(Request $request) {
        try {
            // set up braintree environment
            Braintree_Configuration::environment(Config::get('app.braintree_environment'));
            Braintree_Configuration::merchantId(Config::get('app.braintree_merchantid'));
            Braintree_Configuration::publicKey(Config::get('app.braintree_public_key'));
            Braintree_Configuration::privateKey(Config::get('app.braintree_private_key'));

            $clientToken = Braintree_ClientToken::generate();

            $json = array("status" => "200",
                "message" => "success",
                "token" => $clientToken
            );
        } catch (\Exception $e) {
            $json = array("status" => "500",
                "message" => "exception",
                "exception" => $e->getMessage()
            );
        }

        return response()->json($json)->setCallback($request->input('callback'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
