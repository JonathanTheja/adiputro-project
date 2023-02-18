<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spk extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'spk';
    protected $primaryKey = 'spk_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name','item_number','item_description','parent_id'];
}
