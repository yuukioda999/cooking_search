<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'profile_image',
        'text1',
        'text2',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'recipe_tags'); 
    }

    public function getLists()
    {
        $categories = Tag::pluck('name', 'id');
        return $categories;
    }
    
}
