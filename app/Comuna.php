<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $fillable = [
        'region_id', 'name'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }
}
