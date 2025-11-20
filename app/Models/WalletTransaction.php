<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'from_wallet',
        'to_wallet',
        'amount',
        'status',
        'remark', // Changed from 'remarks' to match migration
        'admin_id',
        // ❌ REMOVE: 'fee', 'remarks' (not in migration)
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'user_id', 'user_id');
    }
}
