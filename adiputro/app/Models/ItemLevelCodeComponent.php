<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemLevelCodeComponent extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_level_code_component';
    protected $primaryKey = 'item_level_code_component_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_level_code_component_id','item_level_id','item_component_id','item_component_qty'];

}
