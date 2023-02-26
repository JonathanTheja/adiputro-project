<?php

namespace App\Http\Controllers;

use App\Models\ItemLevel;
use Illuminate\Http\Request;

class MasterLevelController extends Controller
{
    function masterLevel()
    {
        $item_levels = ItemLevel::tree()->get()->toTree();
        return view("master.level",compact("item_levels"));

    }
}
