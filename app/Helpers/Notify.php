<?php

namespace App\Helpers;

use App\Models\UserNotification;

class Notify
{
    public static function send($userId, $title, $message, $type = 'info')
    {
        return UserNotification::create([
            'user_id' => $userId,
            'title'   => $title,
            'message' => $message,
            'type'    => $type,
        ]);
    }
}
