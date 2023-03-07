<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bom extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'bom';
    protected $primaryKey = 'bom_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['bom_number','bom_description','site_id_input','site_id_output'];

    function itemComponents()
    {
        return $this->belongsToMany(ItemComponent::class,'bom_item_component','bom_id','consumed_item_id')->withPivot(['consumed_qty']);
    }
}
