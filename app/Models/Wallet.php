<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'exchange_account_balance',
        'trading_account_balance',
        'trading_volume_target',
        'trading_volume_completed',
        'withdrawal_address',
        'withdrawal_password',
        'withdrawal_network',

    ];
}
