<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $casts = [
        'trade_balance' => 'float',
        'exchange_balance' => 'float',
    ];

    protected $fillable = [
        'user_id',
        'exchange_balance',
        'trade_balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mutator - جب save کریں تو convert کریں
    public function setTradeBalanceAttribute($value)
    {
        $this->attributes['trade_balance'] = (float) $value;
    }

    public function setExchangeBalanceAttribute($value)
    {
        $this->attributes['exchange_balance'] = (float) $value;
    }
}
