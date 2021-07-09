<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe_tag extends Model
{
    protected $fillable = ['recipe_id', 'tag_id'];
}
