<?php

namespace App\Notifications\Channels;

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
        $logData = $this->getLogData($notification);

        Log::create([
            'level' => $logData['level'],
            'channel' => 'backup',
            'message' => $logData['message'],
        ]);
    }

    protected function getLogData(Notification $notification): array
    {
        return match (get_class($notification)) {
            BackupWasSuccessfulNotification::class => $this->handleBackupSuccess($notification),
            BackupHasFailedNotification::class => $this->handleBackupFailure($notification),
            HealthyBackupWasFoundNotification::class => $this->handleHealthyBackup($notification),
            UnhealthyBackupWasFoundNotification::class => $this->handleUnhealthyBackup($notification),
            CleanupWasSuccessfulNotification::class => $this->handleCleanupSuccess($notification),
            CleanupHasFailedNotification::class => $this->handleCleanupFailure($notification),
        };
    }

    protected function handleBackupSuccess(Notification $notification): array
    {
        return [
            'level' => 'info',
            'message' => sprintf('Backup completed successfully.'),
        ];
    }

    protected function handleBackupFailure($notification): array
    {
        return [
            'level' => 'error',
            'message' => sprintf('Backup failed.'),
        ];
    }

    protected function handleHealthyBackup($notification): array
    {
        return [
            'level' => 'info',
            'message' => sprintf('Backup health check passed.'),
        ];
    }

    protected function handleUnhealthyBackup($notification): array
    {
        return [
            'level' => 'warning',
            'message' => sprintf('Backup health check failed.'),
        ];
    }

    protected function handleCleanupSuccess($notification): array
    {
        return [
            'level' => 'info',
            'message' => sprintf('Backup cleanup completed successfully.'),
        ];
    }

    protected function handleCleanupFailure($notification): array
    {
        return [
            'level' => 'error',
            'message' => sprintf('Backup cleanup failed.'),
        ];
    }
}
