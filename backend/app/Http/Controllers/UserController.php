<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => ["required", 'min:2', 'max:20', new Uppercase],
            "last_name" => ["required", 'min:2', 'max:20', new Uppercase],
            "username" => "required|unique:users",
            "password" =>  ["required", 'max:12', Password::min(5)]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "data" => $validator->errors()
            ]);
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();

        ## jika gagal ###

        return response()->json([
            "status" => false,
            "data" => "Username/Password salah"
        ]);

        ### jika sukses ####
        $user_id = User::where("username", $request->username)->value("id");

        return response()->json([
            "role" => "user"
        ]);
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('home');
        }else{
            Session::flash('error', 'Username atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}

