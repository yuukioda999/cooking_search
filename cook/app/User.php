<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = [
        'role'
    ];

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    public function join_favorites_recipes()
    {
        return $this->hasManyThrough(
            'App\Models\Recipe', //リレーションして取りたいテーブル「photos」
            'App\Models\Favorite', //経由するテーブル「favorites」
            'user_id', //favoritesテーブルをusersテーブルと結ぶための外部キー
            'id', // photosテーブルの外部キー
            null, // usersテーブルのローカルキー
            'recipe_id' //favoritesとphotosを結ぶために使うキー
        );
    }


    
}
