<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'cover_image'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function favorites(){
        return $this->hasMany('App\Favorite');
    }

    public function images(){
        return $this->hasMany('App\ProductImage');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public static function getRecents($limit = 4){
        return self::distinct()->orderByDesc('created_at')->limit($limit)->get();
    }
}
