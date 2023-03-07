<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\FormReport;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterFormReportController extends Controller
{
    function formReport(Request $request)
    {
        $bulan = array("","I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $form_reports = FormReport::all();
        $form_report = FormReport::all();
        $form_report = $form_report[count($form_report)-1];
        $tanggal = date('d-m-Y');
        $tanggal = date('d-m-Y', strtotime($tanggal));
        // echo substr($form_report->nomor_laporan,4,4);
        $nomor_laporan = "LAP/".str_pad(intval(substr($form_report->nomor_laporan,4,4))+1, 4, "0", STR_PAD_LEFT)."/BW/AP/".$bulan[intval(date('m'))]."/".date('Y');
        return view("master.form.report", compact("form_reports","nomor_laporan","tanggal"));
    }

    function addReport(Request $request)
    {
        $form_report = FormReport::create([
            "nomor_laporan" => $request->nomor_laporan,
            "tanggal" => now(),
            "user_id" => 1,
            "kategori" => $request->kategori,
            "temuan" => $request->temuan,
        ]);
        Alert::success('Sukses!', 'Berhasil Tambah Report Baru!');
        return back();
    }
}
