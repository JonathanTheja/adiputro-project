<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'department';
    protected $primaryKey = 'department_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name','access_database'];

    function user()
    {
        return $this->hasMany(User::class,"department_id","department_id");
    }

    function itemLevels()
    {
        return $this->belongsToMany(ItemLevel::class,'department_item_level','department_id','item_level_id')->withPivot('department_id','item_level_id');
    }
}
