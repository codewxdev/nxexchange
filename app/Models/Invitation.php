<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['code', 'created_by', 'single_use', 'max_uses', 'uses', 'note'];
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
