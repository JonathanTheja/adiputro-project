<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    function masterData(Request $request)
    {
        $spks = Spk::tree()->get()->toTree();
        // dd($spks);
        return view("master.data", compact("spks"));
    }
}
