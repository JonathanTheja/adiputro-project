<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputGT extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'input_gt';
    protected $primaryKey = 'input_gt_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['kode_ti','process_entry_id','kode_gt','revisi','nomor_laporan','nama_gt','item_component_id','user_defined_id','status'];

    function checked_by_gt()
    {
        return $this->belongsToMany(User::class,"checked_by_gt",'input_gt_id','user_id')->withPivot('created_at','updated_at','deleted_at');
    }

    function approved_by_gt()
    {
        return $this->belongsToMany(Department::class,"approved_by_gt",'input_gt_id','department_id')->withPivot('created_at','updated_at','deleted_at');
    }

    function process_entry()
    {
        return $this->belongsTo(ProcessEntry::class, "process_entry_id", "process_entry_id");
    }

    function form_report()
    {
        return $this->belongsTo(FormReport::class, "nomor_laporan", "nomor_laporan");
    }

    function user_defined()
    {
        return $this->belongsTo(UserDefined::class,"user_defined_id","user_defined_id");
    }

    function item_component()
    {
        return $this->belongsTo(ItemComponent::class,"item_component_id","item_component_id");
    }

}
