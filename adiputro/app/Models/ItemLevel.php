<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ItemLevel extends Model
{
    use HasFactory,SoftDeletes;
    use HasRecursiveRelationships;
    protected $table = 'item_level';
    protected $primaryKey = 'item_level_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name','item_number','item_description','parent_id','level','input_ti_id'];

    function departments()
    {
        # code...
        return $this->belongsToMany(Department::class,'department_item_level','item_level_id','department_id')->withPivot('department_id','item_level_id');
    }
    function itemComponents()
    {
        return $this->belongsToMany(ItemComponent::class,'item_component_item_level','item_level_id','item_component_id')->withPivot('item_component_id','item_level_id');
    }
    function codeComponents()
    {
        return $this->belongsToMany(ItemComponent::class,'item_level_code_component','item_level_id','item_component_id')->withPivot('item_component_id','item_level_id','item_component_qty');
    }
    function itemKits()
    {
        return $this->belongsToMany(ItemKit::class,'item_kit_item_level','item_level_id','item_kit_id')->withPivot('item_kit_id','item_level_id');
    }
    function boms()
    {
        return $this->belongsToMany(Bom::class,'bom_item_level','item_level_id','bom_id')->withPivot('bom_id','item_level_id');
    }
    function processEntries()
    {
        return $this->belongsToMany(ProcessEntry::class,'item_level_process_entry','item_level_id','process_entry_id')->withPivot('item_level_process_entry_id','process_entry_id','item_level_id');
    }

    function input_ti()
    {
        return $this->hasOne(InputTI::class, 'input_ti_id', 'input_ti_id');
    }

    public function getMaxChildrenDepth()
    {
        $maxDepth = 0;
        $children = $this->descendants()->get();

        foreach ($children as $child) {
            $depth = $this->getDepth($child);
            if ($depth > $maxDepth) {
                $maxDepth = $depth;
            }
        }

        return $maxDepth;
    }

    protected function getDepth(ItemLevel $item_level)
    {
        $depth = 0;
        $parent = $item_level->parent;

        while ($parent) {
            $depth++;
            $parent = $parent->parent;
        }

        return $depth;
    }
}
