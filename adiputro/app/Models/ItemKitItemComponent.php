<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemKitItemComponent extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_kit_item_component';
    protected $primaryKey = 'item_kit_item_component_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_kit_id','item_component_id','item_component_qty','item_component_uofm'];
}
