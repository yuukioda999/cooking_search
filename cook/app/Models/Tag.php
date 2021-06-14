<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['recipe_id','name'];

    public function recipes()
    {
        return $this->belongsToMany(recipes::class); 
    }
}
