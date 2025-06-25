<?php

namespace App\Notifications\Channels;

use App\Enums\NotificationChannel;
use App\Enums\NotificationLevel;
use App\Events\NewNotification;
use App\Models\Notification as NotificationModel;
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

        NotificationModel::create([
            'level' => $data['level'],
            'channel' => NotificationChannel::BACKUP,
            'translation_key' => $data['translation_key'],
        ]);

        $id = $notifiable->getKey();
        event(new NewNotification($id));
    }

    protected function getData(Notification $notification): array
    {
        return match (get_class($notification)) {
            BackupWasSuccessfulNotification::class => [
                'level' => NotificationLevel::INFO,
                'translation_key' => 'backup.completed',
            ],
            BackupHasFailedNotification::class => [
                'level' => NotificationLevel::ERROR,
                'translation_key' => 'backup.failed',
            ],
            HealthyBackupWasFoundNotification::class => [
                'level' => NotificationLevel::INFO,
                'translation_key' => 'backup.check_passed',
            ],
            UnhealthyBackupWasFoundNotification::class => [
                'level' => NotificationLevel::WARNING,
                'translation_key' => 'backup.failed',
            ],
            CleanupWasSuccessfulNotification::class => [
                'level' => NotificationLevel::INFO,
                'translation_key' => 'backup.cleanup_completed',
            ],
            CleanupHasFailedNotification::class => [
                'level' => NotificationLevel::ERROR,
                'translation_key' => 'backup.cleanup_failed',
            ],
        };
    }
}
