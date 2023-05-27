<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputGTApproved extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'input_gt_approved';
    protected $primaryKey = 'input_gt_approved_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['input_gt_approved_ti', 'input_gt_id', 'user_id'];

    function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
