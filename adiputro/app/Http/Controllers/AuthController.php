<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
        $credentials = [
            "username" => $username,
            "password" => $password
        ];
        if(Auth::attempt($credentials)){
            return redirect("/master/user");
        }

        return redirect('/login');
    }

    function doRegister(Request $request)
    {
        $username = $request->username;
        $full_name = $request->full_name;
        $department_id = $request->department_id;
        $role_id = $request->role_id;
        $password = $request->password;
        $status = 1;
        $gender = $request->gender;
        $message = "";

        $request->validate([
            "username"=>["required","min:8","alpha","unique:users,username"],
            "gender"=>"required",
            "password"=>["required","min:8"],
            "full_name"=>["required"],
        ]);

        //insert into users
        User::create([
                "full_name"=>$full_name,
                "username"=>$username,
                "password"=>Hash::make($password),
                "gender"=>$gender,
                "role_id"=>$role_id,
                "department_id"=>$department_id,
                "status"=>$status
            ]);

        $message = "Berhasil tambah user baru!";
        Alert::success('Sukses!', 'Berhasil Tambah User!');
        return redirect('/master/user')->with("message",[
            "content"=>$message,
            "type"=>1
        ]);
    }
}
