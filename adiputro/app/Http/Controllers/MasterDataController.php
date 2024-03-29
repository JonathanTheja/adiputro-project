<?php

namespace App\Http\Controllers;

use App\Models\Bom;
use App\Models\Department;
use App\Models\DepartmentItemLevel;
use App\Models\InputTI;
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


    function updateTotalUsedComponentList($item_component_id){
        $tables = Session::get("sess.table") ?? [];
        // dd($tables);
        $item_component_id = $item_component_id."";
        $total_qty = 0;

        $total_item_kit_qty = 0;
        $total_bom_qty = 0;
        $total_component_qty = 0;
        foreach($tables as $table){
            if(array_key_exists($item_component_id,$table)){

                $total_item_kit_qty += $table[$item_component_id]["item_kit_qty"];
                $total_bom_qty += $table[$item_component_id]["bom_qty"];
                $total_component_qty += $table[$item_component_id]["component_qty"];
            }
        }
        $comp_temp = Session::get('sess.comp_temp.'.$item_component_id);
        $comp_temp["total_item_kit_used"] = $total_item_kit_qty;
        $comp_temp["total_bom_used"] = $total_bom_qty;
        $comp_temp["total_component_used"] = $total_component_qty;
        if($total_item_kit_qty >= $comp_temp["item_kit_count"] && $total_bom_qty >= $comp_temp["bom_count"] && $total_component_qty >= $comp_temp["component_count"]){
            $comp_temp["is_available"] = false;
        }
        else{
            $comp_temp["is_available"] = true;
        }
        Session::put('sess.comp_temp.'.$item_component_id,$comp_temp);
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

        $partial_components = $item_level->codeComponents()->get();

        //DONE--
        foreach ($item_level_pes as $item_level_pe) {
            //make a new session table && components
            //itl_pe -> item level process entry
            //ics -> item components
            $itl_pe = ItemLevelProcessEntry::find($item_level_pe->pivot->item_level_process_entry_id);
            $ics = ($itl_pe->itemComponents);

            //push to session table
            $table_id = "pe_table_".$item_level_pe->process_entry_id;

            Session::put("sess.table_tier.".$table_id,[
                "item_component_id"=>$itl_pe->item_component_id,
                "desc"=>$itl_pe->desc
            ]);

            foreach ($ics as $ic) {
                $comp_id = (($ic->item_component_id)."");
                $comp = [
                    "item_component_id"=>$ic->item_component_id,
                    "item_number"=>$ic->item_number,
                    "item_description"=>$ic->item_description,
                    "item_component_qty"=>$ic->pivot->item_component_qty,
                    "item_uofm"=>$ic->item_uofm,
                    "item_kit_count"=>$ic->pivot->item_kit_count,
                    "bom_count"=>$ic->pivot->bom_count,
                    "component_count"=>$ic->pivot->component_count,
                    "total_item_used"=>0,
                    "item_kit_qty"=>$ic->pivot->item_kit_qty,
                    "bom_qty"=>$ic->pivot->bom_qty,
                    "component_qty"=>$ic->pivot->component_qty
                ];
                Session::put("sess.table.".$table_id.".".$ic->item_component_id,$comp);
            }
        }
        //---
        return view('master.partials.data_edit',compact("item_level","departments","item_components","item_kit","bom","process_entry","partial_components"));
    }

    function updateData(Request $request)
    {
        $item_level = ItemLevel::find($request->item_level_id);
        $item_level->name = $request->name;
        $item_level->departments()->detach();
        $item_level->itemComponents()->detach();
        $item_level->itemKits()->detach();
        $item_level->boms()->detach();
        $item_level->codeComponents()->detach();

        $departments = $request->departments ?? [];
        $components = $request->components ?? [];
        $item_kits = $request->item_kits ?? [];
        $item_components = $request->item_components ?? [];
        $qtys = $request->item_components_qty ?? [];
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

        $icr = 0;
        foreach ($item_components as $comp) {
            # code...
            $item_level->codeComponents()->attach($comp,[
                'item_component_qty'=> $qtys[$icr]
            ]);
            $icr++;
        }
        $process_entries = Session::get("sess.table");
        $ids = $item_level->processEntries()->pluck('item_level_process_entry_id')->toArray();
        ItemComponentProcessEntry::whereIn('item_level_process_entry_id',$ids)->delete();
        $item_level->processEntries()->detach();


        foreach ($process_entries as $pe=>$item_components) {
            $process_entry_id = substr($pe, strpos($pe,'pe_table_')+strlen('pe_table_'));
            $tier_component = Session::get("sess.table_tier.".$pe);
            //attach to item level process entry
            $item_level->processEntries()->attach($process_entry_id,[
                "item_component_id"=>$tier_component["item_component_id"],
                "desc"=>$tier_component["desc"]
            ]);

            $item_level_process_entry = ItemLevelProcessEntry::where('item_level_id',$item_level->item_level_id)->where('process_entry_id',$process_entry_id)->first();


            //loop through every item components inside pe
            foreach($item_components as $item_component=>$ic){
                //put into item_component_process_entry table
                $icomp = ItemComponent::find($item_component);
                $icomp->ItemLevelProcessEntries()->attach($item_level_process_entry,[
                    'item_kit_qty'=>$ic["item_kit_qty"],
                    'bom_qty'=>$ic["bom_qty"],
                    'component_qty'=>$ic["component_qty"],
                    'item_kit_count'=>$ic["item_kit_count"],
                    'bom_count'=>$ic["bom_count"],
                    'component_count'=>$ic["component_count"]
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
        if ($request->hasFile("stl")) {
            $stl = $request->file("stl");
            $namafile = 'stl.' . $stl->getClientOriginalExtension();
            $namafolder = "stl/" . $request->item_level_id;
            $stl->storeAs($namafolder, $namafile, 'public');
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
        if(isset($item_level->input_ti)){
            $allPhotosSOP = array_filter(
                Storage::disk('public')->files('images/input/ti/'.strval(date("Y-m-d H-i-s", $item_level->input_ti->created_at->timestamp))),
                function ($filename) {
                    return in_array(pathinfo($filename, PATHINFO_EXTENSION), ['png', 'jpg']);
                }
            );
            $input_ti_id = $item_level->input_ti->input_ti_id;
        }
        else{
            $allPhotosSOP = [];
            $input_ti_id = null;
        }

        //get all process entries
        $item_level_process_entries = $item_level->processEntries;
        $tables = [];
        $table_tier = [];
        foreach ($item_level_process_entries as $item_level_process_entry) {
            $table_id = 'pe_table_'.$item_level_process_entry->process_entry_id;
            //get all item
            $item_lv_process = ItemLevelProcessEntry::find($item_level_process_entry->pivot->item_level_process_entry_id);
            $items = $item_lv_process->itemComponents;

            $tables[$table_id] = $items;
            $table_tier[$table_id] = [
                "item_component_name"=>ItemComponent::find($item_lv_process->item_component_id)->item_description,
                "desc"=>$item_lv_process->desc
            ];
        }

        return response()->json([
            'success' => true,
            'data'    => [
                "item_level"=>$item_level,
                "input_ti_id"=>$input_ti_id,
                "item_components"=>$item_components,
                "all_photos"=>$allPhotos,
                "all_photos_sop"=>$allPhotosSOP,
                "process_entries"=>$item_level_process_entries,
                "tables"=>$tables,
                "table_tier"=>$table_tier
            ],
        ]);
    }

    function getDataModal(Request $request)
    {
        $item_component_id = $request->item_component_id;
        $item_component = ItemComponent::find($item_component_id);

        //get all photos
        $allPhotos = Storage::disk('public')->files("images/input/model/".$item_component_id);
        $photos = [];
        $photos = Storage::disk('public')->files("images/input/approved/gt/item_component_id_".$item_component_id);

        return response()->json([
            'success' => true,
            'data'    => [
                'item_component'=>$item_component,
                'all_photos'=>$allPhotos,
                'photos'=>$photos,
            ],
        ]);
    }

    function getDataModal2(Request $request)
    {
        $item_level_id = $request->item_level_id;
        $item_level = ItemLevel::find($item_level_id);
        $photos = [];
        // $photos = Storage::disk('public')->files("images/input/approved/ti/item_level_id_".$item_level_id);

        $input_ti = InputTI::find($item_level->input_ti_id);
        $photos = Storage::disk('public')->files('images/input/ti/'.strval(date("Y-m-d H-i-s", $input_ti->created_at->timestamp)).'/pdf_to_img');

        return response()->json([
            'success' => true,
            'data'    => [
                'item_level'=>$item_level,
                'photos'=>$photos,
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
            $code_components = $request->code_components ?? [];
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
                    $components[$comp_id]["item_kit_numbers"][] = $item_kit->item_kit_number;
                    $components[$comp_id]["item_component_qty"] =  $components[$comp_id]["item_component_qty"] + $comp->pivot->item_component_qty;
                    $components[$comp_id]["item_kit_count"] += $comp->pivot->item_component_qty;
                }
                else{
                    $new_comp = [
                        "item_kit_numbers"=>[$item_kit->item_kit_number],
                        "bom_numbers"=>[],
                        "item_component_id"=>$comp->item_component_id,
                        "item_number"=>$comp->item_number,
                        "item_description"=>$comp->item_description,
                        "item_component_qty"=>$comp->pivot->item_component_qty,
                        "item_uofm"=>$comp->item_uofm,
                        "item_kit_count"=>$comp->pivot->item_component_qty,
                        "total_item_kit_used"=>0,
                        "total_bom_used"=>0,
                        "total_component_used"=>0,
                        "total_item_used"=>0,
                        "bom_count"=>0,
                        "component_count"=> 0,
                        "is_available"=>true
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
                    $components[$comp_id]["bom_numbers"][] = $bom->bom_number;
                    $components[$comp_id]["item_component_qty"] =  $components[$comp_id]["item_component_qty"] + $comp->pivot->consumed_qty;
                    $components[$comp_id]["bom_count"] += $comp->pivot->consumed_qty;
                }
                else{
                    $new_comp = [
                        "item_kit_numbers"=>[],
                        "bom_numbers"=>[$bom->bom_number],
                        "item_component_id"=>$comp->item_component_id,
                        "item_number"=>$comp->item_number,
                        "item_description"=>$comp->item_description,
                        "item_component_qty"=>$comp->pivot->consumed_qty,
                        "item_uofm"=>$comp->item_uofm,
                        "item_kit_count"=>0,
                        "total_item_kit_used"=>0,
                        "total_bom_used"=>0,
                        "total_component_used"=>0,
                        "total_item_used"=>0,
                        "bom_count"=>$comp->pivot->consumed_qty,
                        "component_count"=> 0,
                        "is_available"=>true
                    ];
                    $components[$comp_id] = $new_comp;
                }
                }
            }

            foreach($code_components as $code_component){
                $comp = ItemComponent::find($code_component["id"]);
                $comp_id = (($comp->item_component_id)."");
                if(Arr::exists($components,$comp_id)){
                    //icr
                    $components[$comp_id]["item_component_qty"] =  $components[$comp_id]["item_component_qty"] + $code_component["qty"];
                    $components[$comp_id]["component_count"] += $code_component["qty"];
                }
                else{
                    $new_comp = [
                        "item_kit_numbers"=>[],
                        "bom_numbers"=>[],
                        "item_component_id"=>$comp->item_component_id,
                        "item_number"=>$comp->item_number,
                        "item_description"=>$comp->item_description,
                        "item_component_qty"=>$code_component["qty"],
                        "item_uofm"=>$comp->item_uofm,
                        "item_kit_count"=>0,
                        "total_item_kit_used"=>0,
                        "total_bom_used"=>0,
                        "total_component_used"=>0,
                        "total_item_used"=>0,
                        "bom_count"=>0,
                        "component_count"=> $code_component["qty"],
                        "is_available"=>true
                    ];
                    $components[$comp_id] = $new_comp;
                }
            }
            //ok
            Session::put("sess.comp_temp",$components);

            foreach ($components as $component) {
                $this->updateTotalUsedComponentList($component["item_component_id"]);
            }

            $components = Session::get("sess.comp_temp");
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

    function checkToBeDeleted(Request $request){
        $resource = $request->resource;
        $id = $request->id;
        $is_allowed = true;
        $components = Session::get("sess.comp_temp");
        $item = null;
        $ret = [];
        if($resource == "item_kit"){
            $item_kit_id = $id;
            $item_kit = ItemKit::find($id);

            $item_kit_number = $item_kit->item_kit_number;
            // $ret = $components;
            foreach ($components as $component_id => $comp) {
                if (in_array($item_kit_number,$comp["item_kit_numbers"])) {

                    if($comp["total_item_kit_used"] > 0){
                        $is_allowed = false;
                    }

                }
            }
        }
        else if($resource == "bom"){
            $bom_id = $id;
            $bom = Bom::find($id);
            $bom_number = $bom->bom_number;
            $ret = $components;
            foreach ($components as $component_id => $comp) {
                if (in_array($bom_number,$comp["bom_numbers"])) {
                    if($comp["total_bom_used"] > 0){
                        $is_allowed = false;
                    }
                }
            }
        }
        return response()->json([
            'success' => $is_allowed,
            'ret'=>$ret,
            'is_allowed'=>$is_allowed
            // 'item'=>$item,
            // 'id'=>$id
        ]);
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
            if(!$item["is_available"]){
                return response()->json([
                    'success' => false,
                    'message' => "Jumlah item tidak mencukupi!"
                ]);
            }
            $item["item_kit_qty"] = $item["item_kit_count"] - $item["total_item_kit_used"];
            $item["bom_qty"] = $item["bom_count"] - $item["total_bom_used"];
            $item["component_qty"] = $item["component_count"] - $item["total_component_used"];

            Session::put("sess.table.".$table_id.".".$item_component_id,$item);
            $this->updateTotalUsedComponentList($item_component_id);
            //success, no data found, create a new one

            $components = Session::get("sess.comp_temp");
            return response()->json([
                'success' => true,
                'data'    => [
                    "item"=>$item,
                    "components"=>$components,
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
        $source = $request->source;
        $table_id = $request->table_id;
        $item_number = $request->item_number;
        $item_component_id = ItemComponent::where('item_number',$item_number)->first()->item_component_id;
        $table_comp = Session::get('sess.table.'.$table_id.".".$item_component_id);

        //check enough or not ?
        $temp_comp = Session::get('sess.comp_temp.'.$item_component_id);
        $total_available = 0;
        $keyword = "";
        if($source == "item_kit"){
            $total_available = $temp_comp["item_kit_count"] - $temp_comp["total_item_kit_used"] + $table_comp["item_kit_qty"];
            $keyword = "item_kit_qty";
        }
        else if($source == "bom"){
            $total_available = $temp_comp["bom_count"] - $temp_comp["total_bom_used"] + $table_comp["bom_qty"];
            $keyword = "bom_qty";
        }
        else if($source == "component"){
            $total_available = $temp_comp["component_count"] - $temp_comp["total_component_used"] + $table_comp["component_qty"];
            $keyword = "component_qty";
        }
        // $total_available = $temp_comp["item_component_qty"] - $temp_comp["total_item_used"] + $table_comp["item_component_qty"];

        $tables = Session::get("sess.table");
        // dd($tables);
        $total_qty = 0;
        $ids = [];
        foreach($tables as $id=>$table){
            if(array_key_exists($item_component_id."",$table) && $id != $table_id){
                $ids[] = $id;
                $total_qty += $table[$item_component_id.""][$keyword];
            }
        }

        if($qty > $total_available){
            return response()->json([
                'success' => false,
                'message'=>'qty tidak cukup!',
                'tables'=>Session::get("sess.table"),
                'current_qty' => $table_comp[$keyword],

            ]);
        }

        $table_comp[$keyword] = $qty;
        Session::put('sess.table.'.$table_id.'.'.$item_component_id,$table_comp);
        $this->updateTotalUsedComponentList($item_component_id);

        $components = Session::get('sess.comp_temp');

        return response()->json([
            'success' => true,
            'message'=>'Berhasil update qty!',
            'tables'=>Session::get("sess.table"),
            'components' => $components
        ]);

    }


    function deleteComponentTable(Request $request){
        $item_number = $request->item_number;
        $item_component_id = ItemComponent::where('item_number',$item_number)->first()->item_component_id;
        //delete
        $table_id = $request->table_id;
        Session::forget("sess.table.".$table_id.".".$item_component_id);
        $this->updateTotalUsedComponentList($item_component_id);
        $components = Session::get("sess.comp_temp");
        return response()->json([
            'success' => true,
            'message'=>'Berhasil hapus komponen dari tabel!',
            'tables'=>Session::get("sess.table"),
            'components'=>$components
        ]);
    }

    function placeComponentToProcess(Request $request){
        $item_component_id = $request->item_component_id;
        $desc = $request->desc;
        $table_id = $request->table_id;
        Session::put("sess.table_tier.".$table_id,[
            "item_component_id"=>$item_component_id,
            "desc"=>$desc
        ]);
        return response()->json([
            'success' => true,
            'message'=>'Berhasil memasang komponen pada tabel!',
        ]);
    }

    function updateVirtualComponent(Request $request){
        //components virtual used to track the process entry data
    }

    function getComponents(Request $request){
        //table_id
        $table_id = $request->table_id;
        $tables = Session::get('sess.table') ?? [];
        $table_tier = Session::get('sess.table_tier') ?? [];
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
                'table_tier'=>$table_tier,
                'process_entries'=>$pes
            ]);
        }
        else{
            return response()->json([
                'success' => true,
                'is_multiple'=>false,
                'table_tier'=>$table_tier[$table_id] ?? null,
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
