<?php namespace App\Http\Controllers;

use Aws\S3\S3Client;
use Request;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

    public function aws() {
        $client = S3Client::factory(array(
            'profile' => 'sprubixtest',
        ));


        $result = $client->listBuckets();
        $list = array();
        $bucketName = 'sprubixtest';

        foreach ($result['Buckets'] as $bucket) {
            // Each Bucket value will contain a Name and CreationDate
            echo "{$bucket['Name']} - {$bucket['CreationDate']}\n";
        }

        $iterator = $client->getIterator('ListObjects', array(
            'Bucket' => $bucketName,
            'Prefix' => 'pieces/1/'
        ));

        foreach ($iterator as $object) {
            //echo $object['Key'] . "\n";

            if($object['Size'] > 0) { // avoid folders
                array_push($list, $object['Key']);
            }
        }

        echo count($list) . " Keys retrieved!\n";

        return response()->json($list)
            ->setCallback(Request::input('callback'));

    }

}
