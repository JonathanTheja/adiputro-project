<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDepartemenController extends Controller
{
    function masterDepartemen()
    {
        return view("master.departemen");
    }
}
