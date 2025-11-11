<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $fillable = [
        'crypto_symbol',
        'direction',
        'start_time',
        'end_time',
        'is_active',
        'admin_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Optional: Define relationship to the Admin model for logging
    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
