<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'cover_image', 'image1', 'image2', 'image3', 'image4', 'image5',
        'image6', 'image7', 'image8', 'image9', 'image10',
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

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
