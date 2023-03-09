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
        $request->validate([
            "name" => ["required"],
        ]);
        Department::create([
            "name" => $request->name,
            "access_database" => $request->access_database,
        ]);
        Alert::success('Sukses!', 'Berhasil Tambah Departemen!');
        return back();
    }

    function updateDepartment(Request $request)
    {
        $department = Department::find($request->department_id);
        $request->validate([
            "name" => ["required"],
        ]);
        $department->name = $request->name;
        $department->access_database = $request->access_database;
        $department->save();
        Alert::success('Sukses!', 'Berhasil Update Departemen!');
        return back();
    }

    function deleteDepartment(Request $request)
    {
        $department = Department::find($request->department_id)->delete();
        Alert::success('Sukses!', 'Berhasil Delete Departemen!');
        return back();
    }
}
