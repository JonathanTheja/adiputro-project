<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemKitItemLevel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_kit_item_level';
    protected $primaryKey = 'item_kit_item_level_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_kit_id','item_level_id'];

}
