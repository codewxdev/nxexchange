<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'user_id',
        'from_account',
        'to_account',
        'amount',
        'deduction',
        'status',
        'date_time',
        'deduction_applied',
        'deduction_amount',
        'net_amount',
        'trading_volume_at_transfer',
        'trading_volume_completed_at_transfer',
        'trading_volume_status',
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'deduction_applied' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
