<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormReport extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'form_report';
    protected $primaryKey = 'form_report_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['nomor_laporan','tanggal','user_id','kategori','temuan'];

    function user(){
        return $this->belongsTo(User::class,"user_id","user_id");
    }
}
