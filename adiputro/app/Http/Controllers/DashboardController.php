<?php

namespace App\Http\Controllers;

use App\Models\FormReport;
use App\Models\ItemLevel;
use App\Models\KategoriReport;
use DateTime;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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

    function getItemLevelParent(Request $request){
        $itemLevel = ItemLevel::find($request->item_level_id);
        $ancestors = $itemLevel->ancestors()->get();
        $ancestors->prepend($itemLevel);
        $reversedAncestors = array_reverse($ancestors->toArray());

        return response()->json([
            'success' => true,
            'ancestors' => $reversedAncestors,
        ]);
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
            "kode" => $request->kode,
            "kategori_report_id" => $request->kategori_report_id,
            "temuan" => $request->temuan,
        ]);
        // $qrcode = QrCode::size(200)->generate(now());
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime();
        $day = date('l');
        $hari = [
            "Sunday" => "Minggu",
            "Monday" => "Senin",
            "Tuesday" => "Selasa",
            "Wednesday" => "Rabu",
            "Thursday" => "Kamis",
            "Friday" => "Jumat",
            "Saturday" => "Sabtu",
        ];
        $formatted_date = $date->format('j F Y; h:i A');

        $qrcode = QrCode::size(200)->generate(
            Auth::user()->full_name.'; '.
            Auth::user()->role->name.'; '.
            Auth::user()->department->name.'; '.
            $hari[$day].'; '.$formatted_date
        );
        // Alert::success('Sukses!', 'Berhasil Tambah Report Baru!');
        return redirect('/dashboard')->with(['qrcode' => $qrcode]);
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

    function getCategories(Request $request)
    {
        $categories = KategoriReport::all();
        return response()->json([
            'success' => true,
            'categories' => $categories,
        ]);
    }

    function addCategory(Request $request)
    {
        KategoriReport::create([
            'name' => $request->name
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    function updateCategory(Request $request)
    {
        $category = KategoriReport::find($request->kategori_report_id);
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'success' => true
        ]);
    }

    function deleteCategory(Request $request)
    {
        $category = KategoriReport::find($request->kategori_report_id)->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
