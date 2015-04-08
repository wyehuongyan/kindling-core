<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function users(Request $request) {
        $input = $request->all();

        $query = User::search($input);
        $users = $query->paginate(15);

        return response()->json($users)->setCallback($request->input('callback'));
    }

    public function user(Request $request) {
        return response()->json(Auth::user())->setCallback($request->input('callback'));
    }
}