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

    protected $fillable = ['name'];

    function user()
    {
        return $this->hasMany(User::class,"department_id","department_id");
    }
}
