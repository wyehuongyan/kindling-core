<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Queue;
use Log;
use Illuminate\Http\Request;

class QueueController extends Controller {
    public function receiveJob(Request $request) {
        return Queue::marshal();
    }
}