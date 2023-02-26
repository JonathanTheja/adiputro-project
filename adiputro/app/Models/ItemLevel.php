<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ItemLevel extends Model
{
    use HasFactory,SoftDeletes;
    use HasRecursiveRelationships;
    protected $table = 'item_level';
    protected $primaryKey = 'item_level_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name','item_number','item_description','parent_id'];

    function departments()
    {
        # code...
        return $this->belongsToMany(ItemLevel::class,'department_item_level','item_level_id','department_id')->withPivot('department_id','item_level_id');
    }
}
