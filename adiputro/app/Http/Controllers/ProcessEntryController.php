<?php

namespace App\Http\Controllers;

use App\Models\ProcessEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProcessEntryController extends Controller
{
    //
    function index()
    {
        # code...
        //get all process entries
        $pes = ProcessEntry::all();
        $department = Auth::user()->department->name;
        return view('master.process_entry',[
            "process_entries"=>$pes,
            "department"=>$department
        ]);
    }

    function addNewProcessEntry(Request $request){
        // dd($request->all());
        ProcessEntry::create([
            "spk_type"=>$request->spk_type,
            "process_name"=>$request->process_name,
            "process_number"=>$request->process_number,
            "stall_number"=>$request->stall_number,
            "work_description"=>$request->work_description,
            "pic"=>$request->pic
        ]);
        Alert::success('Sukses!', 'Berhasil Tambah Process Entry!');
        return back();
    }
}
