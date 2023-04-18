<?php

namespace App\Http\Controllers;

use App\Models\ApprovedByTI;
use App\Models\CheckedByTI;
use App\Models\Department;
use App\Models\FormReport;
use App\Models\InputGT;
use App\Models\InputTI;
use App\Models\ItemComponent;
use App\Models\ItemComponentProcessTI;
use App\Models\ItemComponentProcessEntry;
use App\Models\ItemLevel;
use App\Models\ItemLevelProcessEntry;
use App\Models\LevelProcessInputTI;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDefined;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class MasterInputController extends Controller
{
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

        $input_ti = InputTI::where("status",1)->orderBy('kode_ti','asc')->get();
        return view("master.input", compact("form_report_ti","pembuat","diperiksa_oleh","approved_by_bus","approved_by_minibus","user_defined","input_ti", "form_report_gt"));
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

    function addTI(Request $request){
        // dd($request);
        $kode_ti = $request->kode_ti;
        $nomor_laporan_ti = $request->nomor_laporan_ti;
        $nama_ti = $request->nama_ti;
        $process_entry_id = $request->process_entry_ti; //isinya process_entry_id
        $level_proses_ti = $request->level_proses_ti; //bisa banyak
        $item_component_process_entry_ti = $request->kode_komponen_ti; //bisa banyak ini harusnya item_component_process_entry
        $pembuat = Auth::user(); //user
        $model = $request->model; //department_id
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
            $form_report_baru = FormReport::create([
                "item_level_id" => $form_report->item_level_id,
                "nomor_laporan" => $nomor_laporan_ti,
                "tanggal" => now(),
                "pelapor_id" => Auth::user()->user_id,
                "kategori_report_id" => $form_report->kategori_report_id,
                "temuan" => $form_report->temuan,
                "jenis" => $form_report->jenis,
            ]);
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
            "user_defined_id" => $user_defined_ti,
            // "description" => $description,
            "status" => 1,
        ]);

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
        if($request->file("photos") != null){
            foreach($request->file("photos") as $key => $photo){
                #code ..
                $namafile = ($key+1).".".$photo->getClientOriginalExtension();
                $namafolder = "images/input/ti/".strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp));
                $photo->storeAs($namafolder,$namafile,'public');
            }
        }

        Alert::success('Sukses!', 'Berhasil Tambah TI!');
        return redirect("/master/input");
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
        return view('master.input.ti.detail', compact("form_report_ti","pembuat","diperiksa_oleh","approved_by_bus","approved_by_minibus","user_defined","kode_ti","all_photos_ti","input_ti","input_ti_detail"));
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

        return response()->json([
            'success' => true,
            'item_level_process_entry' => $form_report_gt->item_level_process_entry()->with("process_entry")->get(),
            'item_level_id' => $form_report_gt->item_level_id,
            'level' => $form_report_gt->item_level->level,
        ]);
    }

    function getComponentGT(Request $request)
    {
        $item_level_process_entry = ItemLevelProcessEntry::where("item_level_id",$request->item_level_id)->where("process_entry_id",$request->process_entry_id)->with(['item_component_process_entry'])->first();

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

        $input_gt = InputGT::create([
            "revisi" => $revisi,
            "kode_ti" => $kode_ti,
            "kode_gt" => $kode_gt,
            "process_entry_id" => $process_entry_gt,
            "nomor_laporan" => $nomor_laporan,
            "nama_gt" => $nama_gt,
            "item_component_id" => $item_component->item_component_id,
            "user_defined_id" => $user_defined_gt,
            "status" => 1
            // "model" => $model,
            // "pembuat_id" => $pembuat->user_id,
            // "item_component_"
            // "status" => 1,
        ]);

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

        Alert::success('Sukses!', 'Berhasil Tambah Gambar Teknik!');
        return redirect("/master/input");
    }
}
