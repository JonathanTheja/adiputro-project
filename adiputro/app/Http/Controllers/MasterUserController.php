<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    function updateUser(Request $request)
    {
        $user = User::find($request->user_id);
        $user->full_name = $request->full_name;
        $user->department_id = $request->department_id;
        $user->role_id = $request->role_id;

        if($request->status != null){
            $user->status = $request->status;
        }
        else{
            $user->status = 0;
        }
        $user->save();
        Alert::success('Sukses!', 'Berhasil Update User!');
        return back();
    }

    function deleteUser(Request $request)
    {
        $user = User::find($request->user_id)->delete();
        Alert::success('Sukses!', 'Berhasil Delete User!');
        return back();
    }
}
