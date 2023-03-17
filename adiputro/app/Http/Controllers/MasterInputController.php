<?php

namespace App\Http\Controllers;

use App\Models\FormReport;
use Illuminate\Http\Request;

class MasterInputController extends Controller
{
    function masterInput(Request $request)
    {
        $report_ti = FormReport::where("jenis","TI")->get();
        $report_gambar = FormReport::where("jenis","Gambar Teknik")->get();
        
        return view("master.input");
    }
}
