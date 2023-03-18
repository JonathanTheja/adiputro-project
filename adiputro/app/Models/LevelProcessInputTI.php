<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelProcessInputTI extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'level_process_input_ti';
    protected $primaryKey = 'level_process_input_ti_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['kode_ti','item_level_id'];
}
