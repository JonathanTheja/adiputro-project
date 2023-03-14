<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BomItemLevel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'bom_item_level';
    protected $primaryKey = 'bom_item_level_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['bom_id','item_level_id'];
}
