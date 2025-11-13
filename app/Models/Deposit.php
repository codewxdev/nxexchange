<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $guarded = [];

   protected $fillable = [
        'user_id',
        'amount',
        'payment_gateway',
        'status',
        'transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
