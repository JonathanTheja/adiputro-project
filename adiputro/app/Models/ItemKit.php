<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemKit extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_kit';
    protected $primaryKey = 'item_kit_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['item_kit_number','item_kit_description'];
}
