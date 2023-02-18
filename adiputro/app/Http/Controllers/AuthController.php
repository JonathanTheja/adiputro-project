<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $username = $request->username;
        $full_name = $request->full_name;
        $department_id = $request->department_id;
        $role_id = $request->role_id;
        $password = $request->password;
        $status = $request->status;
        $gender = $request->gender;
        $message = "";

        $request->validate([
            "username"=>["required","min:8","alpha","unique:users,username"],
            "gender"=>"required",
            "password"=>["required","confirmed","min:8"],
            "full_name"=>["required"]
        ]);

        //insert into users
        User::create([
                "full_name"=>$full_name,
                "username"=>$username,
                "password"=>$password,
                "gender"=>$gender,
                "role"=>$role_id,
                "department_id"=>1,
                "status"=>$status
            ]);

        $message = "Berhasil tambah user baru!";
        return redirect()->route('login')->with("message",[
            "content"=>$message,
            "type"=>1
        ]);
    }
}
