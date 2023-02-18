<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterStallController extends Controller
{
    function masterStall()
    {
        return view("master.stall");
    }
}
