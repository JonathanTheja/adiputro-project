<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentItemLevel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'department_item_level';
    protected $primaryKey = 'department_item_level_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name'];
}
