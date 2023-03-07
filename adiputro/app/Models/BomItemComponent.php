<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BomItemComponent extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'bom_item_component';
    protected $primaryKey = 'bom_item_component_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['bom_id','consumed_item_id','consumed_qty'];
}
