<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\Department;
use App\Models\DepartmentItemLevel;
use App\Models\ItemLevel;
use App\Models\item_level;
use App\Models\ItemComponent;
use App\Models\ItemKit;
use App\Models\ProcessEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Builder;

class MasterDataController extends Controller
{
    function masterData(Request $request)
    {
        $item_levels = ItemLevel::tree()->get()->toTree();
        // $item_levels = ItemLevel::whereIn("item_level_id",[1,3])->tree()->get();
        // dump($item_levels->toTree());
        // dd($item_levels);
        // $item_levels = ItemLevel::all();
        $max = 0;

        $item_level_id = array();

        $department_id = 1;
        $department_item_level = DepartmentItemLevel::where("department_id","=",$department_id)->get();
        foreach ($department_item_level as $key => $item) {
            $item_level_id[] = $item->item_level_id;
        }

        // $constraint = function ($query) {
        //     $department_id = 1;
        //     $department_item_level = DepartmentItemLevel::where("department_id","=",$department_id)->get();
        //     foreach ($department_item_level as $key => $item) {
        //         $item_level_id[] = $item->item_level_id;
        //     }
        //     // dump($item_level_id);
        //     $query->whereNull('parent_id')->where('item_level_id', [1,9]);
        // };

        // $item_levels = ItemLevel::treeOf($constraint)->get()->toTree();

        foreach ($item_levels as $key => $item_level) {
            if($item_level->getMaxChildrenDepth() > $max){
                $max = $item_level->getMaxChildrenDepth();
            }
        }

        // dump($tree);

        // $item_levels = item_level::find(3)->descendantsAndSelf()->delete();
        // dd($item_levels);
        return view("master.data", compact("item_levels","max"));
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
        $item_level = ItemLevel::find($item_level_id);
        $item_level_parent = $item_level->parent()->first();
        $department = null;
        if($item_level_parent == null){
            $departments = Department::all();
        }
        else{
            $departments = $item_level_parent->departments;
        }
        $item_components = ItemComponent::all();
        $item_kit = ItemKit::all();
        $bom = Bom::all();
        $process_entry = ProcessEntry::all();
        return view('master.partials.data_edit',compact("item_level","departments","item_components","item_kit","bom","process_entry"));
    }

    function updateData(Request $request)
    {
        $item_level = ItemLevel::find($request->item_level_id);
        $item_level->name = $request->name;
        $item_level->departments()->detach();

        $departments = $request->departments ?? [];
        $components = $request->components ?? [];

        //update departments
        foreach ($departments as $department) {
            # code...
            $item_level->departments()->attach($department);
        }
        foreach ($components as $component) {
            # code...
            $item_level->itemComponents()->attach($component);
        }
        $item_level->save();

        if($request->file("photos") != null){
            foreach($request->file("photos") as $photo){
                #code ..
                $namafile = Str::random(8).".".$photo->getClientOriginalExtension();
                $namafolder = "images/".$request->item_level_id;
                $photo->storeAs($namafolder,$namafile,'public');
            }
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
        //get pictures
        $allPhotos = Storage::disk('public')->files("images/$item_level_id");

        return response()->json([
            'success' => true,
            'data'    => [
                "item_level"=>$item_level,
                "item_components"=>$item_components,
                "all_photos"=>$allPhotos
            ],

        ]);
    }
    function getProcessEntryData(Request $request){
        //rule
        //item kit , bom id
        $item_kit_list_id = $request->item_kits ?? [];
        $bom_list_id = $request->boms ?? [];
        $item_kit_lists = [];
        $bom_lists = [];

        //returned components (merged)
        $components = [];

        foreach($item_kit_list_id as $item_kit_id){
            $item_kit_lists[] = ItemKit::find($item_kit_id);
        }
        foreach($bom_list_id as $bom_id){
            $bom_lists[] = Bom::find($bom_id);
        }

        //components
        // - component-id
        // - component-code
        // - component-name

        foreach($item_kit_lists as $item_kit){
            $ikit_components = $item_kit->itemComponents;
            foreach ($ikit_components as $comp) {

                # code...
               $comp_id = (($comp->item_component_id)."");
               if(Arr::exists($components,$comp_id)){
                 //icr
                 $components[$comp_id]["item_qty"] =  $components[$comp_id]["item_qty"] + $comp->pivot->item_component_qty;
               }
               else{
                $new_comp = [
                    "item_component_id"=>$comp->item_component_id,
                    "item_number"=>$comp->item_number,
                    "item_description"=>$comp->item_description,
                    "item_qty"=>$comp->pivot->item_component_qty,
                    "item_uofm"=>$comp->item_uofm
                  ];
                  $components[$comp_id] = $new_comp;
               }
            }
        }

        foreach($bom_lists as $bom){
            $b_components = $bom->itemComponents;
            foreach ($b_components as $comp) {
                # code...
               $comp_id = (($comp->item_component_id)."");
               if(Arr::exists($components,$comp_id)){
                 //icr
                 $components[$comp_id]["item_qty"] =  $components[$comp_id]["item_qty"] + $comp->pivot->consumed_qty;
               }
               else{
                $new_comp = [
                    "item_component_id"=>$comp->item_component_id,
                    "item_number"=>$comp->item_number,
                    "item_description"=>$comp->item_description,
                    "item_qty"=>$comp->pivot->consumed_qty,
                    "item_uofm"=>$comp->item_uofm
                  ];
                  $components[$comp_id] = $new_comp;
               }
            }
        }
        //ok
        Session::put("components.temp",$components);
        Session::put("components.virtual",$components);
        return response()->json([
            'success' => true,
            'data'    => [
                "components"=>$components
            ],
        ]);
    }
    function getSpecComponent(Request $request)
    {
        $item_number = $request->item_number;
        //find in session
        $item_component_id = ItemComponent::where('item_number',$item_number)->first()->item_component_id;
        $item_component_id = $item_component_id."";
        $item = Session::get('components.temp')[$item_component_id];
        return response()->json([
            'success' => true,
            'data'    => [
                "item"=>$item
            ],
        ]);
    }
}
