<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriReport extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'kategori_report';
    protected $primaryKey = 'kategori_report_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ["name"];

    function form_report(){
        return $this->hasMany(FormReport::class,"kategori_report_id","kategori_report_id");
    }
}
