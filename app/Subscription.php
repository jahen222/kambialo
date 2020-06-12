<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'quote',
    ];

    public function users(){
        return $this->hasMany('App\User');
    }
}
