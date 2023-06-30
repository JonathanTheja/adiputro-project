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
        $users = User::all();
        $roles = Role::all();
        $departments = Department::all();
        return view("home",["users"=>$users,"roles"=>$roles,"departments"=>$departments]);
    }
}
