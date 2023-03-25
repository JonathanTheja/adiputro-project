<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessEntry extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'process_entry';
    protected $primaryKey = 'process_entry_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['spk_type','process_name','process_number','stall_number','work_description','pic','status'];



}
