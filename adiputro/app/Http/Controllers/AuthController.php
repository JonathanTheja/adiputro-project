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
    function doLogin()
    {
        return view('dashboard');
    }
}
