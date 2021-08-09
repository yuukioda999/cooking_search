<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['user_id', 'recipe_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class); 
    }
  
    public function isFavorite(Int $user_id, Int $recipe_id) 
    {
        return (boolean) $this->where('user_id', $user_id)->where('recipe_id', $recipe_id)->first();
    }

    public function storeFavorite(Int $user_id, Int $recipe_id)
    {
        $this->user_id = $user_id;
        $this->recipe_id = $recipe_id;
        $this->save();

        return;
    }

    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }

}
