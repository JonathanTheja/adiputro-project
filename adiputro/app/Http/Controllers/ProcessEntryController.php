<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcessEntryController extends Controller
{
    //
    function index()
    {
        # code...
        return view('master.process_entry');
    }
}
