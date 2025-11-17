<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signal extends Model
{
    use SoftDeletes;

    protected $dates = ['end_time', 'deleted_at'];

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
