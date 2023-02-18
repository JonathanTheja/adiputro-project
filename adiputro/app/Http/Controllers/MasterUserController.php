<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterUserController extends Controller
{
    function masterUser()
    {
        return view("master.user");
    }

}
