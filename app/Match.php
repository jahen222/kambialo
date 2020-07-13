<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'user_id_1', 'user_id_2'
    ];

    public function user1(){
        return $this->belongsTo('App\User', 'user_id_1');
    }

    public function user2(){
        return $this->belongsTo('App\User', 'user_id_2');
    }
}
