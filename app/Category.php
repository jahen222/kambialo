<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'image'
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }

    public static function getCommons($limit = 4)
    {
        return self::distinct()->withCount('products')->orderByDesc('products_count')->limit($limit)->get();
    }
}
