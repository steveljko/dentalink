<?php

namespace App\Enums;

enum LogLevel: string
{
    case DEBUG = 'debug';
    case INFO = 'info';
    case NOTICE = 'notice';
    case WARNING = 'warning';
    case ERROR = 'error';
    case CRITICAL = 'critical';
    case ALERT = 'alert';
    case EMERGENCY = 'emergency';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function fromString(string $value): ?self
    {
        return self::tryFrom(strtolower($value));
    }

    public static function isValid(string $value): bool
    {
        return in_array(strtolower($value), self::values());
    }
}
