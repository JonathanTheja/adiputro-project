<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory,SoftDeletes;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['username','password','full_name','department_id','gender','role_id','status'];

    function role()
    {
        return $this->belongsTo(Role::class,'role_id','role_id');
    }

    function department()
    {
        return $this->belongsTo(Department::class,'department_id','department_id');
    }

    function lapor_report(){
        return $this->hasMany(FormReport::class,"pelapor_id","user_id");
    }

    function selesai_report(){
        return $this->hasMany(FormReport::class,"penyelesai_id","user_id");
    }
}
