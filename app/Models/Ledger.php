<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $fillable = ['user_id', 'type', 'amount', 'balance_after', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
