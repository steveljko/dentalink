<?php

namespace App\Enums;

enum NotificationChannel: string
{
    case DEFAULT = 'default';
    case BACKUP = 'backup';
    case APPOINTMENT = 'appointment';
}
