<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use Illuminate\Http\Request;

class MasterLevelController extends Controller
{
    function masterLevel()
    {
        $spks = Spk::tree()->get()->toTree();
        return view("master.level",compact("spks"));
    }
}
