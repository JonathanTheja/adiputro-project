<?php

namespace App\Http\Controllers;

use App\Models\FormReport;
use App\Models\ItemLevel;
use Illuminate\Http\Request;

class MasterLevelController extends Controller
{
    function dashboard()
    {
        $bulan = array("","I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $form_reports = FormReport::all();
        $form_report = FormReport::all();
        $form_report = $form_report[count($form_report)-1];
        $tanggal = date('d-m-Y');
        $tanggal = date('d-m-Y', strtotime($tanggal));
        // echo substr($form_report->nomor_laporan,4,4);
        $nomor_laporan = "LAP/".str_pad(intval(substr($form_report->nomor_laporan,4,4))+1, 4, "0", STR_PAD_LEFT)."/BW/AP/".$bulan[intval(date('m'))]."/".date('Y');

        $item_levels = ItemLevel::tree()->get()->toTree();
        return view("master.level",compact("item_levels","form_reports","nomor_laporan","tanggal"));
    }
}
