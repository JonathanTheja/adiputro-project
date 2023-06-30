<?php

namespace App\Http\Controllers;

use App\Models\InputGT;
use App\Models\InputTI;
use App\Models\ItemLevelProcessEntry;
use App\Models\ProcessEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Process\Process;

class ProcessEntryController extends Controller
{
    //
    function index()
    {
        # code...
        //get all process entries
        $pes = ProcessEntry::all();
        $department = Auth::user()->department->name;
        return view('master.process_entry',[
            "process_entries"=>$pes,
            "department"=>$department
        ]);
    }

    function getProcessEntries(Request $request){
        $pes = ProcessEntry::all();
        return response()->json([
            'success' => true,
            'process_entries' => $pes
        ]);
    }

    function addNewProcessEntry(Request $request){
        // dd($request->all());
        ProcessEntry::create([
            "spk_type"=>$request->spk_type,
            "process_name"=>$request->process_name,
            "process_number"=>$request->process_number,
            "stall_number"=>$request->stall_number,
            "work_description"=>$request->work_description,
            "pic"=>$request->pic,
            "status"=>'manual'
        ]);
        Alert::success('Sukses!', 'Berhasil Tambah Process Entry!');
        return back();
    }

    function deleteProcessEntry(Request $request)
    {
        $id = $request->id;
        $itemLevelProcessEntryExists = ItemLevelProcessEntry::where('process_entry_id', $id)->exists();
        $inputGtExists = InputGT::where('process_entry_id', $id)->exists();
        $inputTiExists = InputTI::where('process_entry_id', $id)->exists();
        if ($itemLevelProcessEntryExists || $inputGtExists || $inputTiExists) {
            return response()->json([
                'success' => false,
                'message' => "Process Entry digunakan di tabel lain!",
                "process_entries"
            ]);
        }

        ProcessEntry::where('process_entry_id', $id)->delete();
        $pes = ProcessEntry::all();
        return response()->json([
            'success' => true,
            'message' => "Berhasil hapus process entry!",
            'process_entries'=>$pes
        ]);
    }


}
