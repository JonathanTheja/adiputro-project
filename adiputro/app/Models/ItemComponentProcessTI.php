<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemComponentProcessTI extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_component_process_ti';
    protected $primaryKey = 'item_component_process_ti_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['input_ti_id','item_level_id','item_component_id'];
}
