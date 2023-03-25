<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\Department;
use App\Models\DepartmentItemLevel;
use App\Models\ItemLevel;
use App\Models\item_level;
use App\Models\ItemComponent;
use App\Models\ItemComponentProcessEntry;
use App\Models\ItemKit;
use App\Models\ItemLevelProcessEntry;
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
    function setItemLevels($item_levels, $level)
    {
        $item_levels->level = $level;
        $item_levels->save();

        foreach ($item_levels->children as $key => $item_level) {
            $this->setItemLevels($item_level, $level+1);
        }
    }

    function masterData(Request $request)
    {
        $item_levels = ItemLevel::tree()->get()->toTree();

        $max = 0;

        $item_level_id = array();

        $department_id = 1;
        $department_item_level = DepartmentItemLevel::where("department_id","=",$department_id)->get();
        foreach ($department_item_level as $key => $item) {
            $item_level_id[] = $item->item_level_id;
        }

        foreach ($item_levels as $key => $item_level) {
            if($item_level->getMaxChildrenDepth() > $max){
                $max = $item_level->getMaxChildrenDepth();
            }
        }
        return view("master.data", compact("item_levels","max"));
    }

    function addData(Request $request)
    {
        $item_level = ItemLevel::create([
            "name" => $request->name,
            "parent_id" => $request->item_level_id,
        ]);
        $item_levels = ItemLevel::tree()->get()->toTree();
        foreach ($item_levels as $key => $item_level) {
            $this->setItemLevels($item_level,0);
        }
        Alert::success('Sukses!', 'Berhasil Tambah Komponen Baru!');
        return back();
    }

    function toUpdate(Request $request)
    {
        Session::forget("sess");
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

        $item_level_pes = $item_level->processEntries;

        //DONE--
        foreach ($item_level_pes as $item_level_pe) {
            //make a new session table && components
            //itl_pe -> item level process entry
            //ics -> item components
            $itl_pe = ItemLevelProcessEntry::find($item_level_pe->pivot->item_level_process_entry_id);
            $ics = ($itl_pe->itemComponents);

            //push to session table
            $table_id = "pe_table_".$item_level_pe->process_entry_id;

            foreach ($ics as $ic) {
                $comp_id = (($ic->item_component_id)."");
                $comp = [
                    "item_component_id"=>$ic->item_component_id,
                    "item_number"=>$ic->item_number,
                    "item_description"=>$ic->item_description,
                    "item_component_qty"=>$ic->pivot->item_component_qty,
                    "item_uofm"=>$ic->item_uofm,
                    "item_kit_count"=>0,
                    "bom_count"=>0
                ];

                Session::put("sess.comp_temp.".$comp_id,$comp);
                Session::put("sess.table.".$table_id.".".$ic->item_component_id,$comp);
            }
            // dd(Session::get("sess.table"));
        }
        //---
        return view('master.partials.data_edit',compact("item_level","departments","item_components","item_kit","bom","process_entry"));
    }

    function updateData(Request $request)
    {
        $item_level = ItemLevel::find($request->item_level_id);
        $item_level->name = $request->name;
        $item_level->departments()->detach();
        $item_level->itemComponents()->detach();
        $item_level->itemKits()->detach();
        $item_level->boms()->detach();

        $departments = $request->departments ?? [];
        $components = $request->components ?? [];
        $item_kits = $request->item_kits ?? [];
        $boms = $request->boms ?? [];

        //update departments
        foreach ($departments as $department) {
            # code...
            $item_level->departments()->attach($department);
        }
        foreach ($components as $component) {
            # code...
            $item_level->itemComponents()->attach($component);
        }
        foreach ($item_kits as $item_kit) {
            # code...
            $item_level->itemKits()->attach($item_kit);
        }
        foreach ($boms as $bom) {
            # code...
            $item_level->boms()->attach($bom);
        }
        $process_entries = Session::get("sess.table");
        $item_level->processEntries()->detach();


        foreach ($process_entries as $pe=>$item_components) {
            $process_entry_id = substr($pe, strpos($pe,'pe_table_')+strlen('pe_table_'));

            //attach to item level process entry
            $item_level->processEntries()->attach($process_entry_id);

            $item_level_process_entry = ItemLevelProcessEntry::where('item_level_id',$item_level->item_level_id)->where('process_entry_id',$process_entry_id)->first();

            foreach($item_components as $item_component=>$ic){
                $icomp = ItemComponent::find($item_component);
                ItemComponentProcessEntry::where('item_component_id',$item_component)->where('item_level_process_entry_id',$item_level_process_entry->item_level_process_entry_id)->delete();
            }

            //loop through every item components inside pe
            foreach($item_components as $item_component=>$ic){
                //put into item_component_process_entry table
                $icomp = ItemComponent::find($item_component);
                $icomp->ItemLevelProcessEntries()->attach($item_level_process_entry,[
                    'item_component_qty'=>$ic["item_component_qty"]
                ]);
            }
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
        $item_levels = ItemLevel::find($request->item_level_id)->descendantsAndSelf()->get();
        foreach ($item_levels as $key => $item_level) {
            $item_level->delete();
        }
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

        //get all process entries
        $item_level_process_entries = $item_level->processEntries;
        $tables = [];
        foreach ($item_level_process_entries as $item_level_process_entry) {
            $table_id = 'pe_table_'.$item_level_process_entry->process_entry_id;
            //get all item
            $items = ItemLevelProcessEntry::find($item_level_process_entry->pivot->item_level_process_entry_id)->itemComponents;

            $tables[$table_id] = $items;
        }

        return response()->json([
            'success' => true,
            'data'    => [
                "item_level"=>$item_level,
                "item_components"=>$item_components,
                "all_photos"=>$allPhotos,
                "process_entries"=>$item_level_process_entries,
                "tables"=>$tables
            ],
        ]);
    }
    function getProcessEntryItem(Request $request){
        $session_status = $request->session_status;
        $components = null;

        if($session_status == '0'){
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
                    $components[$comp_id]["item_component_qty"] =  $components[$comp_id]["item_component_qty"] + $comp->pivot->item_component_qty;
                    $components[$comp_id]["item_kit_count"] += $comp->pivot->item_component_qty;
                }
                else{
                    $new_comp = [
                        "item_component_id"=>$comp->item_component_id,
                        "item_number"=>$comp->item_number,
                        "item_description"=>$comp->item_description,
                        "item_component_qty"=>$comp->pivot->item_component_qty,
                        "item_uofm"=>$comp->item_uofm,
                        "item_kit_count"=>$comp->pivot->item_component_qty,
                        "bom_count"=>0
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
                    $components[$comp_id]["item_component_qty"] =  $components[$comp_id]["item_component_qty"] + $comp->pivot->consumed_qty;
                    $components[$comp_id]["bom_count"] += $comp->pivot->consumed_qty;
                }
                else{
                    $new_comp = [
                        "item_component_id"=>$comp->item_component_id,
                        "item_number"=>$comp->item_number,
                        "item_description"=>$comp->item_description,
                        "item_component_qty"=>$comp->pivot->consumed_qty,
                        "item_uofm"=>$comp->item_uofm,
                        "item_kit_count"=>0,
                        "bom_count"=>$comp->pivot->consumed_qty
                    ];
                    $components[$comp_id] = $new_comp;
                }
                }
            }
            //ok
            Session::put("sess.comp_temp",$components);
            return response()->json([
                'success' => true,
                'data'    => [
                "components"=>$components
                ],
            ]);
        }
        else if($session_status=='1'){
            $components = Session::get("sess.comp_temp");
            return response()->json([
                'success' => true,
                'data'    => [
                "components"=>$components
                ],
            ]);
        }

    }

    function callUpdateSpecComponent($item_number,$table_id){
        $item_component_id = ItemComponent::where('item_number',$item_number)->first()->item_component_id;
        $item_component_id = $item_component_id."";
        //find in session
        if(Session::has('sess.comp_temp.'.$item_component_id)){
            $item = Session::get('sess.comp_temp')[$item_component_id];
            if(Session::has("sess.table.".$table_id.".".$item_component_id)){
                return response()->json([
                    'success' => false,
                    'message'=>'Komponen sudah ada pada tabel!'
                ]);
            }
            //success, no data found, create a new one
            Session::put("sess.table.".$table_id.".".$item_component_id,$item);
            return response()->json([
                'success' => true,
                'data'    => [
                    "item"=>$item,
                    "table"=>Session::get($table_id)
                ],
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message'=>'Komponen tidak terdapat pada item kit / bom id!'
            ]);
        }
    }

    function updateSpecComponent(Request $request)
    {
        $item_number = $request->item_number;
        $table_id = $request->table_id;
        return $this->callUpdateSpecComponent($item_number,$table_id);
    }

    function updateQty(Request $request){
        $qty = $request->qty;
        $table_id = $request->table_id;
        $item_number = $request->item_number;
        $item_component_id = ItemComponent::where('item_number',$item_number)->first()->item_component_id;
        $table_comp = Session::get('sess.table.'.$table_id.".".$item_component_id);
        $table_comp["item_component_qty"] = $qty;
        Session::put('sess.table.'.$table_id.'.'.$item_component_id,$table_comp);
        return response()->json([
            'success' => true,
            'message'=>'Berhasil update qty!',
            'tables'=>Session::get("sess.table")
        ]);

    }

    function matchDataComponent(Request $request){
        $item_component_id = $request->item_component_id;
        $tables = Session::get("sess.table");
        $total_qty = 0;
        foreach($tables as $table){
            if($table[$item_component_id]!=null){
                $total_qty += $table[$item_component_id]["item_component_qty"];
            }
        }
        $item_temp_qty = Session::get('sess.comp_temp')[$item_component_id]["item_component_qty"];
        if($total_qty >= $item_component_id){
            //delete
        }
    }

    function deleteComponentTable(Request $request){
        $item_number = $request->item_number;
        $item_component_id = ItemComponent::where('item_number',$item_number)->first()->item_component_id;
        //delete
        $table_id = $request->table_id;
        Session::forget("sess.table.".$table_id.".".$item_component_id);
        return response()->json([
            'success' => true,
            'message'=>'Berhasil hapus komponen dari tabel!',
            'tables'=>Session::get("sess.table")
        ]);
    }

    function updateVirtualComponent(Request $request){
        //components virtual used to track the process entry data
    }

    function getComponents(Request $request){
        //table_id
        $table_id = $request->table_id;
        $tables = Session::get('sess.table') ?? [];
        $pes = [];
        if($table_id == "all"){

            foreach ($tables as $pe_table_id=>$table) {
                $pe_id = substr($pe_table_id, strpos($pe_table_id,'pe_table_')+strlen('pe_table_'));

                $pe = ProcessEntry::find($pe_id);
                $new_pe = [
                    "process_entry_id"=>$pe->process_entry_id,
                    "work_description"=>$pe->work_description,
                ];
                $pes[] = $new_pe;
            }
            return response()->json([
                'success' => true,
                'is_multiple'=>true,
                'tables' => $tables,
                'process_entries'=>$pes
            ]);
        }
        else{
            return response()->json([
                'success' => true,
                'is_multiple'=>false,
                'items' => $tables[$table_id]
            ]);
        }

    }

    function getDataTemp(){
        $table = Session::get('sess.table');
        $temp = Session::get('sess.comp_temp');
        return response()->json([
            'table'=>$table,
            'temp'=>$temp
        ]);
    }
}
