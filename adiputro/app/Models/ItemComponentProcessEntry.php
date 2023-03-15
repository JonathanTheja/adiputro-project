<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemComponentProcessEntry extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_component_process_entry';
    protected $primaryKey = 'item_component_process_entry_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_component_id','item_level_process_entry_id','department_id','item_component_qty'];
}
