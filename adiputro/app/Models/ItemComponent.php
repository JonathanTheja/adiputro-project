<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemComponent extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_component';
    protected $primaryKey = 'item_component_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_number','item_description','item_uofm'];

    function itemLevels()
    {
        return $this->belongsToMany(ItemLevel::class,'item_component_item_level','item_component_id','item_level_id')->withPivot('item_component_id','item_level_id');
    }
    function itemKits()
    {
        # code...
        return $this->belongsToMany(ItemKit::class,'item_kit_item_component','item_component_id','item_kit_id')->withPivot(['item_component_qty']);
    }
    function ItemLevelProcessEntries(){
        return $this->belongsToMany(ItemLevelProcessEntry::class,'item_component_process_entry','item_component_id','item_level_process_entry_id')->withPivot(['item_component_id','item_level_process_entry_id','department_id']);
    }
    function boms()
    {
        return $this->belongsToMany(ItemComponent::class,'bom_item_component','consumed_item_id','bom_id')->withPivot(['consumed_qty']);
    }
}
