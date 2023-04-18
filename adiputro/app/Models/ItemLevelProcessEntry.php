<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemLevelProcessEntry extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_level_process_entry';
    protected $primaryKey = 'item_level_process_entry_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_level_id','item_level_process_entry_id','process_entry_id','item_component_id','desc'];

    function itemComponents()
    {
        # code...
        return $this->belongsToMany(ItemComponent::class,'item_component_process_entry','item_level_process_entry_id','item_component_id')->withPivot('item_component_process_entry_id','department_id','item_kit_count','bom_count','item_component_qty');
    }

    function item_component_process_entry()
    {
        return $this->hasMany(ItemComponentProcessEntry::class,'item_level_process_entry_id','item_level_process_entry_id');
    }

    function process_entry()
    {
        return $this->hasOne(ProcessEntry::class,'process_entry_id','process_entry_id');
    }

    function item_level()
    {
        return $this->hasOne(ItemLevel::class,'item_level_id','item_level_id');
    }
}
