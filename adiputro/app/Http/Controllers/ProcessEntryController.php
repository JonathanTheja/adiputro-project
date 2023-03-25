<?php

namespace App\Http\Controllers;

use App\Models\ProcessEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
