<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    function index(){
        return view("home");
    }
}
