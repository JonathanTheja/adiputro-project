<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ItemLevel;
use App\Models\item_level;
use App\Models\ItemComponent;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
class MasterDataController extends Controller
{
    function masterData(Request $request)
    {
        $item_levels = ItemLevel::tree()->get()->toTree();
        // $item_levels = item_level::find(3)->descendantsAndSelf()->delete();
        // dd($item_levels);
        return view("master.data", compact("item_levels"));
    }

    function addData(Request $request)
    {
        $item_level = ItemLevel::create([
            "name" => $request->name,
            "parent_id" => $request->item_level_id,
        ]);
        Alert::success('Sukses!', 'Berhasil Tambah Komponen Baru!');
        return back();
    }

    function toUpdate(Request $request)
    {
        $item_level_id = $request->item_level_id;
        $departments = Department::all();
        $item_components = ItemComponent::all();
        $item_level = ItemLevel::find($item_level_id);

        return view('master.partials.data_edit',compact("item_level","departments","item_components"));
    }

    function updateData(Request $request)
    {
        $item_level = ItemLevel::find($request->item_level_id);
        $item_level->name = $request->name;
        $item_level->departments()->detach();

        //update departments
        foreach ($request->departments as $department) {
            # code...
            $item_level->departments()->attach($department);
        }
        foreach ($request->components as $component) {
            # code...
            $item_level->itemComponents()->attach($component);
        }
        $item_level->save();
        foreach($request->file("photos") as $photo){
            #code ..
            $namafile = Str::random(8).".".$photo->getClientOriginalExtension();
            $namafolder = "gambar_komponen/".$request->item_level_id;
            $photo->storeAs($namafolder,$namafile,'public');
        }
        Alert::success('Sukses!', 'Berhasil Update Komponen!');
        return redirect('master/data');
    }

    function deleteData(Request $request)
    {
        $item_levels = ItemLevel::find($request->item_level_id)->descendantsAndSelf()->delete();
        Alert::success('Sukses!', 'Berhasil Delete Komponen!');
        return back();
    }

    function getData(Request $request)
    {
        $item_level_id = $request->item_level_id;
        $item_level = ItemLevel::find($item_level_id);
        $item_components = $item_level->itemComponents;

        return response()->json([
            'success' => true,
            'data'    => [
                "item_level"=>$item_level,
                "item_components"=>$item_components
            ],

        ]);
    }
}
