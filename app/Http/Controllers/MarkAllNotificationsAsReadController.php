<?php

namespace App\Http\Controllers;

use App\Models\Notification;

final class MarkAllNotificationsAsReadController
{
    public function __invoke()
    {
        Notification::where('read_at', null)->update(['read_at' => now()]);
    }
}
