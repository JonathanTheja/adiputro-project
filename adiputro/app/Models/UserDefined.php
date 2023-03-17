<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDefined extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'user_defined';
    protected $primaryKey = 'user_defined_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name','desc'];
}
