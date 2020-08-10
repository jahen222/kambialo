<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebpayOrder extends Model
{
    protected $fillable = [
        'user_id', 'accounting_date', 'buy_order', 'card_number', 'authorization_code',
        'payment_code', 'response_code', 'shares_number', 'amount', 'commerce_code', 'transaction_date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
