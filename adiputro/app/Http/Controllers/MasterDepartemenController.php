<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class MasterDepartemenController extends Controller
{
    function masterDepartemen()
    {
        $departments = Department::all();
        return view("master.department", compact("departments"));
    }

    function addDepartment(Request $request)
    {
        $request->validate([
            "name" => ["required"],
        ]);
        Department::create([
            "name" => $request->name,
        ]);
        return back()->with("message", "Berhasil Tambah Departemen!");
    }
}
