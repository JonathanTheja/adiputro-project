<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name'];

    function users()
    {
        # code...
        return $this->hasMany(User::class,'role_id','role_id');
    }
}
