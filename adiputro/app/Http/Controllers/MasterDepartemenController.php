<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterDepartemenController extends Controller
{
    function masterDepartemen()
    {
        $departments = Department::all();
        return view("master.department", compact("departments"));
    }

    function addDepartment(Request $request)
    {
        alert()->question('Title','Lorem Lorem Lorem');
        $request->validate([
            "name" => ["required"],
        ]);
        Department::create([
            "name" => $request->name,
        ]);
        return back()->with("message", "Berhasil Tambah Departemen!");
    }
}
