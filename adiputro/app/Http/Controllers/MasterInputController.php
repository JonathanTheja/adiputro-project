<?php

namespace App\Http\Controllers;

use App\Models\ApprovedByTI;
use App\Models\CheckedByTI;
use App\Models\Department;
use App\Models\FormReport;
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
    function masterInput(Request $request)
    {
        $form_report_ti = FormReport::where("jenis","TI")->get();
        $form_report_gambar = FormReport::where("jenis","Gambar Teknik")->get();
        $pembuat = Auth::user();
        $diperiksa_oleh = Role::where("name","Manager Engineering")->first()->users;
        $approved_by_bus = Department::where("access_database","SPK Mini Bus")->get();
        $approved_by_minibus = Department::where("access_database","SPK Bus")->get();
        $user_defined = UserDefined::all();

        $input_ti = InputTI::where("status",1)->orderBy('kode_ti','asc')->get();
        return view("master.input", compact("form_report_ti","pembuat","diperiksa_oleh","approved_by_bus","approved_by_minibus","user_defined","input_ti"));
    }

    function getLevelTI(Request $request)
    {
        $form_report = FormReport::where("nomor_laporan",$request->nomor_laporan_ti)->first();
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
            'item_level_process_entry' => $item_level_process_entry
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
            //ambil approvedby department id sebelumnya
            $department_ids = array_map(function($department) {
                return $department["department_id"];
            }, $input_ti_lama->approved_by_ti->toArray());

            $revisi = $input_ti_lama->revisi + 1;
            $input_ti_lama->status = 0;

            //gabung approvedby department id dengan yang baru ditambah
            // $cb_ti = array_merge($cb_ti, $department_ids);
            // $input_ti->level_process_input_ti()->detach();
            // $input_ti->item_level_ti()->detach();
            // $input_ti->item_component_ti()->detach();
            // $input_ti->checked_by_ti()->detach();
            // $input_ti->approved_by_ti()->detach();
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

        $input_ti = InputTI::where("status",1)->orderBy('kode_ti','asc')->get();
        return view('master.input.ti.detail', compact("form_report_ti","pembuat","diperiksa_oleh","approved_by_bus","approved_by_minibus","user_defined","kode_ti","all_photos_ti","input_ti","input_ti_detail"));
    }

    function getGTByKodeTI(Request $request)
    {
        $input_ti = InputTI::where("kode_ti", $request->kode_ti)->where("status",1)->first();
        $kode_komponen = $input_ti->item_component_ti;
        try {
            $pivot = $input_ti->item_component_ti[0]->pivot;
        } catch (\Throwable $th) {
            //throw $th;
        }

        //masih salah
        return response()->json([
            'success' => true,
            'input_ti' => $input_ti
        ]);
    }

    function getComponentGT(Request $request)
    {
        //masih salah
        return response()->json([
            'success' => true,
            'request' => $request->item_component_id
        ]);
    }

    function addGT(Request $request)
    {
        dd($request);
        // $kode_ti = $request->kode_ti;
        // $kode_ti = $request->kode_ti;
        // $nomor_laporan_ti = $request->nomor_laporan_ti;
        // $nama_ti = $request->nama_ti;
        // $level_proses_ti = $request->level_proses_ti; //bisa banyak
        // $kode_komponen_ti = $request->kode_komponen_ti; //bisa banyak
        // $pembuat = Auth::user(); //user
        // $model = $request->model; //department_id
        // $diperiksa_oleh = $request->diperiksa_oleh; //bisa banyak
    }
}
