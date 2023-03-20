<?php

namespace App\Http\Controllers;

use App\Models\FormReport;
use App\Models\ItemLevel;
use App\Models\KategoriReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    function dashboard(Request $request)
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
            $initial = strtoupper($department_name[0].$department_name[strpos($department_name, " ")+1]);
        }

        $nomor_laporan = "LAP/".str_pad(intval(substr($form_report->nomor_laporan,4,4))+1, 4, "0", STR_PAD_LEFT)."/$initial/AP/".$bulan[intval(date('m'))]."/".date('Y');

        $pelapor = Auth::user();

        $item_levels = ItemLevel::tree()->get()->toTree();

        $kategori_report = KategoriReport::all();

        if(isset($request->item_level_id)){
            $item_level_id = $request->item_level_id;
            return view("master.dashboard",compact("item_levels","form_reports","nomor_laporan","tanggal","pelapor","kategori_report","item_level_id"));
        }
        return view("master.dashboard",compact("item_levels","form_reports","nomor_laporan","tanggal","pelapor","kategori_report"));
    }

    function addReport(Request $request)
    {
        // dump($request);
        $form_report = FormReport::create([
            "item_level_id" => $request->item_level_id,
            "nomor_laporan" => $request->nomor_laporan,
            "tanggal" => now(),
            "pelapor_id" => Auth::user()->user_id,
            "jenis" => $request->jenis,
            "kategori_report_id" => $request->kategori_report_id,
            "temuan" => $request->temuan,
        ]);
        Alert::success('Sukses!', 'Berhasil Tambah Report Baru!');
        return back();
    }

    function updateReport(Request $request)
    {

    }

    function konfirmasi(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $credentials = [
            "username" => $username,
            "password" => $password
        ];
        if(Auth::user()->username == $username && Auth::attempt($credentials)){
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }
}
