<?php

namespace App\Console\Commands;

use App\Enums\NotificationChannel;
use App\Enums\NotificationLevel;
use App\Events\NewNotification;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;

class SendTestNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Notification::create([
            'level' => NotificationLevel::INFO,
            'channel' => NotificationChannel::DEFAULT,
            'message' => 'Test notification is fired',
        ]);

        $user = User::first();
        event(new NewNotification($user->id));
    }
}
