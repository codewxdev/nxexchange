<?php

namespace App\Helpers;

use App\Models\UserNotification;
use Illuminate\Support\Str;

class ID
{
   public static function generateUserId($length = 5) {
   do {
        // Generate numeric-only ID
        $userId = '';
        for ($i = 0; $i < $length; $i++) {
            $userId .= mt_rand(0, 9);
        }

    } while (
        \App\Models\User::where('id', $userId)->exists()
    );

    return $userId;
}
}
