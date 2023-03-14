<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemLevelProcessEntry extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_level_process_entry';
    protected $primaryKey = 'item_level_process_entry_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_level_id','item_level_process_entry_id'];
}
