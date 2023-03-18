<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovedByTI extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'approved_by_ti';
    protected $primaryKey = 'approved_by_ti_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['kode_ti','department_id'];
}
