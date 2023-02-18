<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemComponent extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'item_component';
    protected $primaryKey = 'item_number';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = ['name'];


}
