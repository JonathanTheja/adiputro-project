<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bom extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'bom';
    protected $primaryKey = 'bom_id';
    public $incrementing = true;
    public $timestamps = true;
}
