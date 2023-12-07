<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintInput2 extends Model
{
    use HasFactory;
    protected $table = 'print_input2';
    protected $primaryKey = 'print_input2_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ["input_ti_id","user_id","printed_at"];

    function input_ti(){
        return $this->hasOne(InputTI::class,"input_ti_id","input_ti_id");
    }
}
