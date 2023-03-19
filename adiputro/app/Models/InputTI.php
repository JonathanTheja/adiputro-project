<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputTI extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'input_ti';
    protected $primaryKey = 'input_ti_id';//PK string
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['revisi','kode_ti','nomor_laporan','nama_ti','model','pembuat_id','user_defined_id','description','status'];

    function level_process_input_ti()
    {
        return $this->belongsToMany(ItemLevel::class,"level_process_input_ti",'input_ti_id','item_level_id')->withPivot('created_at','updated_at','deleted_at');
        // return $this->hasMany(LevelProcessInputTI::class,'kode_ti','kode_ti');
    }

    function item_level_ti()
    {
        return $this->belongsToMany(ItemLevel::class,"item_component_code_ti",'input_ti_id','item_level_id')->withPivot('item_component_id','created_at','updated_at','deleted_at');
    }

    function item_component_ti()
    {
        return $this->belongsToMany(ItemComponent::class,"item_component_code_ti",'input_ti_id','item_component_id')->withPivot('item_level_id','created_at','updated_at','deleted_at');
    }

    function checked_by_ti()
    {
        return $this->belongsToMany(User::class,"checked_by_ti",'input_ti_id','user_id')->withPivot('created_at','updated_at','deleted_at');
    }

    function approved_by_ti()
    {
        return $this->belongsToMany(Department::class,"approved_by_ti",'input_ti_id','department_id')->withPivot('created_at','updated_at','deleted_at');
    }

    function user_defined()
    {
        return $this->belongsTo(UserDefined::class,"user_defined_id","user_defined_id");
    }

    function pembuat()
    {
        return $this->belongsTo(User::class, "pembuat_id", "user_id");
    }

    function form_report()
    {
        return $this->belongsTo(FormReport::class, "nomor_laporan", "nomor_laporan");
    }
}
