<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $user = User::all();
        return view('users', ['users' => $user]);
    }

    public function save(Request $request) {
        // dd($request);
        $new_user = new User;
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->role = $request->role;
        $new_user->password = bcrypt($request->password);
        $new_user->save();

        $user = User::all();
        return view('users', ['users' => $user]);
    }

    public function update_status(Request $request)
    {
        $user = User::find($request->id);
        $user->enabled = (int)$request->value;
        $user->save();
        return $user->enabled;
    }
}
