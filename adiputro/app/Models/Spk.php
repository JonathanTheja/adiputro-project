<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spk extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'spk';
    protected $primaryKey = 'spk_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name','item_number','item_description','parent_id'];

      // Define Eloquent parent child relationship
      public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // for first level child this will works enough
    public function children() {
        return $this->hasMany(self::class, 'parent_id');
    }

    // and here is the trick for nestable child.
    public static function nestable($spks) {
       foreach ($spks as $spk) {
           if (!$spk->children->isEmpty()) {
               $spk->children = self::nestable($spk->children);
            }
        }

        return $spks;
    }
}
