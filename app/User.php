<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'subscription_id', 'token_webpay', 'comuna_id', 'firstname', 'lastname', 'telephone', 'birthdate', 'gender'
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

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Subscription');
    }

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    public function categories()
    {
        return $this->hasMany('App\UserCategory');
    }

    public function routeNotificationForMail($notification)
    {
        // Return email address only
        return $this->email;
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }
}
