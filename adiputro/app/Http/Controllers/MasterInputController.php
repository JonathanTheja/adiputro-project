<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterInputController extends Controller
{
    function masterInput(Request $request)
    {

        return view("master.input");
    }
}
