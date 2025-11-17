<?php

namespace App\Helpers;

use App\Models\UserNotification;
use Illuminate\Support\Str;

class Referal
{
   public static function generateReferralCode($length = 8) {
    do {
        $code = Str::upper(Str::random($length));
    } while (\App\Models\User::where('referral_code', $code)->exists() || \App\Models\Invitation::where('code', $code)->exists());
    return $code;
}
}
