<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'user_id', 'from_account', 'to_account', 'amount', 'deduction', 'status'
    ];
    protected $casts = [
    'date_time' => 'datetime',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
