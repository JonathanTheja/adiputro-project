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

    protected $fillable = ['item_number','item_description'];

    function itemLevels()
    {
        return $this->belongsToMany(ItemLevel::class,'item_component_item_level','item_component_id','item_level_id')->withPivot('item_component_id','item_level_id');
    }
}
