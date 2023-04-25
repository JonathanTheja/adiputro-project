<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemComponentProcessEntry extends Model
{
    use HasFactory;
    protected $table = 'item_component_process_entry';
    protected $primaryKey = 'item_component_process_entry_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_component_id','item_level_process_entry_id','department_id','item_kit_count','bom_count','component_count','item_kit_qty','bom_qty','component_qty'];

    function item_level_process_entry()
    {
        return $this->hasOne(ItemLevelProcessEntry::class,'item_level_process_entry_id','item_level_process_entry_id');
    }

    function item_component()
    {
        return $this->hasOne(ItemComponent::class,'item_component_id','item_component_id');
    }
}
