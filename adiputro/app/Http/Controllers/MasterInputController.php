<?php

namespace App\Http\Controllers;

use App\Models\ApprovedByTI;
use App\Models\CheckedByTI;
use App\Models\Department;
use App\Models\FormReport;
use App\Models\InputGT;
use App\Models\InputGTApproved;
use App\Models\InputTI;
use App\Models\InputTIApproved;
use App\Models\ItemComponent;
use App\Models\ItemComponentProcessTI;
use App\Models\ItemComponentProcessEntry;
use App\Models\ItemLevel;
use App\Models\ItemLevelProcessEntry;
use App\Models\LevelProcessInputTI;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDefined;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageInter;
use Mockery\Undefined;
use PDF;
use Spatie\PdfToImage\Pdf as PdfToImagePdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MasterInputController extends Controller
{
    function getDay(){
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

    function getFormattedDate(){
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime();
        $formatted_date = $date->format('j F Y; h:i A');
        return $formatted_date;
    }

    function generateNomorLaporan()
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

        return $nomor_laporan;
    }

    function masterInput(Request $request)
    {
        $form_report_ti = FormReport::where("jenis","TI")->get();
        $form_report_gt = FormReport::where("jenis","Gambar Teknik")->get();
        $form_report_gambar = FormReport::where("jenis","Gambar Teknik")->get();
        $pembuat = Auth::user();
        $diperiksa_oleh = Role::where("name","Manager Engineering")->first()->users;
        $approved_by_bus = Department::where("access_database","SPK Mini Bus")->get();
        $approved_by_minibus = Department::where("access_database","SPK Bus")->get();
        $user_defined = UserDefined::all();
        $item_components = ItemComponent::all();
        $gts = InputGT::all();

        $input_ti = InputTI::where("status",1)->orderBy('kode_ti','asc')->get();
        return view("master.input", compact("form_report_ti","pembuat","diperiksa_oleh","approved_by_bus","approved_by_minibus","user_defined","input_ti", "form_report_gt","item_components","gts"));
    }

    function getLevelTI(Request $request)
    {
        $form_report = FormReport::where("nomor_laporan",$request->nomor_laporan_ti)->first();
        if($form_report == null){
            return response()->json([
                'success' => false,
            ]);
        }
        $item_level_ti = ItemLevel::find($form_report->item_level_id)->ancestorsAndSelf()->OrderBy("item_level_id")->get();

        return response()->json([
            'success' => true,
            'item_level_ti' => $item_level_ti
        ]);
    }

    function getProcessEntryTI(Request $request)
    {
        $item_level_process_entry = ItemLevelProcessEntry::whereIn("item_level_id",$request->level_proses_ti)->with('process_entry')->get();

        return response()->json([
            'success' => true,
            'item_level_process_entry' => $item_level_process_entry,
        ]);
    }

    function getCodeComponentTI(Request $request)
    {
        //table many to many ambil item_component dari item_level_process_entry berdasarkan process_entry dari item_component_process_entry
        $item_level_process_entry = ItemLevelProcessEntry::whereIn("item_level_id",$request->level_proses_ti)->where("process_entry_id",$request->process_entry_id)->with(['item_level','itemComponents'])->get();
        return response()->json([
            'success' => true,
            'item_level_process_entry' => $item_level_process_entry,
        ]);
    }

    function getComponentTI(Request $request)
    {
        //ambil component dari item_component_process_entry telusuri item_level lewat item_level_process_entry
        // $item_components = ItemComponent::whereIn("item_component_id",$request->item_component_ids)->get();
        $item_component_process_entry = ItemComponentProcessEntry::whereIn('item_component_process_entry_id',$request->item_component_process_entry_ids)
        ->with([
            'item_level_process_entry',
            'item_component',
            'item_level_process_entry.item_level'
        ])
        ->orderBy('item_component_process_entry_id')
        ->get();
        return response()->json([
            'success' => true,
            'item_component_process_entry' => $item_component_process_entry
        ]);
    }

    function getUserDefinedDescTI(Request $request)
    {
        $user_defined = UserDefined::find($request->user_defined_id);
        return response()->json([
            'success' => true,
            'user_defined' => $user_defined
        ]);
    }

    // function pdf_viewer(){
    //     // return view('pdf_viewer.input2_pdf');
    //     $pdf = PDF::loadView('pdf.input2', [
    //         'nomor_laporan_ti' => FormReport::find(1)->nomor_laporan,
    //         'nama_ti' => FormReport::find(1)->nomor_laporan,
    //         'no_ti' => 'TI-001',
    //         'tanggal' => '9 November 2023',
    //         'approved_by' => [Department::find(1)],
    //         'revisi' => 'A',
    //         'total_page' => 10,
    //         'printed_by' => 'John Doe / IT Department',
    //         'print_date' => '15 Juli 2023',
    //     ]);
    //     // sleep(3);
    //     $pdf->setPaper('a4','portrait');
    //     $pdf->setOption(['dpi' => 200, 'defaultFont' => 'sans-serif']);
    //     return $pdf->stream();
    // }

    function addTI(Request $request){
        $kode_ti = $request->kode_ti;
        $nomor_laporan_ti = $request->nomor_laporan_ti;
        $nama_ti = $request->nama_ti;
        $process_entry_id = $request->process_entry_ti; //isinya process_entry_id
        $level_proses_ti = $request->level_proses_ti; //bisa banyak
        $item_component_process_entry_ti = $request->kode_komponen_ti; //bisa banyak ini harusnya item_component_process_entry
        $pembuat = Auth::user(); //user
        $model = $request->model; //department_name
        $diperiksa_oleh = $request->diperiksa_oleh; //bisa banyak

        $cb_ti = [];
        if($request->cb_minibus_ti){
            $cb_ti = array_merge($cb_ti, $request->cb_minibus_ti); //bisa banyak
        }
        if($request->cb_bus_ti){
            $cb_ti = array_merge($cb_ti, $request->cb_bus_ti); //bisa banyak
        }
        $user_defined_ti = $request->user_defined_ti;
        // $description = $request->description;
        $photos = $request->photos; //bisa banyak

        //cek apakah kode_ti sudah ada, kalau sudah ada, dianggap sebagai revisi
        $input_ti_lama = InputTI::where("kode_ti",$kode_ti)->where("status",1)->first();
        $revisi = 0;
        if($input_ti_lama){
            $form_report = FormReport::where("nomor_laporan",$input_ti_lama->nomor_laporan)->first();
            // $form_report_baru = FormReport::create([
            //     "item_level_id" => $form_report->item_level_id,
            //     "nomor_laporan" => $nomor_laporan_ti,
            //     "kode" => $kode_ti,
            //     "tanggal" => now(),
            //     "pelapor_id" => Auth::user()->user_id,
            //     "kategori_report_id" => $form_report->kategori_report_id,
            //     "temuan" => $form_report->temuan,
            //     "jenis" => $form_report->jenis,
            // ]);
            //ambil approvedby department id sebelumnya
            $department_ids = array_map(function($department) {
                return $department["department_id"];
            }, $input_ti_lama->approved_by_ti->toArray());

            //gabung approvedby department id dengan yang baru ditambah
            // $cb_ti = array_merge($cb_ti, $department_ids);
            // $input_ti->level_process_input_ti()->detach();
            // $input_ti->item_level_ti()->detach();
            // $input_ti->item_component_ti()->detach();
            // $input_ti->checked_by_ti()->detach();
            // $input_ti->approved_by_ti()->detach();

            $revisi = $input_ti_lama->revisi + 1;
            $input_ti_lama->status = 0;
            $input_ti_lama->save();
        }

        $input_ti = InputTI::create([
            "revisi" => $revisi,
            "kode_ti" => $kode_ti,
            "process_entry_id" => $process_entry_id,
            "nomor_laporan" => $nomor_laporan_ti,
            "nama_ti" => $nama_ti,
            "model" => $model,
            "pembuat_id" => $pembuat->user_id,
            // "user_defined_id" => $user_defined_ti,
            // "description" => $description,
            "status" => 1,
        ]);

        //bisa banyak user defined
        foreach ($user_defined_ti as $key => $user_defined_id) {
            $user_defined = UserDefined::find($user_defined_id);
            $input_ti->user_defined()->attach($user_defined);
        }

        //level process only
        foreach ($level_proses_ti as $key => $level_proses) {
            $item_level = ItemLevel::find($level_proses);
            // $input_ti->level_process_input_ti()->attach($item_level, ["kode_ti" => $kode_ti]);
            $input_ti->level_process_input_ti()->attach($item_level);
        }

        //item component id with level process
        //diperbaiki
        foreach ($item_component_process_entry_ti as $key => $items) { //$items isinya item_component_process_entry_id
            $item_component_process_entry = ItemComponentProcessEntry::find($items);
            //$item isinya item_level_process_entry
            $item_level = ItemLevel::find($item_component_process_entry->item_level_process_entry->item_level_id);
            // $input_ti->item_level_ti()->attach($item_level, ["item_component_id" => $kode_komponen, "kode_ti" => $kode_ti]);
            $input_ti->item_level_ti()->attach($item_level, [
                "item_component_id" => $item_component_process_entry->item_component_id,
            ]);
        }

        foreach ($diperiksa_oleh as $key => $user_id) {
            $user = User::find($user_id);
            // $input_ti->checked_by_ti()->attach($user, ["kode_ti" => $kode_ti]);
            $input_ti->checked_by_ti()->attach($user);
        }

        //cb_ti diambil dari cb_minibus dan cb_bus isinya adalah department_id
        foreach ($cb_ti as $key => $department_id) {
            $department = Department::find($department_id);
            // $input_ti->approved_by_ti()->attach($department, ["kode_ti" => $kode_ti]);
            $input_ti->approved_by_ti()->attach($department);
        }

        // $kode_urutan = preg_replace('/\D/', '', $kode_ti);
        // $kode = str_pad($kode_urutan, 3, "0", STR_PAD_LEFT);
        $file = $request->file("photos")[0];
        $file->storeAs("pdf/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)), $file->getClientOriginalName(), 'public');
        $path = Storage::disk('public')->path('pdf/'.strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/'.$file->getClientOriginalName());
        $total_page = 0;
        // dd(Storage::url($pdf));
        if($request->file('photos')[0]->getClientOriginalExtension() == 'pdf'){
            $pdf = new PdfToImagePdf($path);
            if (!Storage::exists('public/images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)))) {
                Storage::makeDirectory('public/images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)));
            }
            foreach(range(1, $pdf->getNumberOfPages()) as $pageNumber) {
                $pdf->setPage($pageNumber)
                    ->setOutputFormat('png')
                    ->saveImage(Storage::disk('public')->path('images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp))));
            };
        }
        else{
            if($request->file("photos") != null){
                foreach($request->file("photos") as $key => $photo){
                    #code ..
                    $namafile = ($key+1).".".$photo->getClientOriginalExtension();
                    $namafolder = "images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp));
                    $photo->storeAs($namafolder,$namafile,'public');
                }
            }
        }
        //tambah watermark, ambil fotonya yang baru disimpan
        // $watermark = ImageInter::make(public_path(('img/controlled_copy.png')));
        // $watermark = ImageInter::make('public\controlled_copy.png');
        $photos = Storage::disk('public')->files("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)));

        date_default_timezone_set('Asia/Jakarta');

        foreach ($photos as $key => $photo) {
            $path = Storage::disk('public')->path($photo);
            $img = ImageInter::make($path);
            // $img->insert(public_path(('img/controlled_copy.png')), 'top-right', 0, 0);

            // $img->text($this->getDay().'; '.$this->getFormattedDate(), 20, 20, function($font) {
            //     $font->size(35);
            //     $font->color('#000000');
            //     $font->align('left');
            //     $font->valign('top');
            //     $font->angle(90);
            // });
            // dump(public_path("$photo"));
            $img->save(Storage::disk('public')->path($photo));
            $total_page++;
        }

        $tanggal = Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY');
        date_default_timezone_set('Asia/Jakarta');

        $print_date = Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY [AT] HH.mm');

        $approved_by = Department::whereIn('department_id', $cb_ti)->get();
        // $item_components = ItemComponent::whereIn('item_component_id', $request->kode_komponen_ti)->get();
        // $item_descriptions = $item_components->pluck('item_description');
        $pdf = PDF::loadView('pdf.input2', [
            'input_ti' => $input_ti,
            'nomor_laporan_ti' => $nomor_laporan_ti,
            'no_ti' => $kode_ti,
            'nama_ti' => $nama_ti,
            'model' => $input_ti->model,
            'tanggal' => $tanggal,
            'approved_by' => $approved_by,
            'revisi' => $revisi,
            'total_page' => $total_page,
            // 'printed_at' => 'EPSON L120 10.10.47.10',
            // 'printed_by' => Auth::user()->full_name.' / '.Auth::user()->department->name,
            // 'no_of_print' => 1,
            // 'print_date' => $print_date,
            'printed_at' => '-',
            'printed_by' => '-',
            'no_of_print' => '-',
            'print_date' => '-',
            'photos' => $photos,
        ]);

        // sleep(3);

        $pdf->setPaper('a4','portrait');
        $pdf->setOption(['dpi' => 200, 'defaultFont' => 'sans-serif']);

        // Simpan file PDF ke penyimpanan lokal
        $pdf->save(Storage::disk('public')->path("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/input2.pdf'));

        Alert::success('Sukses!', 'Berhasil Tambah TI!');
        return redirect("/master/input");
    }

    function loadKodeTI(Request $request)
    {
        $input_ti = FormReport::where("nomor_laporan", $request->nomor_laporan)->first();
        return response()->json([
            "success" => true,
            "kode_ti" => $input_ti->kode,
            "input_ti_id" => $input_ti->input_ti_id
        ]);
    }

    function loadInputTI(Request $request)
    {
        $nomor_laporan = $this->generateNomorLaporan();
        $input_ti = InputTI::where("kode_ti",$request->kode_ti)->where("status",1)->first();
        if($request->input_ti_id){
            $input_ti = InputTI::find($request->input_ti_id);
        }

        if(!$input_ti){
            return response()->json([
                "success" => false,
            ]);
        }

        $level_process_input_ti = $input_ti->level_process_input_ti;
        $item_level_ti = $input_ti->item_level_ti;
        $item_component_ti = $input_ti->item_component_ti;
        $checked_by_ti = $input_ti->checked_by_ti;
        $approved_by_ti = $input_ti->approved_by_ti;
        $user_defined_ti = $input_ti->user_defined;
        // $description = $input_ti->description;

        return response()->json([
            "success" => true,
            "input_ti" => $input_ti,
            "nomor_laporan" => $nomor_laporan
            // "level_process_input_ti" => $level_process_input_ti,
            // "item_level_ti" => $item_level_ti,
            // "item_component_ti" => $item_component_ti,
            // "checked_by_ti" => $checked_by_ti,
            // "approved_by_ti" => $approved_by_ti,
            // "user_defined_ti" => $user_defined_ti,
            // "description" => $description,
        ]);
    }

    function getDetailTI(Request $request)
    {
        $form_report_ti = FormReport::where("jenis","TI")->get();
        $form_report_gambar = FormReport::where("jenis","Gambar Teknik")->get();
        $pembuat = Auth::user();
        $diperiksa_oleh = Role::where("name","Manager Engineering")->first()->users;
        $approved_by_bus = Department::where("access_database","SPK Mini Bus")->get();
        $approved_by_minibus = Department::where("access_database","SPK Bus")->get();
        $user_defined = UserDefined::all();

        $input_ti_detail = InputTI::find($request->input_ti_id);
        $kode_ti = $input_ti_detail->kode_ti;

        $all_photos_ti = Storage::disk('public')->files("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti_detail->created_at->timestamp)));

        $input_ti = InputTI::where("status",1)->with("form_report")->orderBy('kode_ti','asc')->get();

        $input_ti_approved = InputTIApproved::where('input_ti_id', $input_ti_detail->input_ti_id)->get();
        $hasUserNowApproved = false;
        foreach ($input_ti_approved as $key => $ti_approved) {
            if($ti_approved->user_id == Auth::user()->user_id){
                $hasUserNowApproved = true;
            }
        }

        $path = Storage::disk('public')->path("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti_detail->created_at->timestamp)))."/input2.pdf";
        // dd(Storage::url($pdf));
        $pdf = new PdfToImagePdf($path);
        if (!Storage::exists('public/images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti_detail->created_at->timestamp))).'/pdf_to_img') {
            Storage::makeDirectory('public/images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti_detail->created_at->timestamp)).'/pdf_to_img');
        }
        foreach(range(1, $pdf->getNumberOfPages()) as $pageNumber) {
            $pdf->setPage($pageNumber)
                ->setOutputFormat('png')
                ->saveImage(Storage::disk('public')->path('images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti_detail->created_at->timestamp)).'/pdf_to_img'), true);
        };

        $all_photos_ti_from_pdf = Storage::disk('public')->files('images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti_detail->created_at->timestamp)).'/pdf_to_img');

        return view('master.input.ti.detail', compact("form_report_ti","pembuat","diperiksa_oleh","approved_by_bus","approved_by_minibus","user_defined","kode_ti","all_photos_ti","input_ti","input_ti_detail", "input_ti_approved", "hasUserNowApproved","all_photos_ti_from_pdf"));
    }

    function getGTByKodeTI(Request $request)
    {
        $input_ti = InputTI::where("kode_ti", $request->kode_ti)->where("status",1)->first();

        if(!isset($input_ti)){
            return response()->json([
                'success' => false,
            ]);
        }

        $kode_komponen = $input_ti->item_component_ti;
        try {
            $pivot = $input_ti->item_component_ti[0]->pivot;
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json([
            'success' => true,
            'input_ti' => $input_ti
        ]);
    }

    function getProcessEntryGT(Request $request)
    {
        $form_report_gt = FormReport::where("nomor_laporan", $request->nomor_laporan)->first();

        //alur pertama gambar teknik setelah memilih nomor laporan cek apakah sudah ada input kalau ada maka jadi edit
        $input_gt_detail = InputGT::where('kode_gt',$form_report_gt->kode)->where("status",1)->with('process_entry')->with('item_component')->with('checked_by_gt')->with('approved_by_gt')->with('user_defined')->first();

        if(isset($input_gt_detail)){
            return response()->json([
                'success' => true,
                'item_level_process_entry' => $form_report_gt->item_level_process_entry()->with("process_entry")->get(),
                'item_level_id' => $form_report_gt->item_level_id,
                'level' => $form_report_gt->item_level->level,
                'kode_gt' => $form_report_gt->kode,
                'input_gt_detail' =>$input_gt_detail,
                'user_defined' => $input_gt_detail->user_defined
            ]);
        }
        else{
            return response()->json([
                'success' => true,
                'item_level_process_entry' => $form_report_gt->item_level_process_entry()->with("process_entry")->get(),
                'item_level_id' => $form_report_gt->item_level_id,
                'level' => $form_report_gt->item_level->level,
                'kode_gt' => $form_report_gt->kode,
            ]);
        }


    }

    function getComponentGT(Request $request)
    {
        $item_level_process_entry = ItemLevelProcessEntry::where("item_level_id",$request->item_level_id)->where("process_entry_id",$request->process_entry_id)->with(['item_component_process_entry'])->first();
        if(!isset($item_level_process_entry)){
            return response()->json([
                'success' => false
            ]);
        }

        $item_components = [];
        foreach ($item_level_process_entry->item_component_process_entry as $key => $entry) {
            $item_components[] = ItemComponent::find($entry->item_component_id);
        }

        return response()->json([
            'success' => true,
            // 'item_level_process_entry' => $item_level_process_entry,
            'item_components' => $item_components,
        ]);
    }

    function getDetailComponentGT(Request $request)
    {
        $item_component = ItemComponent::where("item_number", $request->item_number)->first();

        return response()->json([
            'success' => true,
            // 'item_level_process_entry' => $item_level_process_entry,
            'item_component' => $item_component,
        ]);
    }

    function getDetailComponentModel(Request $request)
    {
        $item_component = ItemComponent::find($request->item_component_id);

        return response()->json([
            'success' => true,
            'item_component' => $item_component,
        ]);
    }
    function getDetailGTModel(Request $request)
    {
        $gt = InputGT::find($request->gt_id)->with('user_defined')->get();

        return response()->json([
            'success' => true,
            'gt' => $gt,
        ]);
    }

    function getUserDefinedDescGT(Request $request)
    {
        $user_defined = UserDefined::find($request->user_defined_id);
        return response()->json([
            'success' => true,
            'user_defined' => $user_defined
        ]);
    }

    function addGT(Request $request)
    {
        // dd($request);
        $kode_gt =$request->kode_gt; //
        $kode_ti = $request->kode_ti_gt;
        $nomor_laporan = $request->nomor_laporan_gt;
        $nama_gt = $request->nama_gt;
        $process_entry_gt = $request->process_entry_gt;
        $kode_komponen_gt = $request->kode_komponen_gt; // item_number
        $level_proses_gt = $request->level_proses_gt;
        $nama_komponen_gt = $request->nama_komponen_gt;
        $diperiksa_oleh_gt = $request->diperiksa_oleh_gt; // bisa banyak
        $cb_minibus_gt = $request->cb_minibus_gt; // bisa banyak
        $cb_bus_gt = $request->cb_bus_gt; // bisa banyak
        $user_defined_gt = $request->user_defined_gt; // user_defined_id
        $description_gt = $request->description_gt;

        $cb_gt = [];
        if($request->cb_minibus_gt){
            $cb_gt = array_merge($cb_gt, $request->cb_minibus_gt); //bisa banyak
        }
        if($request->cb_bus_gt){
            $cb_gt = array_merge($cb_gt, $request->cb_bus_gt); //bisa banyak
        }

        $revisi = 0;
        $item_component = ItemComponent::where("item_number", $kode_komponen_gt)->first();

        $input_gt_lama = InputGT::where("kode_gt", $kode_gt)->where('status',1)->first();
        $revisi = 0;
        if(isset($input_gt_lama)){
            $form_report = FormReport::where("nomor_laporan",$input_gt_lama->nomor_laporan)->first();
            $revisi = $input_gt_lama->revisi + 1;
            $input_gt_lama->status = 0;
            $input_gt_lama->save();
        }

        $input_gt = InputGT::create([
            "revisi" => $revisi,
            "kode_ti" => $kode_ti,
            "kode_gt" => $kode_gt,
            "process_entry_id" => $process_entry_gt,
            "nomor_laporan" => $nomor_laporan,
            "nama_gt" => $nama_gt,
            "item_component_id" => $item_component->item_component_id,
            // "user_defined_id" => $user_defined_gt,
            "status" => 1
            // "model" => $model,
            // "pembuat_id" => $pembuat->user_id,
            // "item_component_"
            // "status" => 1,
        ]);

        //bisa banyak user defined
        foreach ($user_defined_gt as $key => $user_defined_id) {
            $user_defined = UserDefined::find($user_defined_id);
            $input_gt->user_defined()->attach($user_defined);
        }

        foreach ($diperiksa_oleh_gt as $key => $user_id) {
            $user = User::find($user_id);
            // $input_ti->checked_by_ti()->attach($user, ["kode_ti" => $kode_ti]);
            $input_gt->checked_by_gt()->attach($user);
        }

        foreach ($cb_gt as $key => $department_id) {
            $department = Department::find($department_id);
            // $input_ti->approved_by_ti()->attach($department, ["kode_ti" => $kode_ti]);
            $input_gt->approved_by_gt()->attach($department);
        }

        $file = $request->file("photos")[0];
        $file->storeAs("pdf/".strval(date("Y-m-d H-i-s", $input_gt->created_at->timestamp)), $file->getClientOriginalName(), 'public');
        $path = Storage::disk('public')->path('pdf/'.strval(date("Y-m-d H-i-s", $input_gt->created_at->timestamp)).'/'.$file->getClientOriginalName());
        // dd(Storage::url($pdf));
        if($request->file('photos')[0]->getClientOriginalExtension() == 'pdf'){
            $pdf = new PdfToImagePdf($path);
            if (!Storage::exists('public/images/input/gt/'.strval(date("Y-m-d H-i-s", $input_gt->created_at->timestamp)))) {
                Storage::makeDirectory('public/images/input/gt/'.strval(date("Y-m-d H-i-s", $input_gt->created_at->timestamp)));
            }
            foreach(range(1, $pdf->getNumberOfPages()) as $pageNumber) {
                $pdf->setPage($pageNumber)
                    ->setOutputFormat('png')
                    ->saveImage(Storage::disk('public')->path('images/input/gt/'.strval(date("Y-m-d H-i-s", $input_gt->created_at->timestamp)).'/'));
            };
        }
        else{
            if($request->file("photos") != null){
                foreach($request->file("photos") as $key => $photo){
                    #code ..
                    $namafile = ($key+1).".".$photo->getClientOriginalExtension();
                    $namafolder = "images/input/gt/".strval(date("Y-m-d H-i-s", $input_gt->created_at->timestamp));
                    $photo->storeAs($namafolder,$namafile,'public');
                }
            }
        }
        //tambah watermark, ambil fotonya yang baru disimpan
        // $watermark = ImageInter::make(public_path(('img/controlled_copy.png')));
        // $watermark = ImageInter::make('public\controlled_copy.png');
        $photos = Storage::disk('public')->files("images/input/gt/".strval(date("Y-m-d H-i-s", $input_gt->created_at->timestamp)));
        foreach ($photos as $key => $photo) {
            $path = Storage::disk('public')->path($photo);
            $img = ImageInter::make($path);
            // $img->insert(public_path(('img/controlled_copy.png')), 'top-right', 0, 0);
            // $img->text($this->getDay().'; '.$this->getFormattedDate(), 20, 20, function($font) {
            //     $font->size(35);
            //     $font->color('#000000');
            //     $font->align('left');
            //     $font->valign('top');
            //     $font->angle(90);
            // });
            $img->save(Storage::disk('public')->path($photo));
        }

        Alert::success('Sukses!', 'Berhasil Tambah Gambar Teknik!');
        return redirect("/master/input");
    }

    function getDetailGT(Request $request)
    {
        $form_report_ti = FormReport::where("jenis","TI")->get();
        $form_report_gt = FormReport::where("jenis","Gambar Teknik")->get();
        $pembuat = Auth::user();
        $diperiksa_oleh = Role::where("name","Manager Engineering")->first()->users;
        $approved_by_bus = Department::where("access_database","SPK Mini Bus")->get();
        $approved_by_minibus = Department::where("access_database","SPK Bus")->get();
        $user_defined = UserDefined::all();

        // $input_gt_detail = InputGT::with('process_entry')->find($request->input_gt_id);
        $input_gt_detail = InputGT::where('input_gt_id',$request->input_gt_id)->with('process_entry')->with('item_component')->with('checked_by_gt')->with('approved_by_gt')->with('user_defined')->first();
        $form_report_gt_detail = FormReport::where("nomor_laporan",$input_gt_detail->nomor_laporan)->first();
        $kode_gt = $input_gt_detail->kode_gt;

        $all_photos_gt = Storage::disk('public')->files("images/input/gt/".strval(date("Y-m-d H-i-s", $input_gt_detail->created_at->timestamp)));
        // $input_gt_detail = html_entity_decode($input_gt_detail);
        // $input_gt_detail_json = json_encode($input_gt_detail);

        $input_gt = InputGT::where("status",1)->with("form_report")->orderBy('kode_gt','asc')->get();
        $input_gt_approved = InputGTApproved::where('input_gt_id', $input_gt_detail->input_gt_id)->get();
        $hasUserNowApproved = false;
        foreach ($input_gt_approved as $key => $gt_approved) {
            if($gt_approved->user_id == Auth::user()->user_id){
                $hasUserNowApproved = true;
            }
        }
        return view('master.input.gt.detail', [
            "form_report_ti" => $form_report_ti,
            "form_report_gt" => $form_report_gt,
            "pembuat" => $pembuat,
            "diperiksa_oleh" => $diperiksa_oleh,
            "approved_by_bus" => $approved_by_bus,
            "approved_by_minibus" => $approved_by_minibus,
            "user_defined" => $user_defined,
            "kode_gt" => $kode_gt,
            "all_photos_gt" => $all_photos_gt,
            "input_gt" => $input_gt,
            "input_gt_detail" => $input_gt_detail,
            "item_level_process_entry" => $form_report_gt_detail->item_level_process_entry()->with("process_entry")->get(),
            "hasUserNowApproved" => $hasUserNowApproved,
            "input_gt_approved" => $input_gt_approved
        ]);
    }

    function approveTI(Request $request)
    {
        $input_ti_approved = InputTIApproved::create([
            "input_ti_id" => $request->input_ti_id,
            "user_id" => Auth::user()->user_id
        ]);

        $input_ti = InputTI::find($request->input_ti_id);
        $photos = Storage::disk('public')->files("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)));
        $photos = array_filter($photos, function($photo) {
            return Str::endsWith($photo, ['.png', '.jpg']);
        });
        $qrcodes = Storage::disk('public')->files("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/qrcode');
        $form_report = FormReport::where('nomor_laporan', $input_ti->nomor_laporan)->first();
        // $destinationFolder = "images/input/approved/ti/item_level_id_$form_report->item_level_id";
        // Storage::makeDirectory($destinationFolder);
        $total_page = count($photos);
        // foreach ($photos as $photo) {
        //     $filename = pathinfo($photo, PATHINFO_FILENAME);
        //     $extension = pathinfo($photo, PATHINFO_EXTENSION);
        //     $newFilename = $filename . '.' . $extension;

        //     // Copy the photo to the destination folder
        //     Storage::disk('public')->copy($photo, $destinationFolder . '/' . $newFilename);
        //     $total_page++;
        // }

        $qrcode = QrCode::size(200)->format('png')->generate(
            Auth::user()->full_name.'; '.
            Auth::user()->role->name.'; '.
            Auth::user()->department->name.'; '.
            $this->getDay().'; '.$this->getFormattedDate()
        );
        if (!Storage::exists('public/images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/qrcode')) {
            Storage::makeDirectory('public/images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/qrcode');
        }
        Storage::disk('public')->put('images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/qrcode/'.Auth::user()->user_id.'.png', $qrcode);

        $tanggal = Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY');
        date_default_timezone_set('Asia/Jakarta');

        $print_date = Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY [AT] HH.mm');

        $cb_ti = ApprovedByTI::where('input_ti_id', $input_ti->input_ti_id)->get()->pluck('department_id');
        $input_ti_approved = InputTIApproved::where('input_ti_id', $input_ti->input_ti_id)->get();
        $approved_by_ti = ApprovedByTI::where('input_ti_id', $input_ti->input_ti_id)->get();
        $is_approved_by_all_departments = true;
        foreach ($input_ti_approved as $key => $input_user) {
            $is_approved_by_department = false;
            foreach ($approved_by_ti as $key => $approved) {
                //check whether approved by all departments then add input_ti_id to item_level
                if($input_user->user->department->department_id == $approved->department_id){
                    $is_approved_by_department = true;
                    break;
                }
            }
            $is_approved_by_all_departments = $is_approved_by_department;
        }
        if($is_approved_by_all_departments){
            $form_report = FormReport::where('nomor_laporan', $input_ti->nomor_laporan)->first();
            $item_level = ItemLevel::find($form_report->item_level_id);
            $item_level->input_ti_id = $input_ti->input_ti_id;
            $ancestors = $item_level->ancestors()->get();

            foreach ($ancestors as $ancestor) {
                $ancestor->input_ti_id = $input_ti->input_ti_id;
                $ancestor->save();
            }
            $item_level->save();
        }

        $approved_by = Department::whereIn('department_id', $cb_ti)->get();
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
            // 'printed_at' => 'EPSON L120 10.10.47.10',
            // 'printed_by' => Auth::user()->full_name.' / '.Auth::user()->department->name,
            // 'no_of_print' => 1,
            // 'print_date' => $print_date,
            'printed_at' => '-',
            'printed_by' => '-',
            'no_of_print' => '-',
            'print_date' => '-',
            'photos' => $photos,
            'input_ti_approved' => $input_ti_approved,
            'qrcodes' => $qrcodes,
        ]);

        $pdf->setPaper('a4','portrait');
        $pdf->setOption(['dpi' => 200, 'defaultFont' => 'sans-serif']);

        // Simpan file PDF ke penyimpanan lokal
        $pdf->save(Storage::disk('public')->path("images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/input2.pdf'));

        Alert::success('Sukses!', 'Berhasil Approve TI!');
        return back();
    }

    function approveGT(Request $request)
    {
        $input_gt_approved = InputGTApproved::create([
            "input_gt_id" => $request->input_gt_id,
            "user_id" => Auth::user()->user_id
        ]);
        $input_gt = InputGT::find($request->input_gt_id);
        $photos = Storage::disk('public')->files("images/input/gt/".strval(date("Y-m-d H-i-s", $input_gt->created_at->timestamp)));
        $form_report = FormReport::where('nomor_laporan', $input_gt->nomor_laporan)->first();
        $destinationFolder = "images/input/approved/gt/item_component_id_$request->item_component_id";
        Storage::makeDirectory($destinationFolder);
        // foreach ($photos as $photo) {
        //     $fileName = basename($photo);
        //     Storage::disk('public')->put($destinationFolder . '/' . $fileName, file_get_contents($photo));
        // }
        foreach ($photos as $photo) {
            $filename = pathinfo($photo, PATHINFO_FILENAME);
            $extension = pathinfo($photo, PATHINFO_EXTENSION);
            $newFilename = $filename . '.' . $extension;

            // Copy the photo to the destination folder
            Storage::disk('public')->copy($photo, $destinationFolder . '/' . $newFilename);
        }
        Alert::success('Sukses!', 'Berhasil Approve Gambar Teknik!');
        return back();
    }

    function addModel(Request $request){

        if($request->images != null){
            $folderPath = "images/input/model/{$request->item_component_id}";
            $files = Storage::disk('public')->files($folderPath);
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }

            $images = $request->images;
            $texts = $request->texts;

            for ($i=0; $i < count($images); $i++) {
                if($images[$i]!="null"){
                    $photo = $images[$i];
                    $namafile = $texts[$i].".".$photo->getClientOriginalExtension();
                    $namafolder = "images/input/model/".$request->item_component_id;
                    $photo->storeAs($namafolder,$namafile,'public');
                }
            }

            return response()->json([
                'success' => true,
                'message'=>$request->images
            ]);
        }
        return response()->json([
            'success' => false,
            'message'=>$request->images
        ]);
    }
}
