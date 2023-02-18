<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterLevelController extends Controller
{
    function masterLevel()
    {
        return view("master.level");
    }
}
