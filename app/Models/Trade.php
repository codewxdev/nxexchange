<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'user_id', 'direction', 'trade_type', 'signal_id', 'crypto_symbol',
        'stake_amount', 'profit_amount', 'profit_rate', 'result', 'start_time', 'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signal()
    {
        return $this->belongsTo(Signal::class);
    }
}
