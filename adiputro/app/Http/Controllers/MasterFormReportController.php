<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\FormReport;
use App\Models\InputGT;
use App\Models\InputTI;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $department_name = Auth::user()->department->name;
        $initial = strtoupper($department_name[0].$department_name[1]);
        if(strpos($department_name, " ")){
            $initial = strtoupper($department_name[0].$department_name[strpos($department_name, " ")]);
        }

        $nomor_laporan = "LAP/".str_pad(intval(substr($form_report->nomor_laporan,4,4))+1, 4, "0", STR_PAD_LEFT)."/$initial/AP/".$bulan[intval(date('m'))]."/".date('Y');

        return view("notifikasi.report", compact("form_reports","nomor_laporan","tanggal"));
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

    function updateReport(Request $request)
    {
        $form_report = FormReport::find($request->form_report_id);
        $form_report->reply = $request->reply;
        $form_report->tanggal_diselesaikan = now();
        $form_report->penyelesai_id = Auth::user()->user_id;
        $form_report->save();
        Alert::success('Sukses!', 'Berhasil Menyelesaikan Report!');
        return back();
    }

    function reportApproval(Request $request)
    {
        $input_ti = InputTI::orderBy("kode_ti", "asc")->orderBy("revisi", "asc")->get();
        $input_gt = InputGT::orderBy("kode_gt", "asc")->orderBy("revisi", "asc")->get();
        return view("notifikasi.report.approval", compact("input_ti","input_gt"));
    }
}
