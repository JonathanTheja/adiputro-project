<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterFormReportController extends Controller
{
    function formReport(Request $request)
    {
        return view("master.form.report");
    }
}
