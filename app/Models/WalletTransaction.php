<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'type',
        'from_wallet',
        'to_wallet',
        'amount',
        'fee',
        'remarks',
        'status',
        'user_id',
        'admin_id',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
