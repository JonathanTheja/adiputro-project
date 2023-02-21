<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterDataController extends Controller
{
    function masterData(Request $request)
    {
        $spks = Spk::tree()->get()->toTree();
        // $spks = Spk::find(3)->descendantsAndSelf()->delete();
        // dd($spks);
        return view("master.data", compact("spks"));
    }

    function addData(Request $request)
    {
        $spk = Spk::create([
            "name" => $request->name,
            "parent_id" => $request->spk_id,
        ]);
        Alert::success('Sukses!', 'Berhasil Tambah Komponen Baru!');
        return back();
    }

    function updateData(Request $request)
    {
        $spk = Spk::find($request->spk_id);
        $spk->name = $request->name;
        $spk->save();
        Alert::success('Sukses!', 'Berhasil Update Komponen!');
        return back();
    }

    function deleteData(Request $request)
    {
        $spks = Spk::find($request->spk_id)->descendantsAndSelf()->delete();
        Alert::success('Sukses!', 'Berhasil Delete Komponen!');
        return back();
    }
}
