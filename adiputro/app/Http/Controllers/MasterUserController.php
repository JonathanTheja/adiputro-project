<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class MasterUserController extends Controller
{
    function masterUser()
    {
        //get all users
        $users = User::all();
        $roles = Role::all();
        $departments = Department::all();
        return view("master.user",["users"=>$users,"roles"=>$roles,"departments"=>$departments]);
    }

}
