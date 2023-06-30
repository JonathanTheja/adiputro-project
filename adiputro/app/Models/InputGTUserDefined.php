<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputGTUserDefined extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'input_gt_user_defined';
    protected $primaryKey = 'input_gt_user_defined_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['input_gt_user_defined_id', 'input_gt_id', 'user_id'];
}
