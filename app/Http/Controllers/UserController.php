<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function user(Request $request) {
        $input = $request->all();

        $query = User::search($input);
        $users = $query->paginate(15);

        return response()->json($users)->setCallback($request->input('callback'));
    }
}