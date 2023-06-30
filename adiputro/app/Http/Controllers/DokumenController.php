<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumenController extends Controller
{
    //
    function index(){
        return view("dokumen");
    }
}
