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

    protected $fillable = ['item_level_id','nomor_laporan','tanggal','pelapor_id','kategori_report_id','temuan','jenis','reply','tanggal_diselesaikan','penyelesai_id'];

    function pelapor(){
        return $this->belongsTo(User::class,"pelapor_id","user_id");
    }

    function penyelesai(){
        return $this->belongsTo(User::class,"penyelesai_id","user_id");
    }

    function kategori_report(){
        return $this->belongsTo(KategoriReport::class,"kategori_report_id","kategori_report_id");
    }
}
