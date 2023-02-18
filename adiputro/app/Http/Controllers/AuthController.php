<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    function index()
    {
        return view('auth.login');
    }

    function dashboard()
    {
        return view('master.user');
    }

    function doLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $request->validate([
            "username" => 'required',
            "password" => "required"
        ],[
            "username.required" => "Username is required!",
            "password.required" => "Password is required!"
        ]);

        return redirect('/master/user');
    }

    function doRegister(Request $request)
    {
        
    }
}
