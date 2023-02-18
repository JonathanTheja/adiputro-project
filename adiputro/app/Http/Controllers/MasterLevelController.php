<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use Illuminate\Http\Request;

class MasterLevelController extends Controller
{
    function masterLevel()
    {
        $spks = Spk::where('parent_id', null);

        // Get nestable data
        $nestable = Spk::nestable($spks)->get();
        return view("master.level",["spks"=>$nestable]);
    }
}
