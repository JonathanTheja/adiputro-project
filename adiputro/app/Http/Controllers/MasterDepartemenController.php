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
        ]);
        Alert::info('Sukses!', 'Berhasil Tambah Departemen!');
        return back();
    }

    function updateDepartment(Request $request)
    {
        $department = Department::find($request->department_id);
        $request->validate([
            "name" => ["required"],
        ]);
        $department->name = $request->name;
        $department->save();
        Alert::info('Sukses!', 'Berhasil Update Departemen!');
        return back();
    }

    function deleteDepartment(Request $request)
    {
        $department = Department::find($request->department_id)->delete();
        Alert::info('Sukses!', 'Berhasil Delete Departemen!');
        return back();
    }
}
