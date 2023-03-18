<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckedByTI extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'checked_by_ti';
    protected $primaryKey = 'checked_by_ti_id';
    public $incrementing = true;
    public $timestamps = true;

    //user_id khusus manager engineering
    protected $fillable = ['kode_ti','user_id'];
}
