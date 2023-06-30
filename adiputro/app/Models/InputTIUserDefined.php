<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputTIUserDefined extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'input_ti_user_defined';
    protected $primaryKey = 'input_ti_user_defined_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['input_ti_user_defined_id', 'input_ti_id', 'user_id'];
}
