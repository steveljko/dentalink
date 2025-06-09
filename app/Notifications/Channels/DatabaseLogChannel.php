<?php

namespace App\Notifications\Channels;

use App\Enums\LogChannel;
use App\Enums\LogLevel;
use App\Models\Log;
use Illuminate\Notifications\Notification;
use Spatie\Backup\Notifications\Notifications\BackupHasFailedNotification;
use Spatie\Backup\Notifications\Notifications\BackupWasSuccessfulNotification;
use Spatie\Backup\Notifications\Notifications\CleanupHasFailedNotification;
use Spatie\Backup\Notifications\Notifications\CleanupWasSuccessfulNotification;
use Spatie\Backup\Notifications\Notifications\HealthyBackupWasFoundNotification;
use Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFoundNotification;

final class DatabaseLogChannel
{
    public function send($notifiable, Notification $notification)
    {
        $data = $this->getData($notification);

        Log::create([
            'level' => $data['level'],
            'channel' => LogChannel::BACKUP,
            'translation_key' => $data['translation_key'],
        ]);
    }

    protected function getData(Notification $notification): array
    {
        return match (get_class($notification)) {
            BackupWasSuccessfulNotification::class => [
                'level' => LogLevel::INFO,
                'translation_key' => 'backup.completed',
            ],
            BackupHasFailedNotification::class => [
                'level' => LogLevel::ERROR,
                'translation_key' => 'backup.failed',
            ],
            HealthyBackupWasFoundNotification::class => [
                'level' => LogLevel::INFO,
                'translation_key' => 'backup.check_passed',
            ],
            UnhealthyBackupWasFoundNotification::class => [
                'level' => LogLevel::WARNING,
                'translation_key' => 'backup.completed',
            ],
            CleanupWasSuccessfulNotification::class => [
                'level' => 'info',
                'translation_key' => 'backup.cleanup_completed',
            ],
            CleanupHasFailedNotification::class => [
                'level' => 'error',
                'translation_key' => 'backup.cleanup_failed',
            ],
        };
    }
}
