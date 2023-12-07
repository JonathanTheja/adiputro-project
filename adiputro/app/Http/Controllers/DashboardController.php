<?php

namespace App\Http\Controllers;

use App\Models\ApprovedByTI;
use App\Models\Department;
use App\Models\FormReport;
use App\Models\InputTI;
use App\Models\InputTIApproved;
use App\Models\ItemLevel;
use App\Models\KategoriReport;
use App\Models\PrintInput2;
use Carbon\Carbon;
use DateTime;
use Exception;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use PDF;
use Spatie\PdfToImage\Pdf as PdfToImagePdf;

class DashboardController extends Controller
{
    function getDay()
    {
        date_default_timezone_set('Asia/Jakarta');
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

        return $hari[$day];
    }

    function getFormattedDate()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime();
        $formatted_date = $date->format('j F Y; h:i A');
        return $formatted_date;
    }

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
            $this->getDay().'; '.$this->getFormattedDate()
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

    function printSOP(Request $request)
    {
        $input_ti = InputTI::find($request->input_ti_id);
        $photos = Storage::disk('public')->files("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)));
        $photos = array_filter($photos, function($photo) {
            return Str::endsWith($photo, ['.png', '.jpg']);
        });
        $qrcodes = Storage::disk('public')->files("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/qrcode');
        $form_report = FormReport::where('nomor_laporan', $input_ti->nomor_laporan)->first();
        $total_page = count($photos);

        $tanggal = Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY');
        date_default_timezone_set('Asia/Jakarta');

        $print_date = Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY [AT] HH.mm');

        $cb_ti = ApprovedByTI::where('input_ti_id', $input_ti->input_ti_id)->get()->pluck('department_id');
        $input_ti_approved = InputTIApproved::where('input_ti_id', $input_ti->input_ti_id)->get();
        $approved_by_ti = ApprovedByTI::where('input_ti_id', $input_ti->input_ti_id)->get();

        $approved_by = Department::whereIn('department_id', $cb_ti)->get();

        $print_input2 = PrintInput2::create([
            'input_ti_id' => $input_ti->input_ti_id,
            'user_id' => Auth::user()->user_id,
            'printed_at' => 'EPSON L120 10.10.47.10'
        ]);
        $all_print_input2 = PrintInput2::where('input_ti_id', $input_ti->input_ti_id)->get();
        $total_print = count($all_print_input2);

        $pdf = PDF::loadView('pdf.input2', [
            'input_ti' => $input_ti,
            'nomor_laporan_ti' => $input_ti->form_report->nomor_laporan,
            'no_ti' => $input_ti->kode_ti,
            'nama_ti' => $input_ti->nama_ti,
            'model' => $input_ti->model,
            'tanggal' => $tanggal,
            'approved_by' => $approved_by,
            'revisi' => $input_ti->revisi,
            'total_page' => $total_page,
            'printed_at' => 'EPSON L120 10.10.47.10',
            'printed_by' => Auth::user()->full_name.' / '.Auth::user()->department->name,
            'no_of_print' => $total_print,
            'print_date' => $print_date,
            'photos' => $photos,
            'input_ti_approved' => $input_ti_approved,
            'qrcodes' => $qrcodes,
        ]);

        $pdf->setPaper('a4','portrait');
        $pdf->setOption(['dpi' => 200, 'defaultFont' => 'sans-serif']);

        return $pdf->stream();
    }
}
