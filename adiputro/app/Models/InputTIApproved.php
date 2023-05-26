<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputTIApproved extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'input_ti_approved';
    protected $primaryKey = 'input_ti_approved_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['input_ti_approved_ti', 'input_ti_id', 'user_id'];

    function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
